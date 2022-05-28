<?php

namespace App\Form;

use App\Entity\Juego;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AltaJuegoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')          
            ->add('descripcion',TextareaType::class,array( 'attr' => ['maxlength' => 255]))     
            ->add('categoria')
            ->add('foto',FileType::class)
            ->add('save',SubmitType::class,array('label'=>'Insertar'))
        ;
    }

    
}
