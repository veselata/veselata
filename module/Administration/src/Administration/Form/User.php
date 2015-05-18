<?php

namespace Administration\Form;

use Doctrine\ORM\EntityManager;
use Zend\Form\Form;

class User extends Form {

    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;

        parent::__construct('user-form');

        $this->setAttribute('role', 'form');

        $fieldSet = new \Administration\Form\Fieldset\User($this->entityManager);
        $fieldSet->setUseAsBaseFieldset(true);
        $this->add($fieldSet);

        $this->add(array(
            'name' => 'csrf',
            'type' => 'csrf',
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

}
