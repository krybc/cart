<?php

declare(strict_types=1);

namespace App\Component\Shipment\Model;

use Ramsey\Uuid\UuidInterface;

interface ShipmentInterface
{
    public function getId(): ?string ;

    public function setName(string $name): void ;

    public function getName(): string ;

    public function setPrice(float $price): void ;

    public function getPrice(): float ;
}