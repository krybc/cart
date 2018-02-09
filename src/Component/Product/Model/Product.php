<?php

declare(strict_types=1);

namespace App\Component\Product\Model;

use App\Component\Core\Model\TimestampableTrait;
use Doctrine\Common\Collections\Collection;

class Product implements ProductInterface
{
    use TimestampableTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var
     */
    private $image;

    /**
     * @var float
     */
    private $price;

    /**
     * @var Collection
     */
    private $orderItem;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * {@inheritdoc}
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderItem(): Collection
    {
        return $this->orderItem;
    }
}