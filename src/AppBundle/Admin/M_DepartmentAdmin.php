<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 14/4/2560
 * Time: 17:49 น.
 */

namespace AppBundle\Admin;
use AppBundle\GVal\variables;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class M_DepartmentAdmin extends  AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        //$formMapper->add('emCode', 'text');
        $formMapper

            ->add('departmentCode','text'
                ,array(
                    'label' => variables::getcpnCodeText(),
                    'disabled'=>false
                )
            )
            ->add('departmentDesc','text',
                array(
                    'label' => variables::getcpnCodeDescText(),

                )
            )


        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper

            ->add('departmentCode')
            ->add('departmentDesc')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper

            ->addIdentifier('departmentDesc')
            ->add('departmentDesc')

        ;
    }

}