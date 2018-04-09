<?php

namespace RansomGr\PubliciteBundle\Form;

use RansomGr\PubliciteBundle\Entity\PubOwner;
use RansomGr\PubliciteBundle\Entity\PubPos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PubliciteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('title')->
        add('photo',FileType::class,array('label' => 'Choisir une Image'))
            ->add('lien')
            ->add('description')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('approved', ChoiceType::class, array(
                'choices' => array(
                    'oui' => 'y',
                    'rejeter' => 'r',
                    'pas encor' => 'ny',
                    'suspendu' => 's',
                    'active' => 'a'
                )))

            ->add('owner',EntityType::class, array('class' => PubOwner::class,'choice_label' => 'email'))
            ->add('position', EntityType::class, array('class' => PubPos::class,'choice_label' => 'position') );

    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RansomGr\PubliciteBundle\Entity\Publicite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ransomgr_publicitebundle_publicite';
    }


}
