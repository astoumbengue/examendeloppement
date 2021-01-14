<?php

namespace App\Form;

use App\Entity\Maison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MaisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('nbrechambre')
            ->add('prix')
            ->add('etage')
            ->add('image', FileType::class, array('data_class' => null,'required' => false))
            ->add('validation')
            ->add('adresse')
        ;
    }

   
}
