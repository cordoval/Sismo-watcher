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

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PHPPeru\SismoWatcher\Runner;

/**
 * SismoWatcher Watch command
 *
 * @autor Luis Cordova <cordoval@gmail.com>
 */
class WatchCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('watch')
            ->setDescription('Sismo watch command. Useful to run an auto-run script.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sismoWatcher = $this->getSismoWatcher();
        $io = $this->getIO();
        $runner = new Runner(__DIR__.'/src');
        $runner->run($output);
    }
}