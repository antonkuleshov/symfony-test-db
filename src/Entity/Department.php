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
     * @ORM\ManyToMany(targetEntity="Employee", mappedBy="deptNoManager")
     */
    private $empNoManager;

    private $fromDate;
    private $toDate;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->empNo = new ArrayCollection();
        $this->empNoManager = new ArrayCollection();
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
    public function getEmpNoManager(): Collection
    {
        return $this->empNoManager;
    }

    public function addEmpNoManager(Employee $empNoManager): self
    {
        if (!$this->empNoManager->contains($empNoManager)) {
            $this->empNoManager[] = $empNoManager;
            $empNoManager->addDeptNoTwo($this);
        }

        return $this;
    }

    public function removeEmpNoManager(Employee $empNoManager): self
    {
        if ($this->empNoManager->contains($empNoManager)) {
            $this->empNoManager->removeElement($empNoManager);
            $empNoManager->removeDeptNoTwo($this);
        }

        return $this;
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
}
