<?php

namespace Entity;

/**
 * Позиция счета
 */
final class Position
{
    private ?int $positionId;
    private Bill $bill;
    private string $name;
    private int $quantity;
    private float $price;

    public function getPositionId(): ?int
    {
        return $this->positionId;
    }

    public function setPositionId(?int $positionId): self
    {
        $this->positionId = $positionId;
        return $this;
    }

    public function getBill(): Bill
    {
        return $this->bill;
    }

    public function setBill(Bill $bill): self
    {
        $this->bill = $bill;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }
}
