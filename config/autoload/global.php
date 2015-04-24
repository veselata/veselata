<?php

return array(
    'doctrine' => array(
        'connection' => array(
            // default connection name
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'user' => 'root',
                    'password' => 'veselina',
                    'dbname' => 'solution',
                ),
            ),
        ),
        'configuration' => array(
            'orm_default' => array(
                'datetime_functions' => array(
                    'datesub' => 'Administration\Model\Doctrine\DateSub',
                ),
            )
        ),
    ),
);
