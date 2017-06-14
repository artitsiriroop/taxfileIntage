<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 16/4/2560
 * Time: 17:36 น.
 */


namespace AppBundle\Form\Type;
use AppBundle\Entity\Test;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestType extends  AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$builder->add('testvalue','entity', array(
            'class' => 'AppBundle:m_employee'
            )
        );*/

        $builder->add('testvalue',TextType::class,array('required'=> true, 'empty_data'  => null,'label'=>false,'attr'=>array('class'=>'input','placeholder'=>'test')));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Test::class,
        ));
    }

}