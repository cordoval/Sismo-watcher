<?php

/*
 * This file is part of Composer.
 *
 * (c) Luis Cordova <cordoval@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPPeru\SismoWatcher;

use PHPPeru\SismoWatcher\IO\IOInterface;

/**
 * Creates an configured instance of SismoWatcher.
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
class Factory
{
    /**
     * Creates a SismoWatcher instance
     *
     * @return SismoWatcher
     */
    public function createSismoWatcher(IOInterface $io, $sismoWatcherFile = null)
    {
        // initialize sismo-watcher
        $sismoWatcher = new SismoWatcher();

        return $sismoWatcher;
    }



    static public function create(IOInterface $io, $sismoWatcherFile = null)
    {
        $factory = new static();

        return $factory->createSismoWatcher($io, $sismoWatcherFile);
    }
}