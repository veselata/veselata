<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class Contact extends Form implements InputFilterProviderInterface {

    public function __construct($name = null) {
        parent::__construct('Contact');

        $this->setAttribute('role', 'form');

        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'attributes' => array(
                'placeholder' => 'Name',
                'class' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'Email',
            'attributes' => array(
                'placeholder' => 'Email',
                'class' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'subject',
            'type' => 'Text',
            'attributes' => array(
                'placeholder' => 'Subject',
            ),
        ));

        $this->add(array(
            'name' => 'message',
            'type' => 'Textarea',
            'attributes' => array(
                'placeholder' => 'Type your message',
                'class' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Csrf',
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
                'class' => 'btn btn-primary',
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'name' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            'message' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StringTrim'),
                ),
            ),
        );
    }

}
