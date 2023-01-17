<?php

namespace App\Form;

use Adeliom\EasyMediaBundle\Form\EasyMediaType;
use App\Entity\Site\Play;
use App\Entity\Site\PlayGallery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayGalleryType extends AbstractType
{
    // Form is used in PlayCrudController -> playGalleries CollectionField

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', EasyMediaType::class, ['label' => 'Image'])
            ->add('position', IntegerType::class, ['label' => 'Position'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlayGallery::class,
            'play' => Play::class,
        ]);
    }
}
