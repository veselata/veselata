<?php

namespace Administration\Form\Element;

use Zend\Form\Element;

class Reset extends Element {

    protected $attributes = array(
        'type' => 'reset',
        'class' => 'btn btn-primary reset',
    );
    protected $value = 'Reset';

}
