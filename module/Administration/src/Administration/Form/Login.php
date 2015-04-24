<?php

namespace Administration\Form;

use Zend\Form\Form;

class Login extends Form {

    public function __construct($name = null) {
        parent::__construct('Login');

        $this->setAttribute('role', 'form');

        $this->add(array(
            'name' => 'username',
            'type' => 'Text',
            'options' => array(
                'label' => 'Username',
            ),
            'attributes' => array(
                'placeholder' => 'username',
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'options' => array(
                'label' => 'Password',
            ),
            'attributes' => array(
                'placeholder' => 'password',
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

}
