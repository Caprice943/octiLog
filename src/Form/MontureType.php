<?php

namespace App\Form;

use App\Entity\Monture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MontureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prix', null, [
                'label' => 'Prix (€)',
            ])
            ->add('stock', null, [
                'label' => 'Stock',
            ])
            ->add('genre', null, [
                'label' => 'Genre',
            ])
            ->add('categorie', null, [
                'label' => 'Catégorie',
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_uri' => false,
                'image_uri' => true,
                'label' => 'Photo',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Monture::class,
        ]);
    }
}
