<?php

declare(strict_types=1);

namespace App\Component\Order;

use App\Component\Discount\Model\DiscountInterface;
use App\Component\Order\Model\Order;
use App\Component\Order\Model\OrderInterface;
use App\Component\Order\Model\OrderItem;
use App\Component\Order\Model\OrderItemInterface;
use App\Component\Order\Storage\OrderSessionStorage;
use App\Component\Order\Storage\OrderStorageInterface;
use App\Component\Payment\Model\PaymentInterface;
use App\Component\Product\Model\ProductInterface;
use App\Component\Shipment\Model\ShipmentInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class OrderFactory implements OrderFactoryInterface
{
    /**
     * @var OrderStorageInterface
     */
    private $storage;

    /**
     * @var OrderInterface
     */
    private $order;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    public function __construct(OrderSessionStorage $storage, EntityManagerInterface $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->storage = $storage;
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->order = $this->getCurrent();
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrent(): OrderInterface
    {
        $order = $this->storage->getOrderById();
        if ($order !== null) {
            return $order;
        }

        return new Order();
    }

    /**
     * {@inheritdoc}
     */
    public function addItem(ProductInterface $product, int $quantity): void
    {
        $orderBeforeId = $this->order->getId();
        if (!$this->containsProduct($product)) {
            $orderItem = new OrderItem();
            $orderItem->setOrder($this->order);
            $orderItem->setProduct($product);
            $orderItem->setQuantity($quantity);

            $this->order->addItem($orderItem);
        } else {
            $key = $this->indexOfProduct($product);
            $item = $this->order->getItems()->get($key);
            $quantity = $this->order->getItems()->get($key)->getQuantity() + 1;
            $this->setItemQuantity($item, $quantity);
        }

        // Run events
        if ($orderBeforeId === null) {
            $event = new GenericEvent($this->order);
            $this->eventDispatcher->dispatch(Events::ORDER_CREATED, $event);
        } else {
            $event = new GenericEvent($this->order);
            $this->eventDispatcher->dispatch(Events::ORDER_UPDATED, $event);
        }

        $this->entityManager->persist($this->order);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function containsProduct(ProductInterface $product): bool
    {
        foreach ($this->order->getItems() as $item) {

            if ($item->getProduct() === $product) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function indexOfProduct(ProductInterface $product): ?int
    {
        foreach ($this->order->getItems() AS $key => $item) {
            if ($item->getProduct() === $product) {
                return $key;
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function setItemQuantity(OrderItemInterface $item, int $quantity): void
    {
        if ($this->order && $this->order->getItems()->contains($item)) {
            $key = $this->order->getItems()->indexOf($item);

            $item->setQuantity($quantity);

            $this->order->getItems()->set($key, $item);

            // Run events
            $event = new GenericEvent($this->order);
            $this->eventDispatcher->dispatch(Events::ORDER_UPDATED, $event);

            $this->entityManager->persist($this->order);
            $this->entityManager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function removeItem(OrderItemInterface $item): void
    {
        if ($this->order && $this->order->getItems()->contains($item)) {
            $this->order->removeItem($item);

            // Run events
            $event = new GenericEvent($this->order);
            $this->eventDispatcher->dispatch(Events::ORDER_UPDATED, $event);

            $this->entityManager->persist($this->order);
            $this->entityManager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function items(): Collection
    {
        return $this->order->getItems();
    }

    /**
     * {@inheritdoc}
     */
    public function setPayment(PaymentInterface $payment): void
    {
        if ($this->order) {

            $this->order->setPayment($payment);

            // Run events
            $event = new GenericEvent($this->order);
            $this->eventDispatcher->dispatch(Events::ORDER_UPDATED, $event);

            $this->entityManager->persist($this->order);
            $this->entityManager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setShipment(ShipmentInterface $shipment): void
    {
        if ($this->order) {

            $this->order->setShipment($shipment);

            // Run events
            $event = new GenericEvent($this->order);
            $this->eventDispatcher->dispatch(Events::ORDER_UPDATED, $event);

            $this->entityManager->persist($this->order);
            $this->entityManager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setDiscount(DiscountInterface $discount): void
    {
        if ($this->order) {

            $this->order->setDiscount($discount);

            // Run events
            $event = new GenericEvent($this->order);
            $this->eventDispatcher->dispatch(Events::ORDER_UPDATED, $event);

            $this->entityManager->persist($this->order);
            $this->entityManager->flush();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clear(): void
    {
        $this->entityManager->remove($this->order);
        $this->entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function isEmpty(): bool
    {
        return !$this->order->getItems();
    }

    /**
     * {@inheritdoc}
     */
    public function summary(): Summary
    {
        return new Summary($this->order);
    }
}