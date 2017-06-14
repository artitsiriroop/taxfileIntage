<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 20/4/2560
 * Time: 15:56 น.
 */

namespace AppBundle\Form\Type;

use AppBundle\Entity\T_Upload;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$builder

            ->add('brochure', FileType::class, array('label' => 'Brochure (PDF file)'))

        ;*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Upload::class,
        ));
    }


}