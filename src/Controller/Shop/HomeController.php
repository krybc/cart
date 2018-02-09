<?php

namespace App\Controller\Shop;

use App\Component\Product\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $productRepository): Response
    {
        $order = $this->get('App\Component\Order\OrderFactory');
        $products = $productRepository->findAll();

        return $this->render('home/index.html.twig', [
            'itemsInCart' => $order->getCurrent()->getItemsTotal(),
            'products' => $products
        ]);
    }
}