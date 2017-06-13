<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 13.06.17
 * Time: 9:44
 */

declare (strict_types=1);

namespace Tests\AppBundle\Util;

use AppBundle\Entity\ClassSymfony;
use AppBundle\Entity\NamespaceSymfony;
use PHPUnit\Framework\TestCase;

class ClassSymfonyTest extends TestCase
{
    public function testName()
    {
        $testName = 'Test 555';
        $cs = new ClassSymfony();
        $cs->setName($testName);
        $this->assertEquals($testName, $cs->getName());
    }

    public function testUrl()
    {
        $testUrl = 'http://example.com';
        $cs = new ClassSymfony();
        $cs->setUrl($testUrl);
        $this->assertEquals($testUrl, $cs->getUrl($testUrl));
    }

    public function testId()
    {
        $cs = new ClassSymfony();
        $this->assertEquals(null, $cs->getId());
    }

    public function testNamespace()
    {
        $testNamespace = new NamespaceSymfony();
        $cs = new ClassSymfony();
        $cs->setNamespace($testNamespace);
        $this->assertTrue($cs->getNamespace() instanceof NamespaceSymfony);
    }
}