<?php

namespace Melody\Validation\Common;

class CollectionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Melody\Validation\Common\Collections\Collection
     */
    private $coll;

    protected function setUp()
    {
        $this->coll = new \Melody\Validation\Common\Collections\ArrayCollection;
    }

    public function testIssetAndUnset()
    {
        $this->assertFalse(isset($this->coll[0]));
        $this->coll->add('testing');
        $this->assertTrue(isset($this->coll[0]));
        unset($this->coll[0]);
        $this->assertFalse(isset($this->coll[0]));
    }

    public function testToString()
    {
        $this->coll->add('testing');
        $this->assertTrue(is_string((string) $this->coll));
    }

    public function testRemovingNonExistentEntryReturnsNull()
    {
        $this->assertEquals(null, $this->coll->remove('testing_does_not_exist'));
    }

    public function testExists()
    {
        $this->coll->add("one");
        $this->coll->add("two");
        $exists = $this->coll->exists(function ($k, $e) {
            return $e == "one";

        });
        $this->assertTrue($exists);
        $exists = $this->coll->exists(function ($k, $e) {
            return $e == "other";

        });
        $this->assertFalse($exists);
    }

    public function testMap()
    {
        $this->coll->add(1);
        $this->coll->add(2);
        $res = $this->coll->map(function ($e) {
            return $e * 2;

        });
        $this->assertEquals(array(2, 4), $res->toArray());
    }

    public function testFilter()
    {
        $this->coll->add(1);
        $this->coll->add("foo");
        $this->coll->add(3);
        $res = $this->coll->filter(function ($e) {
            return is_numeric($e);

        });
        $this->assertEquals(array(0 => 1, 2 => 3), $res->toArray());
    }

    public function testFirstAndLast()
    {
        $this->coll->add('one');
        $this->coll->add('two');

        $this->assertEquals($this->coll->first(), 'one');
        $this->assertEquals($this->coll->last(), 'two');
    }

    public function testArrayAccess()
    {
        $this->coll[] = 'one';
        $this->coll[] = 'two';

        $this->assertEquals($this->coll[0], 'one');
        $this->assertEquals($this->coll[1], 'two');

        unset($this->coll[0]);
        $this->assertEquals($this->coll->count(), 1);
    }

    public function testContainsKey()
    {
        $this->coll[5] = 'five';
        $this->assertTrue($this->coll->containsKey(5));
    }

    public function testContains()
    {
        $this->coll[0] = 'test';
        $this->assertTrue($this->coll->contains('test'));
    }

    public function testSearch()
    {
        $this->coll[0] = 'test';
        $this->assertEquals(0, $this->coll->indexOf('test'));
    }

    public function testGet()
    {
        $this->coll[0] = 'test';
        $this->assertEquals('test', $this->coll->get(0));
    }

    public function testGetKeys()
    {
        $this->coll[] = 'one';
        $this->coll[] = 'two';
        $this->assertEquals(array(0, 1), $this->coll->getKeys());
    }

    public function testGetValues()
    {
        $this->coll[] = 'one';
        $this->coll[] = 'two';
        $this->assertEquals(array('one', 'two'), $this->coll->getValues());
    }

    public function testCount()
    {
        $this->coll[] = 'one';
        $this->coll[] = 'two';
        $this->assertEquals($this->coll->count(), 2);
        $this->assertEquals(count($this->coll), 2);
    }

    public function testForAll()
    {
        $this->coll[] = 'one';
        $this->coll[] = 'two';
        $this->assertEquals($this->coll->forAll(function ($k, $e) {
            return is_string($e);

        }), true);
        $this->assertEquals($this->coll->forAll(function ($k, $e) {
            return is_array($e);

        }), false);
    }

    public function testPartition()
    {
        $this->coll[] = true;
        $this->coll[] = false;
        $partition = $this->coll->partition(function ($k, $e) {
            return $e == true;

        });
        $this->assertEquals($partition[0][0], true);
        $this->assertEquals($partition[1][0], false);
    }

    public function testClear()
    {
        $this->coll[] = 'one';
        $this->coll[] = 'two';
        $this->coll->clear();
        $this->assertEquals($this->coll->isEmpty(), true);
    }

    public function testRemove()
    {
        $this->coll[] = 'one';
        $this->coll[] = 'two';
        $el = $this->coll->remove(0);

        $this->assertEquals('one', $el);
        $this->assertEquals($this->coll->contains('one'), false);
        $this->assertNull($this->coll->remove(0));
    }

    public function testRemoveElement()
    {
        $this->coll[] = 'one';
        $this->coll[] = 'two';

        $this->assertTrue($this->coll->removeElement('two'));
        $this->assertFalse($this->coll->contains('two'));
        $this->assertFalse($this->coll->removeElement('two'));
    }

    public function testSlice()
    {
        $this->coll[] = 'one';
        $this->coll[] = 'two';
        $this->coll[] = 'three';

        $slice = $this->coll->slice(0, 1);
        $this->assertInternalType('array', $slice);
        $this->assertEquals(array('one'), $slice);

        $slice = $this->coll->slice(1);
        $this->assertEquals(array(1 => 'two', 2 => 'three'), $slice);

        $slice = $this->coll->slice(1, 1);
        $this->assertEquals(array(1 => 'two'), $slice);
    }

    public function testKey()
    {
        $this->coll[1] = 'one';
        $this->coll[2] = 'two';
        $this->coll[3] = 'three';

        $this->assertEquals($this->coll->key(), 1);
    }

    public function testNext()
    {
        $this->coll[1] = 'one';
        $this->coll[2] = 'two';
        $this->coll[3] = 'three';

        $this->coll->next();

        $this->assertEquals($this->coll->key(), 2);
    }

    public function testCurrent()
    {
        $this->coll[1] = 'one';
        $this->coll[2] = 'two';
        $this->coll[3] = 'three';

        $this->coll->next();
        $this->coll->next();

        $this->assertEquals($this->coll->current(), 'three');
    }
}
