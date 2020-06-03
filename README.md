# ArrayHelper

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

ArrayHelper - based on KohanaPHP Arr class. Proper merge, without surprises - see usage for example.

## Install

Via Composer

``` bash
$ composer require johnykvsky/arrayhelper
```

Should work fine on PHP 5.6, but I didn't check that. Just change required PHP version in composer.json and maybe remove dev packages. And type hinting from code.

## Usage

``` php
use johnykvsky\Utils\ArrayHelper;
$array = array('johny'=>array('age'=>30,'weight'=>70),'chris'=>array('height'=>170));
$array2 = array('hobby'=>array(array('music'=>'rock')));

$result = ArrayHelper::merge($array, $array2); //merge arrays

$array3 = array('chris'=>array('weight'=>70));
$array1 = array('fragment' => 'x', 'attributes' => array('title' => 'X', 'class' => array('a', 'b')));
$array2 = array('fragment' => 'y', 'attributes' => array('title' => 'Y', 'class' => array('c', 'd')));

$result = ArrayHelper::merge($array1, $array2); //deep merge, fragment = y / attributes: title = Y / class = a,b,c,d
$result = ArrayHelper::merge($array1, $array2, false); //non-deep, fragment = y / attributes title = Y / class = c,d

//potential problem with array_merge_recursive:
$incorrect = array_merge_recursive($array1, $array2);
//result is array('fragment' => array('x', 'y'), 'attributes' => array('title' => array('X', 'Y'), 'class' => array('a', 'b', 'c', 'd'))).

$array4 = ['foo' , 'arj','pak'];
$array5 = ['foo' => 'tar', 'baz'=>'zip'];
//combine - get all values from array5 into array4
$result = ArrayHelper::combine($array4, $array5);
//result is ['foo','arj','pak','tar','zip']

$foo = ArrayHelper::firstValue($array5); // tar
$baz = ArrayHelper::lastValue($array5); // zip

```

## Testing

``` bash
$ composer test
```

## Code checking

``` bash
$ composer phpstan
$ composer phpstan-max
```

## Security

If you discover any security related issues, please email johnykvsky@protonmail.com instead of using the issue tracker.

## Credits

- [johnykvsky][link-author]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/johnykvsky/ArrayHelper.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/johnykvsky/ArrayHelper/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/johnykvsky/ArrayHelper.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/johnykvsky/ArrayHelper.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/johnykvsky/ArrayHelper.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/johnykvsky/ArrayHelper
[link-travis]: https://travis-ci.org/johnykvsky/ArrayHelper
[link-scrutinizer]: https://scrutinizer-ci.com/g/johnykvsky/ArrayHelper/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/johnykvsky/ArrayHelper
[link-downloads]: https://packagist.org/packages/johnykvsky/ArrayHelper
[link-author]: https://github.com/johnykvsky
