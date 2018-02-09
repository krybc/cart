<?php

declare(strict_types=1);

namespace App\Component\Payment\Model;

interface PaymentInterface
{
    /**
     * @return string
     */
    public function getId(): ?string ;

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