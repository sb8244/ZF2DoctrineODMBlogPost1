<?php

namespace Demo\Mapper;

use Demo\Entity\Entry;

/**
 * This can be abstracted into a GenericMapperInterface and any Entry
 * specific mappings can be added into here. This will be covered in 
 * future posts
 * 
 * @author Steve
 *
 */
interface EntryMapperInterface
{
    public function find($id);
    public function findAll();
    public function save(Entry $entry);
    public function remove(Entry $entry);
}