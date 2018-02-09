<?php

declare(strict_types=1);

namespace App\Component\Discount\Model;

use Ramsey\Uuid\UuidInterface;

interface DiscountInterface
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
     * @param string $code
     */
    public function setCode(string $code): void ;

    /**
     * @return string
     */
    public function getCode(): string ;

    /**
     * @param float $discount
     */
    public function setDiscount(float $discount): void ;

    /**
     * @return float
     */
    public function getDiscount(): float ;
}