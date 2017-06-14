<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 15/4/2560
 * Time: 22:34 น.
 */

namespace AppBundle\Form\Type;
use AppBundle\Entity\m_employee;
use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends  AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       // $builder->add('firstname', new m_employee());
        //$builder->add('username');
       $builder->add('firstname','text',array('required'=> true, 'empty_data'  => null,'label'=>false,'attr'=>array('class'=>'input','placeholder'=>'test')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }

}