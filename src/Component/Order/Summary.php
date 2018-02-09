<?php

declare(strict_types=1);

namespace App\Component\Order;

use App\Component\Order\Model\OrderInterface;

final class Summary
{
    /**
     * @var OrderInterface
     */
    private $order;

    /**
     * Summary constructor.
     *
     * @param OrderInterface $order
     */
    public function __construct(OrderInterface $order)
    {
        $this->order = $order;
    }

    /**
     * Return
     *
     * @return float
     */
    public function getItemsPriceTotal(): float
    {
        return $this->order->getItemsPriceTotal();
    }

    /**
     * Return
     *
     * @return float
     */
    public function getPriceTotal(): float
    {
        return $this->order->getPriceTotal();
    }

    /**
     * Return discount price
     *
     * @return float
     */
    public function getDiscount(): float
    {
        $discount = 0;

        if ($this->order->getDiscount()) {
            $discount = $this->getPriceItemsBeforeDiscount() * $this->order->getDiscount()->getDiscount() / 100;
        }

        return $discount;
    }

    /**
     * Zwraca wartość koszyka po uwzględnieniu rabatu.
     *
     * @return float
     */
    public function getPriceItemsBeforeDiscount(): float
    {
        $price = 0;
        foreach ($this->order->getItems() as $item) {
            $price += $item->getPriceTotal();
        }

        return $price;
    }
}
