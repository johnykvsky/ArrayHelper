<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ArrayHelperTest extends TestCase
{
    private $inputArray = ['johny'=>['age'=>30,'weight'=>70],'chris'=>['height'=>170]];
    private $updateArray = ['hobby'=>[['music'=>'rock']]];

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
