<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

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

        $html = file_get_contents('http://api.symfony.com/3.2/');

        $crawler = new Crawler($html);
        $nodeLinks = $crawler->filter('div.namespace-container > ul > li > a');

        foreach ($nodeLinks as $item) {
            $url = 'http://api.symfony.com/3.2/'.$item->getAttribute('href');

            var_dump($item->nodeName);
            var_dump($item->textContent);
            var_dump($url);

            $html_namespace = file_get_contents($url);
            $crawlerClass= new Crawler($html_namespace);
            $nodeClasses = $crawlerClass->filter(
                 'div#page-content > div.container-fluid.underlined > div.row > div.col-md-6 > a');

            foreach($nodeClasses as $itemClass) {
                var_dump("Класс");

                var_dump($itemClass->nodeName);
                var_dump($itemClass->textContent);
                var_dump($itemClass->getAttribute('href'));
            }

            $crawlerInterface = new Crawler($html_namespace);
            $nodeInterfaces = $crawlerInterface->filter(
                'div#page-content > div.container-fluid.underlined > div.row > div.col-md-6 > em > a');

            foreach($nodeInterfaces as $itemInterface) {
                var_dump("Интерфейс");

                var_dump($itemInterface->nodeName);
                var_dump($itemInterface->textContent);
                var_dump($itemInterface->getAttribute('href'));
            }

        }
    }
}