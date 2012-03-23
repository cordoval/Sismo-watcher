<?php

namespace PHPPeru\Kata;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use PHPPeru\Kata\Runner;

class SismoCommand
{
    protected function configure()
    {
        $this
            ->setName('sismo:watcher')
            ->setDescription('Sismo watcher command. Useful to run an auto-run script.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $runner = new Runner(__DIR__.'/src');
        $runner->run($output);
    }
}