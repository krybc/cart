<?php

declare(strict_types=1);

namespace App\Form;

use App\Component\Order\Model\OrderItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RemoveItemType extends AbstractType
{
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAction($this->urlGenerator->generate('cart.removeItem', ['id' => $builder->getData()->getId()]));

        $builder->add(
            'id',
            HiddenType::class
        );

        $builder->add(
            'submit',
            SubmitType::class,
            [
                'label' => 'app.cart.removeItem.button',
                'attr' => [
                    'icon' => 'fa fa-minus-circle',
                ]
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => OrderItem::class,
        ));
    }
}