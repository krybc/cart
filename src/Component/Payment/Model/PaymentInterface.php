<?php

declare(strict_types=1);

namespace App\Component\Payment\Model;

use Ramsey\Uuid\UuidInterface;

interface PaymentInterface
{
    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface ;

    /**
     * @param string $name
     */
    public function setName(string $name): void ;

    /**
     * @return string
     */
    public function getName(): string ;

    /**
     * @param float $price
     */
    public function setPrice(float $price): void ;

    /**
     * @return float
     */
    public function getPrice(): float ;
}