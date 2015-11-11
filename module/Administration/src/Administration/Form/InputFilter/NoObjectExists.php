<?php

namespace Administration\Form\InputFilter;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class NoObjectExists implements InputFilterAwareInterface {

    protected $inputFilter;
    protected $options;

    public function __construct($options = array()) {
        $this->options = $options;

        if (!is_array($this->options) ||
                !array_key_exists('object_repository', $this->options) ||
                !array_key_exists('fields', $this->options)) {
            throw new \Exception('Invalid parameter passed in ' . __FUNCTION__);
        }
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();
            $inputFilter->add($factory->createInput(array(
                        'name' => $this->options['fields'],
                        'validators' => array(
                            array(
                                'name' => 'DoctrineModule\Validator\NoObjectExists',
                                'options' => array(
                                    'object_repository' => $this->options['object_repository'],
                                    'fields' => $this->options['fields'],
                                ),
                                'messages' => array(
                                    'noObjectFound' => 'Field ' . $this->options['fields'] . ' with this value already exists !'
                                ),
                            ),
                        ),
            )));

            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

}
