<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 22/4/2560
 * Time: 23:05 น.
 */

namespace AppBundle\Form\Type;
use AppBundle\Entity\T_Upload;
use AppBundle\Entity\T_UploadHeader;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class T_UploadHeaderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            // ...
            ->add('docYear', ChoiceType::class, array(
                'choices'  => array(
                    Date('Y') => Date('Y'),
                    Date('Y') - 1 => Date('Y') - 1,
                    Date('Y') - 2 => Date('Y') - 2,
                    Date('Y') - 3 => Date('Y') - 3,
                    Date('Y') - 4 => Date('Y') - 4,


                          )
                 )
            )
            ->add('uploadLocation', FileType::class, array('label' => ''))
            ->add('save', SubmitType::class, array(
                'attr' => array('class' => 'save'),
            ));


        // ...
        ;
        /*$builder

            ->add('brochure', FileType::class, array('label' => 'Brochure (PDF file)'))

        ;*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => T_UploadHeader::class,
        ));
    }



}