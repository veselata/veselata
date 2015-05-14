<?php

namespace Administration\Form\Element;

use Zend\Form\Element;
use Zend\InputFilter\InputProviderInterface;

class Textarea extends Element implements InputProviderInterface {

    protected $attributes = array(
        'type' => 'textarea',
        'class' => 'ckeditor',
    );

    public function getInputSpecification() {
        return array(
            'name' => $this->getName(),
        );
    }

}
