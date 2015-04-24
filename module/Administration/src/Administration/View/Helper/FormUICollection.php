<?php

namespace Administration\View\Helper;

use Zend\Form\View\Helper\FormCollection as BaseFormCollection;
use Zend\Form\ElementInterface;

class FormUICollection extends BaseFormCollection {
    /*
      public function render(ElementInterface $element) {
      return sprintf('<div class="form-wrap">%s</div>', parent::render($element));
      } */

    public function setShouldWrap() {
        return parent::setShouldWrap(false);
    }

}
