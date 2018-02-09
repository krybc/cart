<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Component\Discount\Model\Discount;
use App\Component\Payment\Model\Payment;
use App\Component\Product\Model\Product;
use App\Component\Shipment\Model\Shipment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadProducts($manager);
        $this->loadPayments($manager);
        $this->loadShipments($manager);
        $this->loadDiscounts($manager);
    }

    private function loadProducts(ObjectManager $manager): void
    {
        foreach ($this->getProductsData() as [$name, $image, $price]) {
            $product = new Product();
            $product->setCreatedAt(new \DateTime('NOW'));
            $product->setName($name);
            $product->setImage($image);
            $product->setPrice($price);

            $manager->persist($product);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    private function getProductsData(): array
    {
        return [
            // $productData = [$name, $image, $price];
            [
                'ASUS R541UA-DM1287T-8',
                null,
                2499
            ],
            [
                'Apple MacBook Air',
                null,
                3799
            ],
            [
                'Dell Inspiron 5570',
                null,
                2499
            ]
        ];
    }

    private function loadPayments(ObjectManager $manager): void
    {
        foreach ($this->getPaymentsData() as [$name, $price]) {
            $payment = new Payment();
            $payment->setCreatedAt(new \DateTime('NOW'));
            $payment->setName($name);
            $payment->setPrice($price);

            $manager->persist($payment);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    private function getPaymentsData(): array
    {
        return [
            // $paymentData = [$name, $price];
            [
                'Przelew bankowy',
                0
            ],
            [
                'Płatności online',
                5
            ],
            [
                'Paypal',
                1.23
            ]
        ];
    }

    private function loadShipments(ObjectManager $manager): void
    {
        foreach ($this->getShipmentsData() as [$name, $price]) {
            $shipment = new Shipment();
            $shipment->setCreatedAt(new \DateTime('NOW'));
            $shipment->setName($name);
            $shipment->setPrice($price);

            $manager->persist($shipment);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    private function getShipmentsData(): array
    {
        return [
            // $shipmentData = [$name, $price];
            [
                'Poczta Polska',
                12
            ],
            [
                'Kurier DHL',
                18
            ],
            [
                'Paczkomaty inPost',
                8
            ]
        ];
    }

    private function loadDiscounts(ObjectManager $manager): void
    {
        foreach ($this->getDiscountsData() as [$name, $code, $percent]) {
            $discount = new Discount();
            $discount->setCreatedAt(new \DateTime('NOW'));
            $discount->setName($name);
            $discount->setCode($code);
            $discount->setDiscount($percent);

            $manager->persist($discount);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    private function getDiscountsData(): array
    {
        return [
            // $discountData = [$name, $code, $discount];
            [
                'Rabat 10%',
                'rabat10',
                10
            ],
            [
                'Rabat 15%',
                'rabat15',
                15
            ]
        ];
    }
}