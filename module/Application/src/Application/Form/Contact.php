<?php

namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class Contact extends Form implements InputFilterProviderInterface {

    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     *
     * @var string
     */
    protected $targetClass = 'Administration\Entity\User';

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;

        parent::__construct('contact-form');

        $this->setHydrator(new DoctrineHydrator($this->entityManager, $this->targetClass));

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
            'name' => 'contact_csrf',
            'type' => 'csrf',
            'attributes' => array(
                'id' => 'contact_csrf',
                'type' => 'text'
            ,),
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600,
                )),
        ));

        $this->add(array(
            'name' => 'reset',
            'type' => 'Administration\Form\Element\Reset',
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
