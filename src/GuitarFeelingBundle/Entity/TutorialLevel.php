<?php

namespace GuitarFeelingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TutorialLevel
 *
 * @ORM\Table(name="tutorial_level")
 * @ORM\Entity(repositoryClass="GuitarFeelingBundle\Repository\TutorialLevelRepository")
 */
class TutorialLevel
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
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var smallint
     *
     * @ORM\Column(name="step", type="smallint")
     */
    private $step;

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
     * Set name
     *
     * @param string $name
     *
     * @return TutorialLevel
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set step
     *
     * @param integer $step
     *
     * @return TutorialLevel
     */
    public function setStep($step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step
     *
     * @return integer
     */
    public function getStep()
    {
        return $this->step;
    }
}
