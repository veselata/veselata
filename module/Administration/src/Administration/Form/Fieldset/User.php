<?php

namespace Administration\Form\Fieldset;

use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class User extends Fieldset implements InputFilterProviderInterface {

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

        parent::__construct('user-fieldset');

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

        $this->add(
                array(
                    'type' => 'password',
                    'name' => 'password',
                    'options' => array(
                        'label' => 'Password'
                    ),
                    'attributes' => array(
                        'class' => 'required',
                        'autocomplete' => 'off',
                    ),
                )
        );

        $this->add(array(
            'type' => 'text',
            'name' => 'username',
            'options' => array(
                'label' => 'Username'
            ),
            'attributes' => array(
                'class' => 'required',
            ),
        ));

        $this->add(array(
            'type' => 'select',
            'name' => 'type',
            'options' => array(
                'label' => 'Account type',
                'value_options' => \Administration\Model\Users::getTypeList(),
            ),
        ));

        $this->add(array(
            'type' => 'select',
            'name' => 'is_active',
            'value' => \Administration\Model\BaseModel::STATUS_ACTIVE,
            'options' => array(
                'label' => 'Status',
                'options' => \Administration\Model\BaseModel::getStatusList(),
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
            'username' => array(
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 5,
                            'max' => 255,
                        ),
                    ),
                ),
            ),
            'password' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 5,
                            'max' => 255,
                        ),
                    ),
                ),
            ),
        );
    }

}
