<?php

use PHPUnit\Framework\TestCase;

class ArrayHelperTest extends TestCase
{
    private $inputArray = array('johny'=>array('age'=>30,'weight'=>70),'chris'=>array('height'=>170));
    private $updateArray = array('hobby'=>array(array('music'=>'rock')));

    public function testGetValueSuccess()
    {
        $result = johnykvsky\Utils\ArrayHelper::getValue($this->inputArray, 'johny.age');
        $this->assertEquals(30, $result);
    }

    public function testGetValueFail()
    {
        $result = johnykvsky\Utils\ArrayHelper::getValue($this->inputArray, 'johny.height');
        $this->assertEquals(null, $result);
    }

    public function testSetExistingValue()
    {
        $result = johnykvsky\Utils\ArrayHelper::setValue($this->inputArray, 'johny.age', 35);
        $expected = array('johny'=>array('age'=>35,'weight'=>'70'),'chris'=>array('height'=>170));
        $this->assertEquals($expected, $result);
    }

    public function testSetNewValue()
    {
        $result = johnykvsky\Utils\ArrayHelper::setValue($this->inputArray, 'barry.age', 25);
        $expected = array('johny'=>array('age'=>30,'weight'=>70),'chris'=>array('height'=>170), 'barry'=>array('age'=>25));
        $this->assertEquals($expected, $result);
    }

    public function testUnsetValueSuccess()
    {
        johnykvsky\Utils\ArrayHelper::unsetValue($this->inputArray, 'johny.age');
        $expected = array('johny'=>array('weight'=>70),'chris'=>array('height'=>170));
        $this->assertEquals($expected, $this->inputArray);
    }

    public function testUnsetValueFail()
    {
        johnykvsky\Utils\ArrayHelper::unsetValue($this->inputArray, 'johny.height');
        $expected = array('johny'=>array('age'=>30,'weight'=>70),'chris'=>array('height'=>170));
        $this->assertEquals($expected, $this->inputArray);
    }

    public function testMerge()
    {
        $result = johnykvsky\Utils\ArrayHelper::merge($this->inputArray, $this->updateArray);
        $expected = array('johny'=>array('age'=>30,'weight'=>'70'),'chris'=>array('height'=>170),'hobby'=>array(array('music'=>'rock')));
        $this->assertEquals($expected, $result);
    }

    public function testIsAssocTrue()
    {
        $array = array('foo' => 'bar');
        $this->assertEquals(johnykvsky\Utils\ArrayHelper::isAssoc($array), true);
    }

    public function testIsAssocFalse()
    {
        $array = array('foo', 'bar');
        $this->assertEquals(johnykvsky\Utils\ArrayHelper::isAssoc($array), false);
    }

    public function testEmptyInput()
    {
        $this->assertEquals(null, johnykvsky\Utils\ArrayHelper::getValue(null, 'test'));
    }

    public function testBadInput()
    {
        $this->assertEquals(null, johnykvsky\Utils\ArrayHelper::getValue(123, 'test'));
    }

    public function testBadSetValue()
    {
        $this->assertEquals(array('foo' => 'bar'), johnykvsky\Utils\ArrayHelper::setValue(123, 'foo', 'bar'));
    }

    public function testMergeNotAssociative()
    {
        $array1 = array('foo' => 'bar');
        $array2 = array(3,5,7);
        $result = johnykvsky\Utils\ArrayHelper::merge($array1, $array2);
        $expected = array('foo' => 'bar', 3, 5, 7);
        $this->assertEquals($expected, $result);
    }

    public function testDeepMerge()
    {
        $array1 = array('foo' => array('arj' => 'pak'));
        $array2 = array('foo' => array('tar' => 'zip'));
        $result = johnykvsky\Utils\ArrayHelper::merge($array1, $array2);
        $expected = array('foo' => array('arj' => 'pak', 'tar' => 'zip'));
        $this->assertEquals($expected, $result);
    }

    public function testNonDeepMerge()
    {
        $array1 = array('foo' => array('arj' => 'pak'));
        $array2 = array('foo' => array('tar' => 'zip'));
        $result = johnykvsky\Utils\ArrayHelper::merge($array1, $array2, false);
        $expected = array('foo' => array('tar' => 'zip'));
        $this->assertEquals($expected, $result);
    }
}
