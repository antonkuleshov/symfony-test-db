<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Departments
 *
 * @ORM\Table(name="departments", uniqueConstraints={@ORM\UniqueConstraint(name="dept_name", columns={"dept_name"})})
 * @ORM\Entity
 */
class Departments
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
     * @ORM\ManyToMany(targetEntity="Employees", mappedBy="deptNo")
     */
    private $empNo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Employees", mappedBy="deptNoTwo")
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
     * @return Collection|Employees[]
     */
    public function getEmpNo(): Collection
    {
        return $this->empNo;
    }

    public function addEmpNo(Employees $empNo): self
    {
        if (!$this->empNo->contains($empNo)) {
            $this->empNo[] = $empNo;
            $empNo->addDeptNo($this);
        }

        return $this;
    }

    public function removeEmpNo(Employees $empNo): self
    {
        if ($this->empNo->contains($empNo)) {
            $this->empNo->removeElement($empNo);
            $empNo->removeDeptNo($this);
        }

        return $this;
    }

    /**
     * @return Collection|Employees[]
     */
    public function getEmpNoTwo(): Collection
    {
        return $this->empNoTwo;
    }

    public function addEmpNoTwo(Employees $empNoTwo): self
    {
        if (!$this->empNoTwo->contains($empNoTwo)) {
            $this->empNoTwo[] = $empNoTwo;
            $empNoTwo->addDeptNoTwo($this);
        }

        return $this;
    }

    public function removeEmpNoTwo(Employees $empNoTwo): self
    {
        if ($this->empNoTwo->contains($empNoTwo)) {
            $this->empNoTwo->removeElement($empNoTwo);
            $empNoTwo->removeDeptNoTwo($this);
        }

        return $this;
    }

}
