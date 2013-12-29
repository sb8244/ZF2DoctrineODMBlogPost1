<?php

namespace Demo\Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Basic Entity which just contains publicly accessible variables.
 * Validation will be covered in future tutorials
 * 
 * @ODM\Document(collection="entry")
 * @author Steve
 */
class Entry
{
    /**
     * @ODM\Id
     */
    public $_id;
    
    /**
     * @ODM\Field(type="string")
     */
    public $text;
}