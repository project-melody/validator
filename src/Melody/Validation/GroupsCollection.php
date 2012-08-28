<?php

/*
 * This file is distributed under MIT licence.
 */

namespace Melody\Validation;

use Melody\Validation\Constraints\ConstraintsCollection;
/**
 * @author Marcelo Santos <marcelsud@gmail.com>
 */
class GroupsCollection implements \IteratorAggregate, \Countable
{
    protected $_groups = array();

    /**
     * Optionally accept an array of items to use for the GroupsCollection, if provided
     * @params array $groups (optional)
     */
    public function __construct($groups = null)
    {
        if ($groups !== null && is_array($groups)) {
            $this->_groups = $groups;
        }
    }

    /**
     * Function to satisfy the IteratorAggregate interface.  Sets an
     * ArrayIterator instance for the server list to allow this class to be
     * iterable like an array.
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->_groups);
    }

    /**
     * Function to satisfy the Countable interface, returns a count of the
     * length of the GroupsCollection
     * @return int the GroupsCollection length
     */
    public function count()
    {
        return $this->length();
    }

    /**
     * Function to add an item to the GroupsCollection, optionally specifying
     * the key to access the item with.  Returns the item passed in for
     * continuing work.
     * @param $group the object to add
     * @param $key the accessor key (optional)
     * @return mixed the item
     */
    public function add(ConstraintsCollection $group, $key = null)
    {
        if($key !== null) {
            $this->_groups[$key] = $group;
        } else {
            $this->_groups[] = $group;
        }

        return $group;
    }

    /**
     * Remove an item from the GroupsCollection identified by it's key
     * @param $key the identifying key of the item to remove
     */
    public function remove($key)
    {
        if(isset($this->_groups[$key])) {
            unset($this->_groups[$key]);
        } else {
            throw new \Exception("Invalid key $key specified.");
        }
    }

    /**
     * Retrieve an item from the GroupsCollection as identified by its key
     * @param $key the identifying key of the item to remove
     * @return item identified by the key
     */
    public function get($key)
    {
        if(isset($this->_groups[$key])) {
            return $this->_groups[$key];
        } else {
            throw new \Exception("Invalid key $key specified.");
        }
    }

    /**
     * Function to return the entire list of servers as an array
     * of Server objects
     * @return array
     */
    public function getAll()
    {
        return $this->_groups;
    }

    /**
     * Return the list of keys to all objects in the GroupsCollection
     * @return array an array of items
     */
    public function keys()
    {
        return array_keys($this->_groups);
    }

    /**
     * Return the length of the GroupsCollection of items
     * @return int the size of the collection
     */
    public function length()
    {
        return count($this->_groups);
    }

    /**
     * Check if an item with the identified key exists in the GroupsCollection
     * @param $key the key of the item to check
     * @return bool if the item is in the Collection
     */
    public function exists($key)
    {
        return (isset($this->_groups[$key]));
    }

}
