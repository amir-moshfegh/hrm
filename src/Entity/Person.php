<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=15)
     * @Assert\NotBlank(message="person.blank_firstName")
     * @Assert\Length(
     *     min="3", minMessage="person.too_short_firstname",
     *     max="15", maxMessage="person.too_long_firstname",
     *      )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=25)
     * @Assert\NotBlank(message="person.blank_lastName")
     * @Assert\Length(
     *     min="3", minMessage="person.too_short_lastName",
     *     max="25", maxMessage="person.too_long_lastName",
     *     )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageName;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $fatherName;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $birthPlace;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Assert\Date(message="person.birthDate")
     */
    private $birthDate;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $shsh;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $insuranceId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $accountId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $maritalStatus;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Email(message="person.email")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     * @Assert\Length(min="11", minMessage="person.too_short_phone")
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     */
    private $tel1;

    /**
     * @ORM\Column(type="string", length=11, nullable=true)
     * @Assert\Length(min="11", minMessage="person.too_short_phone")
     */
    private $sms;




    public function getId(): ?int
    {
        return $this->id;
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

    public function getFullName(): string
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImagePath(string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageFullPath(): string
    {
        return sprintf("/robust-assets/images/portrait/small/%s",
            $this->getImageName()
        );
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

    public function getFatherName(): ?string
    {
        return $this->fatherName;
    }

    public function setFatherName(?string $fatherName): self
    {
        $this->fatherName = $fatherName;

        return $this;
    }

    public function getBirthPlace(): ?string
    {
        return $this->birthPlace;
    }

    public function setBirthPlace(?string $birthPlace): self
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(?\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getShsh(): ?string
    {
        return $this->shsh;
    }

    public function setShsh(?string $shsh): self
    {
        $this->shsh = $shsh;

        return $this;
    }

    public function getInsuranceId(): ?string
    {
        return $this->insuranceId;
    }

    public function setInsuranceId(?string $insuranceId): self
    {
        $this->insuranceId = $insuranceId;

        return $this;
    }

    public function getAccountId(): ?int
    {
        return $this->accountId;
    }

    public function setAccountId(?int $accountId): self
    {
        $this->accountId = $accountId;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getMaritalStatus(): ?string
    {
        return $this->maritalStatus;
    }

    public function setMaritalStatus(?string $maritalStatus): self
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getTel1(): ?string
    {
        return $this->tel1;
    }

    public function setTel1(string $tel1): self
    {
        $this->tel1 = $tel1;

        return $this;
    }

    public function getSms(): ?string
    {
        return $this->sms;
    }

    public function setSms(string $sms): self
    {
        $this->sms = $sms;

        return $this;
    }


}
