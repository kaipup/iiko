<?php

namespace Entity;

use BillStatusEnum;
use DateTime;

/**
 * Счет
 */
final class Bill
{
    /**
     * C ORM выглядело бы примерно так ;)
     *
     * #[ORM\Id]
     * #[ORM\GeneratedValue]
     * #[ORM\Column(type: Types::INTEGER)]
     */
    private ?int $id = null;
    private string $number;
    private BillStatusEnum $status;
    private DateTime $created;
    private ?float $discount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;
        return $this;
    }

    public function getStatus(): BillStatusEnum
    {
        return $this->status;
    }

    public function setStatus(BillStatusEnum $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function setCreated(DateTime $created): self
    {
        $this->created = $created;
        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;
        return $this;
    }
}
