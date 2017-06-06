<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;
use AppBundle\Entity\NamespaceSymfony;
use AppBundle\Entity\ClassSymfony;
use AppBundle\Entity\InterfaceSymfony;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class ParseSymfonyCommand extends ContainerAwareCommand
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

        $em = $this->getContainer()->get('doctrine')->getManager();

        $rootNamespaceSymfony  = new NamespaceSymfony();
        $rootNamespaceSymfony->setName('Symfony');
        $rootNamespaceSymfony->setUrl('http://api.symfony.com/3.2/Symfony.html');
        $rootNamespaceSymfony->setParent(null);

        $em->persist($rootNamespaceSymfony);

        $this->getNamespaceRecursion('http://api.symfony.com/3.2/Symfony.html', $rootNamespaceSymfony);

        /* $html = file_get_contents('http://api.symfony.com/3.2/');

        $crawler = new Crawler($html);
        $nodeLinks = $crawler->filter('div.namespace-container > ul > li > a');

        // $em = $this->getDoctrine()->getManager();
        $em = $this->getContainer()->get('doctrine')->getManager();

        foreach ($nodeLinks as $item) {
            $url = 'http://api.symfony.com/3.2/'.$item->getAttribute('href');

            var_dump($item->nodeName);
            var_dump($item->textContent);
            var_dump($url);

            $namespaceSymfony  = new NamespaceSymfony();
            $namespaceSymfony->setName($item->textContent);
            $namespaceSymfony->setUrl($url);

            $html_namespace = file_get_contents($url);
            $crawlerClass= new Crawler($html_namespace);
            $nodeClasses = $crawlerClass->filter(
                 'div#page-content > div.container-fluid.underlined > div.row > div.col-md-6 > a');

            foreach($nodeClasses as $itemClass) {
                var_dump("Класс");

                var_dump($itemClass->nodeName);
                var_dump($itemClass->textContent);
                var_dump($itemClass->getAttribute('href'));

                $classSymfony  = new ClassSymfony();
                $classSymfony->setName($itemClass->textContent);
                $classSymfony->setUrl($itemClass->getAttribute('href'));
                $classSymfony->setNamespace($namespaceSymfony);

                $em->persist($classSymfony);
            }

            $crawlerInterface = new Crawler($html_namespace);
            $nodeInterfaces = $crawlerInterface->filter(
                'div#page-content > div.container-fluid.underlined > div.row > div.col-md-6 > em > a');

            foreach($nodeInterfaces as $itemInterface) {
                var_dump("Интерфейс");

                var_dump($itemInterface->nodeName);
                var_dump($itemInterface->textContent);
                var_dump($itemInterface->getAttribute('href'));

                $interfaceSymfony  = new InterfaceSymfony();
                $interfaceSymfony->setName($itemInterface->textContent);
                $interfaceSymfony->setUrl($itemInterface->getAttribute('href'));
                $interfaceSymfony->setNamespace($namespaceSymfony);

                $em->persist($interfaceSymfony);
            }

            $em->persist($namespaceSymfony);
        }
        $em->flush(); */
    }

    public function getNamespaceRecursion(string $url, ?NamespaceSymfony $parent)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $html = file_get_contents($url);

        $crawler = new Crawler($html);
        $nodeNamespaces = $crawler->filter('div.namespace-list > a');

        foreach ($nodeNamespaces as $itemNamespace) {
            $url = 'http://api.symfony.com/3.2/'.str_replace('../', '', $itemNamespace->getAttribute('href'));

            var_dump($itemNamespace->nodeName);
            var_dump($itemNamespace->textContent);
            var_dump($url);

            $namespaceSymfony  = new NamespaceSymfony();
            $namespaceSymfony->setName($itemNamespace->textContent);
            $namespaceSymfony->setUrl($url);
            $namespaceSymfony->setParent($parent);

            $em->persist($namespaceSymfony);

            // parsing Classes
            $html_namespace = file_get_contents($url);
            $crawlerClass = new Crawler($html_namespace);
            $nodeClasses = $crawlerClass->filter(
                'div#page-content > div.container-fluid.underlined > div.row > div.col-md-6 > a');

            foreach ($nodeClasses as $itemClass) {
                var_dump("Класс");

                var_dump($itemClass->nodeName);
                var_dump($itemClass->textContent);
                var_dump($itemClass->getAttribute('href'));

                $classSymfony  = new ClassSymfony();
                $classSymfony->setName($itemClass->textContent);
                $classSymfony->setUrl($itemClass->getAttribute('href'));
                $classSymfony->setNamespace($namespaceSymfony);

                $em->persist($classSymfony);
            }

            // parsing Interfaces
            $crawlerInterface = new Crawler($html_namespace);
            $nodeInterfaces = $crawlerInterface->filter(
                'div#page-content > div.container-fluid.underlined > div.row > div.col-md-6 > em > a');

            foreach ($nodeInterfaces as $itemInterface) {
                var_dump("Интерфейс");

                var_dump($itemInterface->nodeName);
                var_dump($itemInterface->textContent);
                var_dump($itemInterface->getAttribute('href'));

                $interfaceSymfony  = new InterfaceSymfony();
                $interfaceSymfony->setName($itemInterface->textContent);
                $interfaceSymfony->setUrl($itemInterface->getAttribute('href'));
                $interfaceSymfony->setNamespace($namespaceSymfony);

                $em->persist($interfaceSymfony);
            }

            $this->getNamespaceRecursion($url, $namespaceSymfony);
            $em->flush();
        }
    }
}