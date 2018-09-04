<?php

declare(strict_types=1);

namespace App\Event;

use App\Component\Order\Events;
use App\Component\Order\Model\OrderInterface;
use App\Component\Order\Model\OrderItemInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\VarDumper\VarDumper;

class OrderRecalculateSubscriber implements EventSubscriberInterface
{
    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Events::ORDER_CREATED => 'recalculate',
            Events::ORDER_UPDATED => 'recalculate',
        ];
    }

    public function recalculate(GenericEvent $event): void
    {
        /** @var OrderInterface $entity */
        $entity = $event->getSubject();


        $itemsTotal = 0;
        $itemsPriceTotal = 0;

        /** @var OrderItemInterface  $item */
        foreach ($entity->getItems() as $item) {
            $itemsTotal += $item->getQuantity();
            $item->setPriceTotal($item->getProduct()->getPrice() * $item->getQuantity());
            $itemsPriceTotal += $item->getPriceTotal();
        }

        if ($entity->getDiscount() !== null) {
            $itemsPriceTotal -= $itemsPriceTotal * $entity->getDiscount()->getDiscount() / 100;
        }

        $priceTotal = $itemsPriceTotal;

        if ($entity->getPayment() !== null) {
            $priceTotal += $entity->getPayment()->getPrice();
        }

        if ($entity->getShipment() !== null) {
            $priceTotal += $entity->getShipment()->getPrice();
        }

        $entity->setItemsTotal($itemsTotal);
        $entity->setItemsPriceTotal($itemsPriceTotal);
        $entity->setPriceTotal($priceTotal);
    }
}