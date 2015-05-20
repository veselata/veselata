<?php

namespace Administration\Form\Fieldset;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class Project extends Fieldset implements InputFilterProviderInterface {

    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     *
     * @var string
     */
    protected $targetClass = 'Administration\Entity\Project';

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;

        parent::__construct('project-fieldset');

        $this->setHydrator(new DoctrineHydrator($this->entityManager, $this->targetClass));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'name',
            'options' => array(
                'label' => 'Name'
            ),
            'attributes' => array(
                'class' => 'required',
            ),
        ));

        $this->add(array(
            'type' => 'Administration\Form\Element\Textarea',
            'name' => 'description',
            'options' => array(
                'label' => 'Description'
            ),
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'url',
            'options' => array(
                'label' => 'Url'
            ),
        ));


        $this->add(array(
            'type' => 'text',
            'name' => 'thumb',
            'options' => array(
                'label' => 'Thumb'
            ),
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'likes',
            'options' => array(
                'label' => 'Likes'
            ),
        ));

        $this->add(array(
            'type' => 'select',
            'name' => 'status',
            'value' => \Administration\Model\BaseModel::STATUS_ACTIVE,
            'options' => array(
                'label' => 'Status',
                'options' => \Administration\Model\BaseModel::getStatusList(),
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'name' => array(
                'required' => true
            ),
        );
    }

}
