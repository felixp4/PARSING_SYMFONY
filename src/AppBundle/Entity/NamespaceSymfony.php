<?php

declare(strict_types=1);

Namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    public function getInterfaces(): ArrayCollection
    {
        return $this->interfaces;
    }

    /**
     * @return mixed
     */
    public function getClasses(): ArrayCollection
    {
        return $this->classes;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return NamespaceSymfony
     */
    public function setName(string $name): NamespaceSymfony
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): string
    {
        return (string) $this->url;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return NamespaceSymfony
     */
    public function setUrl(string $url): NamespaceSymfony
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Add interface
     *
     * @param \AppBundle\Entity\InterfaceSymfony $interface
     *
     * @return NamespaceSymfony
     */
    public function addInterface(InterfaceSymfony $interface): NamespaceSymfony
    {
        $this->interfaces[] = $interface;

        return $this;
    }

    /**
     * Remove interface
     *
     * @param \AppBundle\Entity\InterfaceSymfony $interface
     */
    public function removeInterface(InterfaceSymfony $interface)
    {
        $this->interfaces->removeElement($interface);
    }
}
