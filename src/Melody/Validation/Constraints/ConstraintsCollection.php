<?php

/*
 * This file is distributed under BSD licence.
 */

namespace Melody\Validation\Constraints;

use Melody\Validation\Constraints\ConstraintsInterface;
use Melody\Validation\Exceptions\InvalidKeyException;

/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
class ConstraintsCollection implements \IteratorAggregate, \Countable
{
    protected $_constraints = array();

    /**
     * Optionally accept an array of items to use for the ConstraintsCollection, if provided
     * @params array $constraints (optional)
     */
    public function __construct($constraints = null)
    {
        if ($constraints !== null && is_array($constraints)) {
            $this->_constraints = $constraints;
        }
    }

    /**
     * Function to satisfy the IteratorAggregate interface.  Sets an
     * ArrayIterator instance for the server list to allow this class to be
     * iterable like an array.
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->_constraints);
    }

    /**
     * Function to satisfy the Countable interface, returns a count of the
     * length of the ConstraintsCollection
     * @return int the ConstraintsCollection length
     */
    public function count()
    {
        return $this->length();
    }

    /**
     * Function to add an item to the ConstraintsCollection, optionally specifying
     * the key to access the item with.  Returns the item passed in for
     * continuing work.
     * @param $constraint the object to add
     * @param $key the accessor key (optional)
     * @return mixed the item
     */
    public function add($constraint, $key = null)
    {
        if($key !== null) {
            $this->_constraints[$key] = $constraint;
        } else {
            $this->_constraints[] = $constraint;
        }

        return $constraint;
    }

    /**
     * Remove an item from the ConstraintsCollection identified by it's key
     * @param $key the identifying key of the item to remove
     */
    public function remove($key)
    {
        if(isset($this->_constraints[$key])) {
            unset($this->_constraints[$key]);
        } else {
            throw new InvalidKeyException("Invalid key $key specified.");
        }
    }

    /**
     * Retrieve an item from the ConstraintsCollection as identified by its key
     * @param $key the identifying key of the item to remove
     * @return item identified by the key
     */
    public function get($key)
    {
        if(isset($this->_constraints[$key])) {
            return $this->_constraints[$key];
        } else {
            throw new InvalidKeyException("Invalid key $key specified.");
        }
    }

    /**
     * Function to return the entire list of servers as an array
     * of Server objects
     * @return array
     */
    public function getAll()
    {
        return $this->_constraints;
    }

    /**
     * Return the list of keys to all objects in the ConstraintsCollection
     * @return array an array of items
     */
    public function keys()
    {
        return array_keys($this->_constraints);
    }

    /**
     * Return the length of the ConstraintsCollection of items
     * @return int the size of the collection
     */
    public function length()
    {
        return count($this->_constraints);
    }

    /**
     * Check if an item with the identified key exists in the ConstraintsCollection
     * @param $key the key of the item to check
     * @return bool if the item is in the Collection
     */
    public function exists($key)
    {
        return (isset($this->_constraints[$key]));
    }

}
