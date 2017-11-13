<?php

namespace cervezasBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CervezasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')
        ->add('pais')
        ->add('poblacion')
        ->add('tipo')
        ->add('importacion')
        ->add('tamano', TextType::class, array('label' => 'Tamaño'))
        ->add('fechaAlmacen', DateType::class, array('label' => 'Fecha de almacenamiento'))
        ->add('cantidad')
        ->add('foto')
        ->add('guardar',SubmitType::class)
        ->add('borrar',ResetType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'cervezasBundle\Entity\Cervezas'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cervezasbundle_cervezas';
    }


}
