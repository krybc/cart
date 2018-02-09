<?php

declare(strict_types=1);

namespace App\Component\Order;

use App\Component\Discount\Model\DiscountInterface;
use App\Component\Order\Model\OrderInterface;
use App\Component\Order\Model\OrderItemInterface;
use App\Component\Payment\Model\PaymentInterface;
use App\Component\Product\Model\ProductInterface;
use App\Component\Shipment\Model\ShipmentInterface;
use Doctrine\Common\Collections\Collection;
use Exception;

interface OrderFactoryInterface
{
    /**
     * @return OrderInterface
     */
    public function getCurrent(): OrderInterface;

    /**
     * Sprawdzenie czy koszyk jest pusty.
     *
     * @return bool
     */
    public function isEmpty(): bool ;

    /**
     * Sprawdzenie czy koszyk zawiera dany produkt.
     *
     * @param ProductInterface $product
     * @return bool
     */
    public function containsProduct(ProductInterface $product): bool ;

    /**
     * Return key number of orderItem has product
     *
     * @param ProductInterface $product
     * @return int|null
     */
    public function indexOfProduct(ProductInterface $product): ?int;

    /**
     * Usunięcie wszystkich elementów z koszyka.
     */
    public function clear(): void;

    /**
     * Dodanie produktu do koszyka.
     * Jeśli produkt istnieje zwiększana jest jego ilość.
     *
     * @param ProductInterface $product
     * @param integer $quantity
     * @return void
     */
    public function addItem(ProductInterface $product, int $quantity): void ;

    /**
     * Aktualizacja liczby produktów dla istniejącego produktu.
     *
     * @param OrderItemInterface $item
     * @param integer $quantity
     * @throws Exception
     */
    public function setItemQuantity(OrderItemInterface $item, int $quantity): void ;

    /**
     * Set payment method
     *
     * @param PaymentInterface $payment
     */
    public function setPayment(PaymentInterface $payment): void ;

    /**
     * Set shipment
     *
     * @param ShipmentInterface $shipment
     */
    public function setShipment(ShipmentInterface $shipment): void ;

    /**
     * Set discount code
     *
     * @param DiscountInterface $discount
     */
    public function setDiscount(DiscountInterface $discount): void ;

    /**
     * Usunięcie pozycji produktu z koszyka.
     *
     * @param OrderItemInterface $item
     * @throws Exception
     */
    public function removeItem(OrderItemInterface $item): void ;

    /**
     * Pobranie informacji potrzebnych do podsumowania koszyka.
     *
     * @return Summary
     */
    public function summary(): Summary ;

    /**
     * Pobranie wszystkich produktów wraz z informacjami potrzebnymi na listingu koszyka.
     *
     * @return Collection
     */
    public function items(): Collection ;
}
