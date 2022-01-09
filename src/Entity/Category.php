<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isShow = false;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDelete = false;

    /**
     * @ORM\OneToMany(targetEntity=Base::class, mappedBy="category")
     */
    private $bases;

    public function __construct()
    {
        $this->bases = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIsShow(): ?bool
    {
        return $this->isShow;
    }

    public function setIsShow(bool $isShow): self
    {
        $this->isShow = $isShow;

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

    /**
     * @return Collection|Base[]
     */
    public function getBases(): Collection
    {
        return $this->bases;
    }

    public function addBasis(Base $basis): self
    {
        if (!$this->bases->contains($basis)) {
            $this->bases[] = $basis;
            $basis->setCategory($this);
        }

        return $this;
    }

    public function removeBasis(Base $basis): self
    {
        if ($this->bases->removeElement($basis)) {
            // set the owning side to null (unless already changed)
            if ($basis->getCategory() === $this) {
                $basis->setCategory(null);
            }
        }

        return $this;
    }
}
