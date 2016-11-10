<?php

namespace GuitarFeelingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tutorial
 *
 * @ORM\Table(name="tutorial")
 * @ORM\Entity(repositoryClass="GuitarFeelingBundle\Repository\TutorialRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Tutorial
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
     * @ORM\Column(name="title", type="string", length=80)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(maxSize="500k")
     */
    public $picture;
        
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var text
     *
     * @ORM\Column(name="introduction", type="text")
     */
    private $introduction;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean", options={"default": false})
     */
    private $published;
    
    /**
     * @ORM\ManyToOne(targetEntity="GuitarFeelingBundle\Entity\TutorialCategory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;
    
    /**
     * @ORM\ManyToOne(targetEntity="GuitarFeelingBundle\Entity\TutorialLevel")
     * @ORM\JoinColumn(nullable=false)
     */
    private $level;

    public function __construct()
    {
       $this->published = false;
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Tutorial
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Set description
     *
     * @param string $description
     *
     * @return Tutorial
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Tutorial
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function initBeforePersist()
    {
       $this->setCreatedAt(new \DateTime());
       $this->setUpdatedAt(new \DateTime());
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Tutorial
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
       $this->setUpdatedAt(new \DateTime());
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set category
     *
     * @param \GuitarFeelingBundle\Entity\TutorialCategory $category
     *
     * @return Tutorial
     */
    public function setCategory(\GuitarFeelingBundle\Entity\TutorialCategory $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \GuitarFeelingBundle\Entity\TutorialCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set level
     *
     * @param \GuitarFeelingBundle\Entity\TutorialLevel $level
     *
     * @return Tutorial
     */
    public function setLevel(\GuitarFeelingBundle\Entity\TutorialLevel $level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return \GuitarFeelingBundle\Entity\TutorialLevel
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set introduction
     *
     * @param string $introduction
     *
     * @return Tutorial
     */
    public function setIntroduction($introduction)
    {
        $this->introduction = $introduction;

        return $this;
    }

    /**
     * Get introduction
     *
     * @return string
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Tutorial
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Tutorial
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }
}
