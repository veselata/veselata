<?php

namespace Administration\Form\Fieldset;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class Contact extends Fieldset implements InputFilterProviderInterface {

    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     *
     * @var string
     */
    protected $targetClass = 'Administration\Entity\Contact';

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;

        parent::__construct('contact-form');

        $this->setHydrator(new DoctrineHydrator($this->entityManager, $this->targetClass));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id',
        ));

        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name'
            ),
            'attributes' => array(
                'class' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'Email',
            'options' => array(
                'label' => 'Email'
            ),
            'attributes' => array(
                'class' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'subject',
            'type' => 'Text',
            'options' => array(
                'label' => 'Subject'
            ),
        ));

        $this->add(array(
            'name' => 'message',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Message'
            ),
            'attributes' => array(
                'class' => 'required',
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'id' => array(
                'required' => false
            ),
            'name' => array(
                'required' => true
            ),
        );
    }

}
