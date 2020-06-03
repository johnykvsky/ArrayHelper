<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ArrayHelperTest extends TestCase
{
    private $inputArray = ['johny' => ['age' => 30, 'weight' => 70], 'chris' => ['height' => 170]];
    private $updateArray = ['hobby' => [['music' => 'rock']]];

    public function testMerge()
    {
        $result = johnykvsky\Utils\ArrayHelper::merge($this->inputArray, $this->updateArray);
        $expected = [
            'johny' => ['age' => 30, 'weight' => '70'],
            'chris' => ['height' => 170],
            'hobby' => [['music' => 'rock']],
        ];
        $this->assertEquals($expected, $result);
    }

    public function testIsAssocTrue()
    {
        $array = ['foo' => 'bar'];
        $this->assertEquals(true, johnykvsky\Utils\ArrayHelper::isAssoc($array));
    }

    public function testCombine()
    {
        $array = ['foo' => 'bar'];
        $array2 = ['foo2' => 'bar2'];
        $this->assertEquals(['foo' => 'bar', 'bar2'], johnykvsky\Utils\ArrayHelper::combine($array, $array2));
    }

    public function testFirstValue()
    {
        $array = ['foo' => 'bar', 'foo2' => 'bar2'];
        $this->assertEquals('bar', johnykvsky\Utils\ArrayHelper::firstValue($array));
        $this->assertEquals(['foo' => 'bar', 'foo2' => 'bar2'], $array);
    }

    public function testLastValue()
    {
        $array = ['foo' => 'bar', 'foo2' => 'bar2'];
        $this->assertEquals('bar2', johnykvsky\Utils\ArrayHelper::lastValue($array));
        $this->assertEquals(['foo' => 'bar', 'foo2' => 'bar2'], $array);
    }

    public function testIsAssocFalse()
    {
        $array = ['foo', 'bar'];
        $this->assertEquals(false, johnykvsky\Utils\ArrayHelper::isAssoc($array));
    }

    public function testMergeNotAssociative()
    {
        $array1 = ['foo' => 'bar'];
        $array2 = [3, 5, 7];
        $result = johnykvsky\Utils\ArrayHelper::mergeNonAssociative($array1, $array2);
        $expected = ['foo' => 'bar', 3, 5, 7];
        $this->assertEquals($expected, $result);
    }

    public function testMergeAssociativeDeepMerge()
    {
        $array1 = ['foo' => ['arj' => 'pak']];
        $array2 = ['foo' => ['tar' => 'zip']];
        $result = johnykvsky\Utils\ArrayHelper::mergeAssociative($array1, $array2);
        $expected = ['foo' => ['arj' => 'pak', 'tar' => 'zip']];
        $this->assertEquals($expected, $result);
    }

    public function testMergeAssociativeNonDeepMerge()
    {
        $array1 = ['foo' => ['arj' => 'pak']];
        $array2 = ['foo' => ['tar' => 'zip']];
        $result = johnykvsky\Utils\ArrayHelper::mergeAssociative($array1, $array2, false);
        $expected = ['foo' => ['tar' => 'zip']];
        $this->assertEquals($expected, $result);
    }

    public function testMergeAssociativeWithoutKeys()
    {
        $array1 = ['foo', 'arj', 'pak'];
        $array2 = ['bar', 'tar', 'zip'];
        $result = johnykvsky\Utils\ArrayHelper::mergeAssociative($array1, $array2);
        $expected = ['foo', 'arj', 'pak', 'bar', 'tar', 'zip'];
        $this->assertEquals($expected, $result);
    }
}
