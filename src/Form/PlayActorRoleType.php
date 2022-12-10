<?php

namespace App\Form;

use App\Entity\Site\Play;
use App\Entity\Site\Actor;
use App\Trait\ObjectStateEnum;
use App\Entity\Site\PlayActorRole;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PlayActorRoleType extends AbstractType
{
    // Form is used in PlayCrudController -> playActorRoles CollectionField

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Rôle'])
            ->add('actor', EntityType::class, [
                'class' => Actor::class,
                'label' => 'Acteur',
            ])
            ->add('state', ChoiceType::class, [
                'choices' => ObjectStateEnum::values(),
                'label' => 'État de publication',
                'empty_data' => ObjectStateEnum::ENABLED,
                'expanded' => false,
                'multiple' => false,
                'help' => '<p>Valeur par défaut : Actif</p>'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlayActorRole::class,
            'play' => Play::class,
        ]);
    }
}
