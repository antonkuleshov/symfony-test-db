<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Employees
 *
 * @ORM\Table(name="employees")
 * @ORM\Entity
 */
class Employees
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
     * @ORM\ManyToMany(targetEntity="Departments", inversedBy="empNo")
     * @ORM\JoinTable(name="dept_manager",
     *   joinColumns={
     *     @ORM\JoinColumn(name="emp_no", referencedColumnName="emp_no")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="dept_no", referencedColumnName="dept_no")
     *   }
     * )
     */
    private $deptNo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Departments", inversedBy="empNo")
     * @ORM\JoinTable(name="dept_emp",
     *   joinColumns={
     *     @ORM\JoinColumn(name="emp_no", referencedColumnName="emp_no")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="dept_no", referencedColumnName="dept_no")
     *   }
     * )
     */
    private $deptNoTwo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->deptNo = new ArrayCollection();
        $this->deptNoTwo = new ArrayCollection();
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
     * @return Collection|Departments[]
     */
    public function getDeptNo(): Collection
    {
        return $this->deptNo;
    }

    public function addDeptNo(Departments $deptNo): self
    {
        if (!$this->deptNo->contains($deptNo)) {
            $this->deptNo[] = $deptNo;
        }

        return $this;
    }

    public function removeDeptNo(Departments $deptNo): self
    {
        if ($this->deptNo->contains($deptNo)) {
            $this->deptNo->removeElement($deptNo);
        }

        return $this;
    }

    /**
     * @return Collection|Departments[]
     */
    public function getDeptNoTwo(): Collection
    {
        return $this->deptNoTwo;
    }

    public function addDeptNoTwo(Departments $deptNoTwo): self
    {
        if (!$this->deptNoTwo->contains($deptNoTwo)) {
            $this->deptNoTwo[] = $deptNoTwo;
        }

        return $this;
    }

    public function removeDeptNoTwo(Departments $deptNoTwo): self
    {
        if ($this->deptNoTwo->contains($deptNoTwo)) {
            $this->deptNoTwo->removeElement($deptNoTwo);
        }

        return $this;
    }

}
