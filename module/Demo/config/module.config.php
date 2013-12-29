<?php
return array(
    
    /*
     * All controllers must be registered in the following format:
     * Canonical name => Namespaced class
     */
    'controllers' => array(
        'invokables' => array(
            'Demo\Controller\Entry' => 'Demo\Controller\EntryController'
        ),
    ),
    
    /*
     * A basic route called entry which will route on /entry
     * Further, child routes allow for /entry/action/id to be mapped out 
     */
    'router' => array(
        'routes' => array(
            'entry' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/entry',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Demo\Controller',
                        'controller'    => 'Entry',
                        'action'        => 'list',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:action][/:id]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            )
                        ),
                    ),
                ),
            ),
        ),
    ),
    
    /*
     * Set this to say that we're using JSON instead of HTML. This actually will
     * still work even without this, in our example
     */
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    
    /*
     * MUST register the Entity with doctrine ODM_Driver or else you will get an Exception
     * referring to "Demo\Entity\Entry cannot be found in the chained namespaces"
     */
    'doctrine' => array(
        'driver' => array(
            'odm_default' => array(
                'drivers' => array(
                    'Demo\Entity\Entry' => 'ODM_Driver'
                ),
            ),
        ),
    ),
);