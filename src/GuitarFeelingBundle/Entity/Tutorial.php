<?php

namespace GuitarFeelingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tutorial
 *
 * @ORM\Table(name="tutorial")
 * @ORM\Entity(repositoryClass="GuitarFeelingBundle\Repository\TutorialRepository")
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

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
     * @ORM\ManyToOne(targetEntity="GuitarFeelingBundle\Entity\TutorialCategory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;
    
    /**
     * @ORM\ManyToOne(targetEntity="GuitarFeelingBundle\Entity\TutorialLevel")
     * @ORM\JoinColumn(nullable=false)
     */
    private $level;

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
}