<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Employee
 *
 * @ORM\Table(name="employees")
 * @ORM\Entity(repositoryClass="App\Repository\EmployeeRepository")
 */
class Employee
{
    /**
     * @var int
     *
     * @ORM\Column(name="emp_no", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $empNo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="date", nullable=false)
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=14, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=16, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=0, nullable=false)
     */
    private $gender;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hire_date", type="date", nullable=false)
     */
    private $hireDate;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\DeptEmployee", mappedBy="employee", cascade={"persist","remove"}, fetch="EXTRA_LAZY")
     */
    private $departments;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\DeptManager", mappedBy="employee", cascade={"persist","remove"}, fetch="EXTRA_LAZY")
     */
    private $departmentsManagers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->departments = new ArrayCollection();
        $this->departmentsManagers = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->firstName . " " . $this->lastName;
    }

    public function getEmpNo(): ?int
    {
        return $this->empNo;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getHireDate(): ?\DateTimeInterface
    {
        return $this->hireDate;
    }

    public function setHireDate(\DateTimeInterface $hireDate): self
    {
        $this->hireDate = $hireDate;

        return $this;
    }

    /**
     * @return Collection|DeptEmployee[]
     */
    public function getDepartments(): Collection
    {
        return $this->departments;
    }

    public function addDepartments(DeptEmployee $departments): self
    {
        if (!$this->departments->contains($departments)) {
            $this->departments[] = $departments;
            $departments->setEmployee($this);
        }

        return $this;
    }

    public function removeDepartments(DeptEmployee $departments): self
    {
        if ($this->departments->contains($departments)) {
            $this->departments->removeElement($departments);
            // set the owning side to null (unless already changed)
            if ($departments->getEmployee() === $this) {
                $departments->setEmployee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|DeptManager[]
     */
    public function getDepartmentsManagers(): Collection
    {
        return $this->departmentsManagers;
    }

    public function addDepartmentsManager(DeptManager $departmentsManager): self
    {
        if (!$this->departmentsManagers->contains($departmentsManager)) {
            $this->departmentsManagers[] = $departmentsManager;
            $departmentsManager->setEmpNo($this);
        }

        return $this;
    }

    public function removedepartmentsManager(DeptManager $departmentsManager): self
    {
        if ($this->departmentsManagers->contains($departmentsManager)) {
            $this->departmentsManagers->removeElement($departmentsManager);
            // set the owning side to null (unless already changed)
            if ($departmentsManager->getEmpNo() === $this) {
                $departmentsManager->setEmpNo(null);
            }
        }

        return $this;
    }
}
