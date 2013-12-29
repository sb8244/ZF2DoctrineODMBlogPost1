<?php
namespace Demo;

use Demo\Mapper\EntryMapper;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            //Our Entry takes not parameters
            'invokables' => array(
                'DemoEntry' => 'Demo\Entity\Entry',
            ),
            'factories' => array(
                //But the mapper has some dependencies which can be injected in
                'DemoEntryMapper' => function($sm) {
                    $dm = $sm->get('doctrine.documentmanager.odm_default');
                    return new EntryMapper($dm, $dm->getRepository('Demo\Entity\Entry'));
                },
            ),
            //The Entry entity should be unique
            'shared' => array(
                'DemoEntry' => false
            ),
        );
    }
}
