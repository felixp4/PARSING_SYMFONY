<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 12.06.17
 * Time: 10:42
 */

declare (strict_types=1);

namespace Tests\AppBundle\Util;

use AppBundle\Entity\NamespaceSymfony;
use AppBundle\Entity\ClassSymfony;
use AppBundle\Entity\InterfaceSymfony;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Doctrine\Common\Collections\ArrayCollection;

class NamespaceSymfonyTest extends TestCase
{
    public function testName()
    {
        $testName = 'Test 100';
        $ns = new NamespaceSymfony();
        $ns->setName($testName);
        $this->assertEquals($testName, $ns->getName());
    }

    public function testUrl()
    {
        $testUrl = 'http://example.com';
        $ns = new NamespaceSymfony();
        $ns->setUrl($testUrl);
        $this->assertEquals($testUrl, $ns->getUrl());
    }

    public function testId()
    {
        $ns = new NamespaceSymfony();
        $this->assertEquals(null, $ns->getId());
    }

    public function testParentNamespace()
    {
        $testParentNamespace = new NamespaceSymfony();
        $ns = new NamespaceSymfony();
        $ns->setParent($testParentNamespace);
        $this->assertEquals($testParentNamespace, $ns->getParent());
    }

    public function testClasses()
    {
        $testClass = new ClassSymfony();
        $ns = new NamespaceSymfony();

        $ns->addClass($testClass);

        $this->assertEquals(1, count($ns->getClasses()));
        $this->assertTrue(is_a(($ns->getClasses()), 'Doctrine\Common\Collections\ArrayCollection'));
        $this->assertTrue($ns->getClasses() instanceof ArrayCollection);
        $this->assertTrue(gettype($ns->getClasses()) == 'object');

        $ns->removeClass($testClass);
        $this->assertEquals(0, count($ns->getClasses()));
    }

    public function testInterfaces()
    {
        $testInterface = new InterfaceSymfony();
        $ns = new NamespaceSymfony();

        $ns->addInterface($testInterface);
        $this->assertTrue(gettype($ns->getInterfaces()) == 'object');

        $ns->removeInterface($testInterface);
        $this->assertEquals(0, count($ns->getInterfaces()));
    }

    public function testChildren()
    {
        $testChildren = new NamespaceSymfony();
        $ns = new NamespaceSymfony();

        $ns->addChildren($testChildren);
        $this->assertTrue(gettype($ns->getChildren()) == 'object');

        $ns->removeChildren($testChildren);
        $this->assertEquals(0, count($ns->getChildren()));
    }

}