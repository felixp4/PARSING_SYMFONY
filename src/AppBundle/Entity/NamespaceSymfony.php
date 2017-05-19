<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping As ORM;

/**
 * NamespaceSymfony
 *
 * @ORM\Entity()
 */
class NamespaceSymfony
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
     * @ORM\OneToMany(targetEntity="InterfaceSymfony", mappedBy="namespace")
     */
    private $interfaces;

    /**
     * @ORM\OneToMany(targetEntity="ClassSymfony", mappedBy="namespace")
     */
    private $classes;

    /**
     * NamespaceSymfony and ClassSymfony constructor
     */
    public function __construct()
    {
        $this->interfaces = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getInterfaces()
    {
        return $this->interfaces;
    }

    /**
     * @return mixed
     */
    public function getClasses()
    {
        return $this->classes;
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
     * @return NamespaceSymfony
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
     * @param NamespaceSymfony
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Add interface
     *
     * @param \AppBundle\Entity\InterfaceSymfony $interface
     *
     * @return NamespaceSymfony
     */
    public function addInterface(\AppBundle\Entity\InterfaceSymfony $interface)
    {
        $this->interfaces[] = $interface;

        return $this;
    }

    /**
     * Remove interface
     *
     * @param \AppBundle\Entity\InterfaceSymfony $interface
     */
    public function removeInterface(\AppBundle\Entity\InterfaceSymfony $interface)
    {
        $this->interfaces->removeElement($interface);
    }
}
