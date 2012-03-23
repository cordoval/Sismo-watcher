<?php

/*
 * This file is part of Composer.
 *
 * (c) Luis Cordova <cordoval@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPPeru\SismoWatcher\Command;

use Symfony\Component\Console\Command\Command as BaseCommand;

/**
 * Base class for SismoWatcher commands
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
abstract class Command extends BaseCommand
{
    /**
     * @return \PHPPeru\SismoWatcher\SismoWatcher
     */
    protected function getSismoWatcher($required = true)
    {
        return $this->getApplication()->getSismoWatcher($required);
    }

    /**
     * @return \PHPPeru\SismoWatcher\IO\ConsoleIO
     */
    protected function getIO()
    {
        return $this->getApplication()->getIO();
    }
}