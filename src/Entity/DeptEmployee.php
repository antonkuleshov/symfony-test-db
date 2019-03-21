<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="dept_emp")
 * @ORM\Entity
 */
class DeptEmployee
{
    /**
     * @ORM\Column(name="from_date", type="date", nullable=true)
     */
    private $fromDate;

    /**
     * @ORM\Column(name="to_date", type="date", nullable=true)
     */
    private $toDate;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="departments", cascade={"persist","remove"}, fetch="LAZY")
     * @ORM\JoinColumn(name="emp_no", referencedColumnName="emp_no")
     */
    private $employee;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="App\Entity\Department", inversedBy="employees", cascade={"persist"}, fetch="LAZY")
     * @ORM\JoinColumn(name="dept_no", referencedColumnName="dept_no")
     */
    private $department;

    public function __toString()
    {
        return $this->employee . " " . $this->department;
    }

    public function getFromDate(): ?\DateTimeInterface
    {
        return $this->fromDate;
    }

    public function setFromDate(\DateTimeInterface $fromDate): self
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    public function getToDate(): ?\DateTimeInterface
    {
        return $this->toDate;
    }

    public function setToDate(\DateTimeInterface $toDate): self
    {
        $this->toDate = $toDate;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }
}
