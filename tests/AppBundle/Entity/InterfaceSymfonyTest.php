<?php

declare (strict_types=1);

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\InterfaceSymfony;
use AppBundle\Entity\NamespaceSymfony;
use PHPUnit\Framework\TestCase;

class InterfaceSymfonyTest extends TestCase
{
    public function testName()
    {
        $testName = 'Test 777';
        $is = new InterfaceSymfony();
        $is->setName($testName);
        $this->assertEquals($testName, $is->getName());
    }

    public function testUrl()
    {
        $testUrl = 'http://example.com';
        $is = new InterfaceSymfony();
        $is->setUrl($testUrl);
        $this->assertEquals($testUrl, $is->getUrl());
    }

    public function testId()
    {
        $is = new InterfaceSymfony();
        $this->assertEquals(null, $is->getId());
    }

    public function testNamespace()
    {
        $testNamespace = new NamespaceSymfony();
        $is = new InterfaceSymfony();
        $is->setNamespace($testNamespace);
        $this->assertTrue($is->getNamespace() instanceof NamespaceSymfony);
    }
}
