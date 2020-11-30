<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class AuctionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, array(
            'label' => 'Titulo'
        ))
        ->add('content', TextareaType::class, array(
            'label' => 'Descripción'
        ))
        ->add('category', TextType::class, array(
            'label' => 'Categoría'
        ))
        ->add('location', TextType::class, array(
            'label' => 'Localización'
        ))
        ->add('price', TextType::class, array(
            'label' => 'Precio'
        ))
        ->add('image_path', TextType::class, array(
            'label' => 'Imagen'
        ))
        ->add('submit', SubmitType::class, array(
            'label' => 'Guardar'
        ));

    }
}