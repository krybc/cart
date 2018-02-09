<?php

declare(strict_types=1);

namespace App\Component\Order\Model;

use App\Component\Core\Model\TimestampableTrait;
use App\Component\Product\Model\ProductInterface;

class OrderItem implements OrderItemInterface
{
    use TimestampableTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var OrderInterface
     */
    private $order;

    /**
     * @var ProductInterface
     */
    private $product;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var float
     */
    private $priceTotal;

    /**
     * {@inheritdoc}
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder(): OrderInterface
    {
        return $this->order;
    }

    /**
     * {@inheritdoc}
     */
    public function setOrder(OrderInterface $order): void
    {
        $this->order = $order;
    }

    /**
     * {@inheritdoc}
     */
    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    /**
     * {@inheritdoc}
     */
    public function setProduct(ProductInterface $product): void
    {
        $this->product = $product;
    }

    /**
     * {@inheritdoc}
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * {@inheritdoc}
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
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
}