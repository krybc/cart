<?php

namespace App\Controller\Shop;

use App\Component\Order\Model\OrderItem;
use App\Component\Product\Model\Product;
use App\Form\AddItemType;
use App\Form\ClearCartType;
use App\Form\RemoveItemType;
use App\Form\SetDiscountType;
use App\Form\SetItemQuantityType;
use App\Form\SetPaymentType;
use App\Form\SetShipmentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    /**
     * @Route("/cart", name="cart")
     */
    public function index()
    {
        $order = $this->get('App\Component\Order\OrderFactory');

        $clearForm = $this->createForm(ClearCartType::class, $order->getCurrent());
        $setPaymentForm = $this->createForm(SetPaymentType::class, $order->getCurrent());
        $setShipmentForm = $this->createForm(SetShipmentType::class, $order->getCurrent());
        $setDiscountForm = $this->createForm(SetDiscountType::class, $order->getCurrent());


        return $this->render('cart/index.html.twig', [
            'order' => $order,
            'clearForm' => $clearForm->createView(),
            'setPaymentForm' => $setPaymentForm->createView(),
            'setShipmentForm' => $setShipmentForm->createView(),
            'setDiscountForm' => $setDiscountForm->createView(),
            'itemsInCart' => $order->getCurrent()->getItemsTotal()
        ]);
    }

    public function addItemForm(Product $product): Response
    {
        $form = $this->createForm(AddItemType::class, $product);

        return $this->render('cart/_addItem_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function removeItemForm(OrderItem $item): Response
    {
        $form = $this->createForm(RemoveItemType::class, $item);

        return $this->render('cart/_removeItem_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function setItemQuantityForm(OrderItem $item): Response
    {
        $form = $this->createForm(SetItemQuantityType::class, $item);

        return $this->render('cart/_setItemQuantity_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/cart/addItem/{id}", name="cart.addItem")
     * @Method("POST")
     */
    public function addItem(Request $request, Product $product): Response
    {
        $form = $this->createForm(AddItemType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('App\Component\Order\OrderFactory')->addItem($product, 1);
            $this->addFlash('success', $this->get('translator')->trans('app.cart.addItem.message.success'));
        }

        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/removeItem/{id}", name="cart.removeItem")
     * @Method("POST")
     */
    public function removeItem(Request $request, OrderItem $item): Response
    {
        $form = $this->createForm(RemoveItemType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('App\Component\Order\OrderFactory')->removeItem($item);
            $this->addFlash('success', $this->get('translator')->trans('app.cart.removeItem.message.success'));
        }

        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/setItemQuantity/{id}", name="cart.setItemQuantity")
     * @Method("POST")
     */
    public function setQuantity(Request $request, OrderItem $item): Response
    {
        $form = $this->createForm(SetItemQuantityType::class, $item);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('App\Component\Order\OrderFactory')->setItemQuantity($item, $form->getData()->getQuantity());
            $this->addFlash('success', $this->get('translator')->trans('app.cart.setItemQuantity.message.success'));
        }

        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/clear", name="cart.clear")
     * @Method("POST")
     */
    public function clear(Request $request): Response
    {
        $order = $this->get('App\Component\Order\OrderFactory');
        $form = $this->createForm(ClearCartType::class, $order->getCurrent());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('App\Component\Order\OrderFactory')->clear();
            $this->addFlash('success', $this->get('translator')->trans('app.cart.clear.message.success'));
        }

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/cart/setPayment", name="cart.setPayment")
     * @Method("POST")
     */
    public function setPayment(Request $request): Response
    {
        $order = $this->get('App\Component\Order\OrderFactory');
        $form = $this->createForm(SetPaymentType::class, $order->getCurrent());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('App\Component\Order\OrderFactory')->setPayment($form->getData()->getPayment());
            $this->addFlash('success', $this->get('translator')->trans('app.cart.setPayment.message.success'));
        }

        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/setShipment", name="cart.setShipment")
     * @Method("POST")
     */
    public function setShipment(Request $request): Response
    {
        $order = $this->get('App\Component\Order\OrderFactory');
        $form = $this->createForm(SetShipmentType::class, $order->getCurrent());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('App\Component\Order\OrderFactory')->setShipment($form->getData()->getShipment());
            $this->addFlash('success', $this->get('translator')->trans('app.cart.setShipment.message.success'));
        }

        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/setDiscount", name="cart.setDiscount")
     * @Method("POST")
     */
    public function setDiscount(Request $request): Response
    {
        $order = $this->get('App\Component\Order\OrderFactory');
        $form = $this->createForm(SetDiscountType::class, $order->getCurrent());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $discount = $this->getDoctrine()->getRepository('App\Component\Discount\Model:Discount')->findOneBy([
                'code' => $form->get('discountCode')->getData()
            ]);

            if ($discount !== null) {
                $this->get('App\Component\Order\OrderFactory')->setDiscount($discount);
                $this->addFlash('success', $this->get('translator')->trans('app.cart.setDiscount.message.success'));
            } else {
                $this->addFlash('danger', $this->get('translator')->trans('app.cart.setDiscount.message.codeNotFound'));
            }
        }

        return $this->redirectToRoute('cart');
    }
}