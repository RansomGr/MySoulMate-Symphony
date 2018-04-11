<?php

namespace Amira\EventsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('dateEvt')
                ->add('heure')
                ->add('dureeEvt')
                ->add('typeEvt')
                ->add('descriptionEvt')
                ->add('nbMax')
                ->add('planEvt',ChoiceType::class)
                ->add('ajouter',SubmitType::class);
    }
    //->add('nomEvt')->add('entite')->add('organisateurEvt')->add('planEvt')->add('client')
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MySoulMate\MainBundle\Entity\Events'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'mysoulmate_mainbundle_events';
    }


}
