<?php

declare(strict_types=1);

namespace App\Form;

use App\Component\Order\Model\Order;
use App\Component\Payment\Model\Payment;
use App\Component\Payment\Model\PaymentInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Translation\TranslatorInterface;

class SetPaymentType extends AbstractType
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(UrlGeneratorInterface $urlGenerator, TranslatorInterface $translator)
    {
        $this->urlGenerator = $urlGenerator;
        $this->translator = $translator;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAction($this->urlGenerator->generate('cart.setPayment'));

        $builder->add(
            'id',
            HiddenType::class
        );

        $builder->add(
            'payment',
            EntityType::class,
            [
                'class' => Payment::class,
                'choice_label' => function (PaymentInterface $payment) {
                    return "{$payment->getName()} ({$payment->getPrice()} {$this->translator->trans('app.default.currencyDescription')})";
                },
                'placeholder' => 'app.cart.setPayment.select',
                'empty_data' => null
            ]
        );

        $builder->add(
            'submit',
            SubmitType::class,
            [
                'label' => 'app.cart.setPayment.button'
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Order::class,
        ));
    }
}