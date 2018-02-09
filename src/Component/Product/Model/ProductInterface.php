<?php

declare(strict_types=1);

namespace App\Component\Product\Model;

use Doctrine\Common\Collections\Collection;

interface ProductInterface
{
    /**
     * @return string
     */
    public function getId(): string ;

    /**
     * @param string $name
     */
    public function setName(string $name): void ;

    /**
     * @return string
     */
    public function getName(): string ;

    /**
     * @param $image
     */
    public function setImage($image): void ;

    /**
     * @return string
     */
    public function getImage(): string ;

    /**
     * @param float $price
     */
    public function setPrice(float $price): void ;

    /**
     * @return float
     */
    public function getPrice(): float ;

    /**
     * @return Collection
     */
    public function getOrderItem(): Collection ;
}