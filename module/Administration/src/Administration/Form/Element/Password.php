<?php

namespace Administration\Form\Element;

use Zend\Form\Element;
use Zend\InputFilter\InputProviderInterface;

class Password extends Element implements InputProviderInterface {

    /**
     *
     * @var array
     */
    protected $attributes = array(
        'type' => 'password',
        'class' => 'required',
        'autocomplete' => 'off',
    );

    /**
     *
     * @var string
     */
    protected $label = 'Password';

    /**
     *
     * @return array
     */
    public function getInputSpecification() {
        return array(
            'name' => $this->getName(),
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'Zend\Validator\StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 5,
                        'max' => 255,
                    ),
                ),
            ),
        );
    }

    public function prepareElement(FormInterface $form) {
        $this->setValue('');
    }

}
