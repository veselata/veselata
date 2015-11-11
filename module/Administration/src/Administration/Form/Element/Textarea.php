<?php

namespace Administration\Form\Element;

use Zend\Form\Element;

class Textarea extends Element {

    protected $attributes = array(
        'type' => 'textarea',
        'class' => 'ckeditor',
    );

}
