<?php

/*
 * This file is part of Sismo Watcher.
 *
 * (c) Luis Cordova <cordoval@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace PHPPeru\SismoWatcher\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use PHPPeru\SismoWatcher\Command;
use PHPPeru\SismoWatcher\Command\Helper\DialogHelper;
use PHPPeru\SismoWatcher\SismoWatcher;
use PHPPeru\SismoWatcher\Factory;
use PHPPeru\SismoWatcher\IO\IOInterface;
use PHPPeru\SismoWatcher\IO\ConsoleIO;
use PHPPeru\SismoWatcher\Util\ErrorHandler;

/**
 * The console application that handles the commands
 *
 * @author Luis Cordova <cordoval@gmail.com>
 */
class Application extends BaseApplication
{
    protected $sismoWatcher;
    protected $io;

    public function __construct()
    {
        ErrorHandler::register();
        parent::__construct('SismoWatcher', SismoWatcher::VERSION);
    }

    /**
     * {@inheritDoc}
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        if (null === $output) {
            $styles['highlight'] = new OutputFormatterStyle('red');
            $styles['warning'] = new OutputFormatterStyle('black', 'yellow');
            $formatter = new OutputFormatter(null, $styles);
            $output = new ConsoleOutput(ConsoleOutput::VERBOSITY_NORMAL, null, $formatter);
        }

        return parent::run($input, $output);
    }

    /**
     * {@inheritDoc}
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->registerCommands();
        $this->io = new ConsoleIO($input, $output, $this->getHelperSet());

        return parent::doRun($input, $output);
    }

    /**
     * @return SismoWatcher
     */
    public function getSismoWatcher($required = true)
    {
        if (null === $this->sismoWatcher) {
            try {
                $this->sismoWatcher = Factory::create($this->io);
            } catch (\InvalidArgumentException $e) {
                if ($required) {
                    $this->io->write($e->getMessage());
                    exit(1);
                }

                return;
            }
        }

        return $this->sismoWatcher;
    }

    /**
     * @return IOInterface
     */
    public function getIO()
    {
        return $this->io;
    }

    /**
     * Initializes all the sismoWatcher commands
     */
    protected function registerCommands()
    {
        $this->add(new Command\WatchCommand());
    }

    /**
     * {@inheritDoc}
     */
    protected function getDefaultHelperSet()
    {
        $helperSet = parent::getDefaultHelperSet();

        $helperSet->set(new DialogHelper());

        return $helperSet;
    }
}