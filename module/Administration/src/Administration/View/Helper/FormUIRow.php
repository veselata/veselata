<?php

namespace Administration\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormRow as BaseFormRow;

class FormUIRow extends BaseFormRow {

    protected $elementTypes = array('hidden', 'button', 'submit');

    public function render(ElementInterface $element) {
        if (!in_array($element->getAttribute('type'), $this->elementTypes)) {
            return sprintf('<div class="form-group">%s</div>', parent::render($element));
        }

        return parent::render($element);
    }

}
