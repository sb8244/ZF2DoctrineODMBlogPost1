<?php

$db = 'fred-demo';
$connectionString = "mongodb://mongo1.host.com:27017,mongo2.host.com:27017/$db?replicaSet=rs0";
return array(
    'doctrine' => array(

        //just some self-explanatory connection info
        'connection' => array(
            'odm_default' => array(
                  'connectionString' => $connectionString,
                  'dbname'           => $db,
            ),
        ),

        //set the default_db again
        'configuration' => array(
            'odm_default' => array(
                  'default_db'       => $db,
            )
        ),

        'driver' => array(
            //Have to map an AnnotationDriver to ODM_Driver
            'ODM_Driver' => array(
                'class' => 'Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver',
            ),
            //All Entity's must use the ODM_Driver above by specifying in the following format:
            'odm_default' => array(
                'drivers' => array(
                    //new drivers belong in the module configs for those entities. See base for example
                    //'Namespace\Entity\Class' => 'ODM_Driver'
                )
            ),
        ),
        
    ),
);