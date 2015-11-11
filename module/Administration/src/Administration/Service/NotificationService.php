<?php

namespace Administration\Service;

use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail;
use Zend\Mime;

class NotificationService {

    const TYPE_CONTACT = 1;
    const DEFAULT_NAME = 'Veselina';

    protected $adminMail = 'vesi.spasova@gmail.com'; //'veselina_spasova@abv.bg';
    protected $from = 'veselata@localhost';

    /**
     *
     * @return array
     */
    public function subjectLists() {
        return array(
            self::TYPE_CONTACT => 'Contact Form',
        );
    }

    /**
     *
     * @param string $adminMail
     */
    public function setAdminMail($adminMail) {
        $this->adminMail = $adminMail;
    }

    /**
     *
     * @return string
     */
    public function getAdminMail() {
        return $this->adminMail;
    }

    public function notify($object, $type = self::TYPE_CONTACT) {
        $data = array_filter(get_class_methods($object), function ($element) {
            return preg_match('/^get/', $element) === 1;
        });

        $mailBody = '';
        foreach ($data as $value) {
            $mailBody .= '<p><b>' . str_replace('get', '', $value) . '</b>: ' . print_r($object->$value(), true) . '</p>';
        }

        $htmlPart = new Mime\Part($mailBody);
        $htmlPart->type = Mime\Mime::TYPE_HTML;

        $textPart = new Mime\Part(strip_tags($mailBody));
        $textPart->type = Mime\Mime::TYPE_TEXT;

        $body = new Mime\Message();
        $body->setParts(array($textPart, $htmlPart));

        $mail = new Message();
        $mail->setFrom($this->from, self::DEFAULT_NAME)
                ->addTo($this->adminMail)
                ->setSubject($this->getSubjectByType($type))
                ->setBody($body)
                ->setEncoding('UTF-8');

        $mail->getHeaders()->get('Content-Type')->setType(Mime\Mime::MULTIPART_ALTERNATIVE);

        $transport = new Sendmail();
        try {
            $transport->send($mail);
        } catch (\Exception $e) {
            // log
        }
    }

    public function getSubjectByType($type) {
        $types = $this->subjectLists();
        return isset($types[$type]) ? $types[$type] : self::DEFAULT_NAME;
    }

}
