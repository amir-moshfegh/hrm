<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoryRepository::class)
 */
class History
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $noticeNumber;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $noticeDate;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="histories")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Base::class, inversedBy="histories")
     */
    private $base;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDelete = false;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoticeNumber(): ?string
    {
        return $this->noticeNumber;
    }

    public function setNoticeNumber(?string $noticeNumber): self
    {
        $this->noticeNumber = $noticeNumber;

        return $this;
    }

    public function getNoticeDate(): ?\DateTimeInterface
    {
        return $this->noticeDate;
    }

    public function setNoticeDate(?\DateTimeInterface $noticeDate): self
    {
        $this->noticeDate = $noticeDate;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBase(): ?Base
    {
        return $this->base;
    }

    public function setBase(?Base $base): self
    {
        $this->base = $base;

        return $this;
    }

    public function getIsDelete(): ?bool
    {
        return $this->isDelete;
    }

    public function setIsDelete(bool $isDelete): self
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }
}
