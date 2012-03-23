<?php

namespace PHPPeru\Kata;

use Symfony\Component\ResourceWatcher\ResourceWatcher;
use Symfony\Component\ResourceWatcher\Event\Event;
use Symfony\Component\Config\Resource\DirectoryResource;
use Symfony\Component\Process\Process;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Watches resources and runs cli script when a php file changes.
 */
class Runner
{
    /**
     * @var string
     */
    protected $dir;

    public function __construct($dir)
    {
        $this->dir = realpath($dir);
    }

    public function run(OutputInterface $output)
    {
        $watcher = new ResourceWatcher();
        $watcher->track(new DirectoryResource(realpath($this->dir)), function ($event) use ($output) {
            $fileName = (string) $event->getResource();

            if (preg_match('/^(.*Bundle\/)(.*)(\.php)$/', $fileName, $matches)) {
                if ('Test' !== substr($matches[2], -4)) {
                    $fileName = $matches[1] . 'Tests/' . $matches[2] . 'Test' . $matches[3];
                }

                $process = new Process('develop ' . escapeshellarg($fileName), $this->dir . '/../');
                $process->run(function ($type, $data) use ($output) {
                    $output->writeln($data);
                });
            }
        });

        $watcher->start();
    }
}
