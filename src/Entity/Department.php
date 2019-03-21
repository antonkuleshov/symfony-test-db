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
     * @ORM\OneToMany(targetEntity="App\Entity\DeptEmployee", mappedBy="department", cascade={"persist","remove"}, fetch="EXTRA_LAZY")
     */
    private $employees;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\DeptManager", mappedBy="department", cascade={"persist","remove"}, fetch="EXTRA_LAZY")
     */
    private $employeesManagers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->employees = new ArrayCollection();
        $this->employeesManagers = new ArrayCollection();
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
     * @return Collection|DeptEmployee[]
     */
    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function addEmployees(DeptEmployee $employees): self
    {
        if (!$this->employees->contains($employees)) {
            $this->employees[] = $employees;
            $employees->setDepartment($this);
        }

        return $this;
    }

    public function removeEmployees(DeptEmployee $employees): self
    {
        if ($this->employees->contains($employees)) {
            $this->employees->removeElement($employees);
            // set the owning side to null (unless already changed)
            if ($employees->getDepartment() === $this) {
                $employees->setDepartment(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DeptManager[]
     */
    public function getEmployeesManagers(): Collection
    {
        return $this->employeesManagers;
    }

    public function addEmployeesManager(DeptManager $employeesManager): self
    {
        if (!$this->employeesManagers->contains($employeesManager)) {
            $this->employeesManagers[] = $employeesManager;
            $employeesManager->setDeptNo($this);
        }

        return $this;
    }

    public function removeEmployeesManager(DeptManager $employeesManager): self
    {
        if ($this->employeesManagers->contains($employeesManager)) {
            $this->employeesManagers->removeElement($employeesManager);
            // set the owning side to null (unless already changed)
            if ($employeesManager->getDeptNo() === $this) {
                $employeesManager->setDeptNo(null);
            }
        }

        return $this;
    }
}
