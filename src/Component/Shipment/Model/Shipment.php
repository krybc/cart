<?php

declare(strict_types=1);

namespace App\Component\Shipment\Model;

use App\Component\Core\Model\TimestampableTrait;
use Ramsey\Uuid\UuidInterface;

class Shipment implements ShipmentInterface
{
    use TimestampableTrait;

    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    /**
     * {@inheritdoc}
     */
    public function getId(): UuidInterface
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
}