<?php

declare(strict_types=1);

namespace App\Component\Order\Model;

use App\Component\Core\Model\TimestampableTrait;
use App\Component\Discount\Model\DiscountInterface;
use App\Component\Payment\Model\PaymentInterface;
use App\Component\Shipment\Model\ShipmentInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Order implements OrderInterface
{
    use TimestampableTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var Collection
     */
    private $items;

    /**
     * @var PaymentInterface
     */
    private $payment;

    /**
     * @var ShipmentInterface
     */
    private $shipment;

    /**
     * @var DiscountInterface
     */
    private $discount;

    /**
     * @var int
     */
    private $itemsTotal = 0;

    /**
     * @var float
     */
    private $itemsPriceTotal = 0;

    /**
     * @var float
     */
    private $priceTotal = 0;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function addItem(OrderItemInterface $item): void
    {
        $this->items->add($item);
    }

    /**
     * {@inheritdoc}
     */
    public function removeItem(OrderItemInterface $item): void
    {
        $this->items->removeElement($item);
    }

    /**
     * {@inheritdoc}
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * {@inheritdoc}
     */
    public function getPayment(): ?PaymentInterface
    {
        return $this->payment;
    }

    /**
     * {@inheritdoc}
     */
    public function setPayment(PaymentInterface $payment): void
    {
        $this->payment = $payment;
    }

    /**
     * {@inheritdoc}
     */
    public function getShipment(): ?ShipmentInterface
    {
        return $this->shipment;
    }

    /**
     * {@inheritdoc}
     */
    public function setShipment(ShipmentInterface $shipment): void
    {
        $this->shipment = $shipment;
    }

    /**
     * {@inheritdoc}
     */
    public function getDiscount(): ?DiscountInterface
    {
        return $this->discount;
    }

    /**
     * {@inheritdoc}
     */
    public function setDiscount(DiscountInterface $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * {@inheritdoc}
     */
    public function getItemsTotal(): int
    {
        return $this->itemsTotal;
    }

    /**
     * {@inheritdoc}
     */
    public function setItemsTotal(int $itemsTotal): void
    {
        $this->itemsTotal = $itemsTotal;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriceTotal(): float
    {
        return $this->priceTotal;
    }

    /**
     * {@inheritdoc}
     */
    public function setPriceTotal(float $priceTotal): void
    {
        $this->priceTotal = $priceTotal;
    }

    /**
     * @return float
     */
    public function getItemsPriceTotal(): float
    {
        return $this->itemsPriceTotal;
    }

    /**
     * @param float $itemsPriceTotal
     */
    public function setItemsPriceTotal(float $itemsPriceTotal): void
    {
        $this->itemsPriceTotal = $itemsPriceTotal;
    }
}