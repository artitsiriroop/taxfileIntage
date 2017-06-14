<?php

namespace AppBundle\Form\Type {


    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;


    class m_employeeType extends AbstractType
    {

        public function buildForm(FormBuilderInterface $builder, array $options)
        {



            //$builder->add('name','text',array('required'=> true, 'empty_data'  => null,'label'=>false,'attr'=>array('class'=>'input','placeholder'=>'test')))
                 //   ->add('lastname',TextType::class,array('required'=> true, 'empty_data'  => null,'label'=>false,'attr'=>array('class'=>'input','placeholder'=>'test')));
        }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => m_employee::class,
                'required' => true,

            ));
        }


    }
}
