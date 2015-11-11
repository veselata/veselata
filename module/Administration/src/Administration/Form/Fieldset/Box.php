<?php

namespace Administration\Form\Fieldset;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class Box extends Fieldset implements InputFilterProviderInterface {

    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     *
     * @var string
     */
    protected $targetClass = 'Administration\Entity\Box';

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;

        parent::__construct('box-fieldset');

        $this->setHydrator(new DoctrineHydrator($this->entityManager, $this->targetClass));

        $this->add(array(
            'type' => 'hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'title',
            'options' => array(
                'label' => 'Title'
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
            'type' => 'select',
            'name' => 'position',
            'value' => \Administration\Model\Boxes::POSITION_TOP,
            'options' => array(
                'label' => 'Position',
                'options' => \Administration\Model\Boxes::getPositionList(),
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
            'title' => array(
                'required' => true
            ),
        );
    }

}
