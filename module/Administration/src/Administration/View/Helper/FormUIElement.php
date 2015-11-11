<?php

namespace Administration\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormElement as BaseFormElement;

class FormUIElement extends BaseFormElement {

    protected $elementTypes = array('hidden', 'button', 'submit', 'reset');

    public function render(ElementInterface $element) {
        if (!in_array($element->getAttribute('type'), $this->elementTypes)) {
            $element->setAttribute('class', $element->getAttribute('class') . ' form-control');
        }
        return parent::render($element);
    }

}
