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

    public function subjectLists() {
        return array(
            self::TYPE_CONTACT => 'Contact Form',
        );
    }

    public function setAdminMail($adminMail) {
        $this->adminMail = $adminMail;
    }

    public function getAdminMail() {
        return $this->adminMail;
    }

    public function notify($messageBody = array(), $type = self::TYPE_CONTACT) {
        $mailBody = '';
        foreach ($messageBody as $key => $data) {
            $mailBody .= '<p><b>' . ucfirst($key) . '</b>: ' . nl2br($data) . '</p>';
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
