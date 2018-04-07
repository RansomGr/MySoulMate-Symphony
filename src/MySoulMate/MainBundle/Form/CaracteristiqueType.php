<?php

namespace MySoulMate\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaracteristiqueType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('corpulence',ChoiceType::class,array('choices'=>array(
            'Mince'=>'Mince',
            'Muscle'=>'Muscle',
            'Dodu'=>'Dodu',

        )))->add('pilosite',ChoiceType::class,array('choices'=>array(
            'Poilu'=>'Poilu',
            'Imberbe'=>'Imberbe',
        )))->add('origine',ChoiceType::class,array('choices'=>array(
            'Africaine'=>'Africaine',
            'Arabe'=>'Arabe',
            'Asiatique'=>'Asiatique',
        )))->add('profession')->add('alcool',ChoiceType::class,array('choices'=>array(
            'oui'=>'oui',
            'non'=>'non',
        )))->add('tabac',ChoiceType::class,array('choices'=>array(
            'oui'=>'oui',
            'non'=>'non',
        )))->add('taille')->add('cheveux',ChoiceType::class,array('choices'=>array(
            'Bruns'=>'Bruns',
            'Blond'=>'Blond',
            'Gris'=>'Gris',
        )))->add('yeux',ChoiceType::class,array('choices'=>array(
            'Bleu'=>'Bleu',
            'Noir'=>'Noir',
            'Vert'=>'Vert',
        )))->add('caractere',ChoiceType::class,array('choices'=>array(
            'Timide'=>'Timide',
            'Extraverti'=>'Extraverti',
        )))->add('statut',ChoiceType::class,array('choices'=>array(
            'Marié(e)'=>'Marié(e)',
            'Divorcé(e)'=>'Divorcé(e)',
            'Veuf(ve)'=>'Veuf(ve)',
        )))->add('cuisine',ChoiceType::class,array('choices'=>array(
            'Tunsienne'=>'Tunsienne',
            'Italienne'=>'Italienne)',
            'Chinoise'=>'Chinoise',
            'Vegan'=>'Vegan',
        )));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MySoulMate\MainBundle\Entity\Caracteristique'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mysoulmate_mainbundle_caracteristique';
    }


}
