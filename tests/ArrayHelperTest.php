<?php

use PHPUnit\Framework\TestCase;

class ArrayHelperTest extends TestCase
{
    private $inputArray = ['johny'=>['age'=>30,'weight'=>70],'chris'=>['height'=>170]];
    private $updateArray = ['hobby'=>[['music'=>'rock']]];

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
        $expected = ['johny'=>['age'=>35,'weight'=>'70'],'chris'=>['height'=>170]];
        $this->assertEquals($expected, $result);
    }

    public function testSetNewValue()
    {
        $result = johnykvsky\Utils\ArrayHelper::setValue($this->inputArray, 'barry.age', 25);
        $expected = ['johny'=>['age'=>30,'weight'=>70],'chris'=>['height'=>170], 'barry'=>['age'=>25]];
        $this->assertEquals($expected, $result);
    }

    public function testUnsetValueSuccess()
    {
        johnykvsky\Utils\ArrayHelper::unsetValue($this->inputArray, 'johny.age');
        $expected = ['johny'=>['weight'=>70],'chris'=>['height'=>170]];
        $this->assertEquals($expected, $this->inputArray);
    }

    public function testUnsetValueFail()
    {
        johnykvsky\Utils\ArrayHelper::unsetValue($this->inputArray, 'johny.height');
        $expected = ['johny'=>['age'=>30,'weight'=>70],'chris'=>['height'=>170]];
        $this->assertEquals($expected, $this->inputArray);
    }

    public function testMerge()
    {
        $result = johnykvsky\Utils\ArrayHelper::merge($this->inputArray, $this->updateArray);
        $expected = ['johny'=>['age'=>30,'weight'=>'70'],'chris'=>['height'=>170],'hobby'=>[['music'=>'rock']]];
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
        $this->assertEquals(['foo' => 'bar','test'=> 'fine'], johnykvsky\Utils\ArrayHelper::setValue(['test'=> 'fine'], 'foo', 'bar'));
    }

    public function testMergeNotAssociative()
    {
        $array1 = ['foo' => 'bar'];
        $array2 = [3,5,7];
        $result = johnykvsky\Utils\ArrayHelper::merge($array1, $array2);
        $expected = ['foo' => 'bar', 3, 5, 7];
        $this->assertEquals($expected, $result);
    }

    public function testDeepMerge()
    {
        $array1 = ['foo' => ['arj' => 'pak']];
        $array2 = ['foo' => ['tar' => 'zip']];
        $result = johnykvsky\Utils\ArrayHelper::merge($array1, $array2);
        $expected = ['foo' => ['arj' => 'pak', 'tar' => 'zip']];
        $this->assertEquals($expected, $result);
    }

    public function testNonDeepMerge()
    {
        $array1 = ['foo' => ['arj' => 'pak']];
        $array2 = ['foo' => ['tar' => 'zip']];
        $result = johnykvsky\Utils\ArrayHelper::merge($array1, $array2, false);
        $expected = ['foo' => ['tar' => 'zip']];
        $this->assertEquals($expected, $result);
    }
}
