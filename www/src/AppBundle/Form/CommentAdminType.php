<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentAdminType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => true,
            ])
            ->add('email', null, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => true,
            ])
            ->add('comment', null, [
                'attr' => [
                    'class' => 'form-control',
                    'rows'  => 10,
                ],
                'required' => true,
            ])
            ->add('enabled', null, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => true,
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Comment'
        ));
    }
}
