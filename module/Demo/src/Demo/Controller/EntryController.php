<?php

namespace Demo\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Demo\Mapper\EntryMapper;
use Demo\Entity\Entry;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Basic action controller which will return json responses instead of
 * html views 
 * 
 * @author Steve
 *
 */
class EntryController extends AbstractActionController
{  
    /*
     * If an id is passed to the route, then this will return an array containing only that entry
     * If no id, all entry will be listed
     */
    public function listAction()
    {
        $id = $this->params()->fromRoute('id');
        $result = [];
        if($id != null)
        {
            $result = [$this->getEntryMapper()->find($id)];
        }
        else 
        {
            $result = $this->getEntryMapper()->findAll();
        }
        return new JsonModel($result);
    }
    
    /*
     * Remove the entry represented by the id given
     */
    public function removeAction()
    {
        $id = $this->params()->fromRoute('id');
        $result = [];
        if($id != null)
        {
            $entry = $this->getEntryMapper()->find($id);
            if($entry != null)
            {
                $this->getEntryMapper()->remove($entry);
                $result = [$entry];
            }
        }
        return new JsonModel($result);
    }
    
    /*
     * Add a new entry given the POST "text" parameter
     * No validation happens for simplicity sake
     */
    public function addAction()
    {
        /* @var $entry Entry */
        $entry = $this->getServiceLocator()->get('DemoEntry');
        $entry->text = $this->params()->fromPost('text');
        $this->getEntryMapper()->save($entry);
        return new JsonModel([$entry]);
    }
    
    private $entryMapper = null;

    /**
     * @return EntryMapper
     */
    protected function getEntryMapper()
    {
        if($this->entryMapper == null)
            $this->entryMapper = $this->getServiceLocator()->get('DemoEntryMapper');
        return $this->entryMapper;
    }
}

