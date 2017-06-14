<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 13/4/2560
 * Time: 23:49 น.
 */

namespace AppBundle\Admin;

use AppBundle\GVal\variables;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class G_CompanyAdmin extends  AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        //$formMapper->add('emCode', 'text');
        $formMapper

            ->add('cpnCode','text'
                ,array(
                    'label' => variables::getcpnCodeText(),
                    'disabled'=>false
                )
            )
            ->add('cpnCodeDesc','text',
                array(
                    'label' => variables::getcpnCodeDescText(),

                )
            )


        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper

            ->add('cpnCode')
            ->add('cpnCodeDesc')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper

            ->addIdentifier('cpnCode')
            ->add('cpnCodeDesc')

        ;
    }

}