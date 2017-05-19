<?php

namespace AppBundle\Entity;

// use Dictrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping As ORM;

/**
 * ClassSymfony
 *
 * @ORM\Entity()
 */
class ClassSymfony
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string")
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity="NamespaceSymfony", inversedBy="classes")
     */
    private $namespace;

    /**
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param mixed $namespace
     *
     * @return ClassSymfony
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return ClassSymfony
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @param ClassSymfony
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}
