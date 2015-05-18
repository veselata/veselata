<?php

$pages = array(
    array('label' => 'Home', 'route' => 'dashboard', 'icon' => 'glyphicon-home', 'visible' => true),
    array('label' => 'Pages', 'route' => 'pages', 'icon' => 'glyphicon-list-alt', 'visible' => true,),
    array('label' => 'Boxes', 'route' => 'boxes', 'icon' => 'glyphicon-folder-open', 'visible' => true, 'pages' => true),
    array('label' => 'Projects', 'route' => 'projects', 'icon' => 'glyphicon-cloud-upload', 'visible' => true,),
    array('label' => 'Files', 'route' => 'files', 'icon' => 'glyphicon-paperclip', 'visible' => true,),
    array('label' => 'Contacts', 'route' => 'contacts', 'icon' => 'glyphicon-envelope', 'visible' => true,),
    array('label' => 'Users', 'route' => 'users', 'icon' => 'glyphicon-user', 'visible' => true, 'pages' => true),
);

$navigation = array();

foreach ($pages as $key => $page) {
    $navigation[$key] = array(
        'label' => '<span class="glyphicon glyphicon glyphicon ' . $page['icon'] . '"></span> ' . $page['label'],
        'route' => $page['route'],
        'resource' => 'Administration\Controller\\' . ucfirst($page['route']) . 'Controller',
    );
    if (isset($page['pages'])) {
        $navigation[$key]['pages'] = array(
            array(
                'label' => 'Add new',
                'action' => 'add',
                'route' => $page['route'],
                'visible' => false,),
        );
    }
}

return array(
    'navigation' => array(
        'default' => $navigation,
    ),
);

