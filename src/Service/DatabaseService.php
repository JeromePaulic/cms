<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\HttpKernel\KernelInterface;

class DatabaseService
{
    public function __construct(
        private kernelInterface $kernel

    )
    {
    }

    public function createDatabase(): bool
    {
        $application = new Application($this->kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput([
            'command' => 'd:s:c'
        ]);

        $this->run($application, $input);

        $input = new ArrayInput([
            'command' => 'd:s:c',
            '--force' => true
        ]);

        $this->run($application, $input);

        $input = new ArrayInput([
            'command' => 'doctrine:fixtures:load',
            '--append' => true
        ]);

        $this->run($application, $input);

        return Command::SUCCESS;

    }

    private function run(Application $application, ArrayInput $input): bool
    {
        try {
            $result = $application->run($input);
        } catch (\Exception $e) {
            $result = false;
        }

        return $result;
    }
}