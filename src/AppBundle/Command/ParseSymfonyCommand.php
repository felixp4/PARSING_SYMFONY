<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ParseSymfonyCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:parse-symfony')
            ->setDescription('Parsing site Symfony.')
            ->setHelp('This command allows you parsing sites ...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Site parser',
            '===========',
            ''
        ]);
    }
}