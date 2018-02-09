<?php

declare(strict_types=1);

namespace App\Component\Order\Model;

use App\Component\Discount\Model\DiscountInterface;
use App\Component\Payment\Model\PaymentInterface;
use App\Component\Shipment\Model\ShipmentInterface;
use Doctrine\Common\Collections\Collection;

interface OrderInterface
{
    /**
     * @return string
     */
    public function getId(): string ;

    /**
     * @param OrderItemInterface $item
     */
    public function addItem(OrderItemInterface $item): void ;

    /**
     * @param OrderItemInterface $item
     */
    public function removeItem(OrderItemInterface $item): void ;

    /**
     * @return Collection
     */
    public function getItems(): Collection;

    /**
     * @param PaymentInterface $payment
     */
    public function setPayment(PaymentInterface $payment): void ;

    /**
     * @return mixed
     */
    public function getPayment(): ?PaymentInterface;

    /**
     * @param ShipmentInterface $shipment
     */
    public function setShipment(ShipmentInterface $shipment): void ;

    /**
     * @return ShipmentInterface
     */
    public function getShipment(): ?ShipmentInterface;

    /**
     * @param DiscountInterface $discount
     */
    public function setDiscount(DiscountInterface $discount): void ;

    /**
     * @return DiscountInterface
     */
    public function getDiscount(): ?DiscountInterface;

    /**
     * @param int $itemsTotal
     */
    public function setItemsTotal(int $itemsTotal): void ;

    /**
     * @param float $itemsPriceTotal
     */
    public function setItemsPriceTotal(float $itemsPriceTotal): void;

    /**
     * Total price of products including the discount
     *
     * @return float
     */
    public function getItemsPriceTotal(): float;

    /**
     * @return int
     */
    public function getItemsTotal(): int ;

    /**
     * @param float $priceTotal
     */
    public function setPriceTotal(float $priceTotal): void ;

    /**
     * @return float
     */
    public function getPriceTotal(): float ;
}