<?php

namespace App\Form;

use App\Entity\Crypto;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Security\Core\Security;

class CryptoType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $this->security->getUser();
        $builder
            ->add('nom', TextType::class)
            ->add('symbole', TextType::class)
            ->add('prix', NumberType::class)
            ->add('categorie', TextType::class)
            ->add('quantite', NumberType::class)
            ->add('date', DateTimeType::class)
            //->add('nbLikes')

            //->add('fans')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Crypto::class,
        ]);
    }
}
