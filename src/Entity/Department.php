<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 *
 * @ORM\Table(name="departments", uniqueConstraints={@ORM\UniqueConstraint(name="dept_name", columns={"dept_name"})})
 * @ORM\Entity(repositoryClass="App\Repository\DepartmentRepository")
 */
class Department
{
    /**
     * @var string
     *
     * @ORM\Column(name="dept_no", type="string", length=4, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $deptNo;

    /**
     * @var string
     *
     * @ORM\Column(name="dept_name", type="string", length=40, nullable=false)
     */
    private $deptName;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Employee", mappedBy="deptNo")
     */
    private $empNo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Employee", mappedBy="deptNoTwo")
     */
    private $empNoTwo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->empNo = new ArrayCollection();
        $this->empNoTwo = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->deptName;
    }

    public function getDeptNo(): ?string
    {
        return $this->deptNo;
    }

    public function getDeptName(): ?string
    {
        return $this->deptName;
    }

    public function setDeptName(string $deptName): self
    {
        $this->deptName = $deptName;

        return $this;
    }

    /**
     * @return Collection|Employee[]
     */
    public function getEmpNo(): Collection
    {
        return $this->empNo;
    }

    public function addEmpNo(Employee $empNo): self
    {
        if (!$this->empNo->contains($empNo)) {
            $this->empNo[] = $empNo;
            $empNo->addDeptNo($this);
        }

        return $this;
    }

    public function removeEmpNo(Employee $empNo): self
    {
        if ($this->empNo->contains($empNo)) {
            $this->empNo->removeElement($empNo);
            $empNo->removeDeptNo($this);
        }

        return $this;
    }

    /**
     * @return Collection|Employee[]
     */
    public function getEmpNoTwo(): Collection
    {
        return $this->empNoTwo;
    }

    public function addEmpNoTwo(Employee $empNoTwo): self
    {
        if (!$this->empNoTwo->contains($empNoTwo)) {
            $this->empNoTwo[] = $empNoTwo;
            $empNoTwo->addDeptNoTwo($this);
        }

        return $this;
    }

    public function removeEmpNoTwo(Employee $empNoTwo): self
    {
        if ($this->empNoTwo->contains($empNoTwo)) {
            $this->empNoTwo->removeElement($empNoTwo);
            $empNoTwo->removeDeptNoTwo($this);
        }

        return $this;
    }

}
