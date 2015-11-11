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

    /**
     *
     * @var string
     */
    protected $targetClass = 'Administration\Entity\User';

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

    public function getInputFilterSpecification() {
        return array(
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
                            'max' => 255,),
                    ),
                ),
            ),
        );
    }

    public function getInputFilter() {
        $formInputFilter = parent::getInputFilter();

        if (!array_key_exists('is_edit', $this->getOptions())) {
            $usernameInput = $formInputFilter->get('user-fieldset')->get('username');

            $validator = new \Administration\Form\Validator\RecordExist(array(
                'repository' => $this->entityManager->getRepository($this->targetClass),
                'field' => 'username',
            ));
            $usernameInput->getValidatorChain()->addValidator($validator);
        }

        return $formInputFilter;
    }

}
