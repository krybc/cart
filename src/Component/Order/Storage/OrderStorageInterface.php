<?php

namespace App\Component\Order\Storage;

use App\Component\Order\Model\OrderInterface;

interface OrderStorageInterface
{
    public function set(string $orderId): void ;

    public function get(): string ;

    public function has(): bool ;

    public function remove(): void ;

    public function getOrderById(): ?OrderInterface ;
}