<?php

namespace App\Controller\Shop;

use App\Component\Order\OrderFactory;
use App\Component\Product\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $productRepository, OrderFactory $order): Response
    {
        $products = $productRepository->findAll();

        return $this->render('home/index.html.twig', [
            'itemsInCart' => $order->getCurrent()->getItemsTotal(),
            'products' => $products
        ]);
    }
}