<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Titles
 *
 * @ORM\Table(name="titles", indexes={@ORM\Index(name="IDX_C14541A3A2F57F47", columns={"emp_no"})})
 * @ORM\Entity
 */
class Titles
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="from_date", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fromDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="to_date", type="date", nullable=true)
     */
    private $toDate;

    /**
     * @var \Employees
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emp_no", referencedColumnName="emp_no")
     * })
     */
    private $empNo;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getFromDate(): ?\DateTimeInterface
    {
        return $this->fromDate;
    }

    public function getToDate(): ?\DateTimeInterface
    {
        return $this->toDate;
    }

    public function setToDate(?\DateTimeInterface $toDate): self
    {
        $this->toDate = $toDate;

        return $this;
    }

    public function getEmpNo(): ?Employees
    {
        return $this->empNo;
    }

    public function setEmpNo(?Employees $empNo): self
    {
        $this->empNo = $empNo;

        return $this;
    }


}
