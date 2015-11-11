<?php

namespace Administration\Model;

class Constants {

    public static function getSkillList() {
        return array(
            array('title' => 'PHP', 'percent' => 90, 'background' => '025d8a',),
            array('title' => 'MySQL', 'percent' => 65, 'background' => 'd84f5f',),
            array('title' => 'XHtml', 'percent' => 75, 'background' => '88b8e6',),
            array('title' => 'Ajax', 'percent' => 50, 'background' => 'bedbe9',),
            array('title' => 'PHPUnit', 'percent' => 70, 'background' => 'aaa',),
        );
    }

}
