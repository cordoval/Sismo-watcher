<?php

/*
 * This file is part of Composer.
 *
 * (c) Luis Cordova <cordoval@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

function includeIfExists($file) {
    if (file_exists($file)) {
        return include $file;
    }
}

if ((!$loader = includeIfExists(__DIR__.'/../../../.composer/autoload.php')) && (!$loader = includeIfExists(__DIR__.'/../vendor/.composer/autoload.php'))) {
    die('You must set up the project dependencies, run the following commands:'.PHP_EOL.
        'curl -s http://getcomposer.org/installer | php'.PHP_EOL.
        'php composer.phar install'.PHP_EOL);
}

return $loader;