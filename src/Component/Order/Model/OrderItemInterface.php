<?php

declare(strict_types=1);

namespace App\Component\Order\Model;

use App\Component\Product\Model\ProductInterface;

interface OrderItemInterface
{
    /**
     * @return string
     */
    public function getId(): string ;

    /**
     * @param OrderInterface $order
     */
    public function setOrder(OrderInterface $order): void ;

    /**
     * @return OrderInterface
     */
    public function getOrder(): OrderInterface ;

    /**
     * @param ProductInterface $product
     */
    public function setProduct(ProductInterface $product): void ;

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface ;

    /**
     * @param int $quantity
     */
    public function setQuantity(int $quantity): void;

    /**
     * @return int
     */
    public function getQuantity(): int ;

    /**
     * @param float $priceTotal
     */
    public function setPriceTotal(float $priceTotal): void ;

    /**
     * @return float
     */
    public function getPriceTotal(): float ;
}