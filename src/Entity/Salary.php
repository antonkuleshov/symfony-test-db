<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salary
 *
 * @ORM\Table(name="salaries", indexes={@ORM\Index(name="IDX_E6EEB84BA2F57F47", columns={"emp_no"})})
 * @ORM\Entity
 */
class Salary
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="from_date", type="date", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $fromDate;

    /**
     * @var int
     *
     * @ORM\Column(name="salary", type="integer", nullable=false)
     */
    private $salary;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="to_date", type="date", nullable=false)
     */
    private $toDate;

    /**
     * @var Employee
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Employee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="emp_no", referencedColumnName="emp_no")
     * })
     */
    private $empNo;

    public function getFromDate(): ?\DateTimeInterface
    {
        return $this->fromDate;
    }

    public function getSalary(): ?int
    {
        return $this->salary;
    }

    public function setSalary(int $salary): self
    {
        $this->salary = $salary;

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

    public function getEmpNo(): ?Employee
    {
        return $this->empNo;
    }

    public function setEmpNo(?Employee $empNo): self
    {
        $this->empNo = $empNo;

        return $this;
    }


}
