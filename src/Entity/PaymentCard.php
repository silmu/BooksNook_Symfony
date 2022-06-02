<?php

namespace App\Entity;

use App\Repository\PaymentCardRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentCardRepository::class)]
class PaymentCard
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nameCard;

    #[ORM\Column(type: 'integer')]
    private $cardNumber;

    #[ORM\Column(type: 'string', length: 255)]
    private $validMonth;

    #[ORM\Column(type: 'string', length: 255)]
    private $cvv;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $saveCard;

    #[ORM\ManyToMany(targetEntity: Users::class, mappedBy: 'cardId')]
    private $userId;

    public function __construct()
    {
        $this->userId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCard(): ?string
    {
        return $this->nameCard;
    }

    public function setNameCard(string $nameCard): self
    {
        $this->nameCard = $nameCard;

        return $this;
    }

    public function getCardNumber(): ?int
    {
        return $this->cardNumber;
    }

    public function setCardNumber(int $cardNumber): self
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    public function getValidMonth(): ?string
    {
        return $this->validMonth;
    }

    public function setValidMonth(string $validMonth): self
    {
        $this->validMonth = $validMonth;

        return $this;
    }

    public function getCvv(): ?string
    {
        return $this->cvv;
    }

    public function setCvv(string $cvv): self
    {
        $this->cvv = $cvv;

        return $this;
    }

    public function isSaveCard(): ?bool
    {
        return $this->saveCard;
    }

    public function setSaveCard(?bool $saveCard): self
    {
        $this->saveCard = $saveCard;

        return $this;
    }

    /**
     * @return Collection<int, Users>
     */
    public function getUserId(): Collection
    {
        return $this->userId;
    }

    public function addUserId(Users $userId): self
    {
        if (!$this->userId->contains($userId)) {
            $this->userId[] = $userId;
            $userId->addCardId($this);
        }

        return $this;
    }

    public function removeUserId(Users $userId): self
    {
        if ($this->userId->removeElement($userId)) {
            $userId->removeCardId($this);
        }

        return $this;
    }
}
