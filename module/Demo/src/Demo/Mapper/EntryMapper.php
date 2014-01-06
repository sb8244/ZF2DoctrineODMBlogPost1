<?php

namespace Demo\Mapper;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Demo\Entity\Entry;

/**
 * Basic Mapping class for Doctrine. This can be abstracted
 * into a GenericMapper which will be covered in future blog posts.
 * 
 * All methods are pretty self explanatory
 * 
 * @author Steve
 *
 */
class EntryMapper implements EntryMapperInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    protected $documentManager;
    
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    protected $repository;
    
	public function __construct(ObjectManager $documentManager,
				    ObjectRepository $repository)
	{
		$this->documentManager = $documentManager;
		$this->repository = $repository;
	}
	
	public function find($id)
	{
	    return $this->repository->find($id);
	}
	
	public function findAll()
	{
	    return $this->repository->findAll();
	}
	
	public function save(Entry $entity)
	{
	    $this->documentManager->persist($entity);
	    $this->documentManager->flush();
	}
	
	public function remove(Entry $entity)
	{
	    $this->documentManager->remove($entity);
	    $this->documentManager->flush();
	}
}
