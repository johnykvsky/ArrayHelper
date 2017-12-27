# ArrayHelper

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

ArrayHelper - based on KohanaPHP Arr class.

## Install

Via Composer

``` bash
$ composer require johnykvsky/arrayhelper
```

## Usage

``` php
use johnykvsky\Utils\ArrayHelper;
$array = array('johny'=>array('age'=>30,'weight'=>70),'chris'=>array('height'=>170));
$result = ArrayHelper::getValue($array, 'johny.age'); //returns 30
$result = ArrayHelper::getValue($array, 'johny.height', 'Not set'); //missing, so returns default value "Not set"
$array = ArrayHelper::setValue($array, 'johny.age', 35); //updates age to 35
$array = ArrayHelper::setValue($array, 'barry.age', 25); //add age to Barry
$array2 = array('hobby'=>array(array('music'=>'rock')));
$result = ArrayHelper::merge($array, $array2); //merge arrays
$array3 = array('chris'=>array('weight'=>70));
$result = ArrayHelper::merge($array, $array2, true); //merge only keys that are in both arrays, Chris in this example

```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

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
