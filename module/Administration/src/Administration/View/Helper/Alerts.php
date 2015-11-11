<?php

namespace Administration\View\Helper;

use Zend\View\Helper\FlashMessenger;
use Zend\Mvc\Controller\Plugin\FlashMessenger as PluginFlashMessenger;

class Alerts extends FlashMessenger {

    /**
     * Templates for the open/close/separators for message tags
     *
     * @var string
     */
    protected $messageCloseString = '</ul></li></div>';
    protected $messageOpenFormat = '<div  class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul%s><li>';
    protected $messageSeparatorString = '</li><li>';

    public function render($namespace = PluginFlashMessenger::NAMESPACE_DEFAULT, array $classes = array()) {
        $flashMessenger = $this->getPluginFlashMessenger();
        $messages = $flashMessenger->getMessagesFromNamespace($namespace);
        $messagesFromNamespace = $this->renderMessages($namespace, $messages, $classes);
        $flashMessenger->clearCurrentMessagesFromNamespace($namespace);
        return $messagesFromNamespace;
    }

}
