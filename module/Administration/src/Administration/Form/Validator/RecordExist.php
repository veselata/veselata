<?php

namespace Administration\Form\Validator;

use Zend\Validator\AbstractValidator;

class RecordExist extends AbstractValidator {

    const RECORD_FOUND = 'RECORD_FOUND';

    protected $messageTemplates = array(
        self::RECORD_FOUND => 'The value already exist',
    );
    protected $options;

    public function __construct($options = array()) {
        $this->options = $options;
        if (!is_array($this->options) ||
                !array_key_exists('repository', $this->options) ||
                !array_key_exists('field', $this->options) ||
                !$this->options['repository'] instanceof \Doctrine\ORM\EntityRepository ||
                !strlen($this->options['field']) > 0
        ) {
            throw new \Exception('Invalid option in ' . __FUNCTION__);
        }
        parent::__construct($options);
    }

    public function isValid($value) {
        $this->setValue($value);

        $result = $this->options['repository']->findOneBy(array($this->options['field'] => $value));
        if ($result !== null) {
            $this->error(self::RECORD_FOUND);
            return false;
        }
        return true;
    }

}
