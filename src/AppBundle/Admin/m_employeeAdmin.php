<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 30/3/2560
 * Time: 9:54 น.
 */

namespace AppBundle\Admin;
use AppBundle\GVal\variables;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;

class  m_employeeAdmin extends  AbstractAdmin {
    protected function configureFormFields(FormMapper $formMapper)
    {
        $em = $this->modelManager->getEntityManager('AppBundle\Entity\G_Company');

        $query = $em->createQueryBuilder('c')
            ->select('c')
            ->from('AppBundle:G_Company', 'c')
            ->where('c.cpnCode IS NOT NULL')
            ->orderBy('c.cpnCode, c.lft', 'ASC');
        //$formMapper->add('emCode', 'text');
        $formMapper
            ->add('empCode','text'
                ,array(
                    'label' => variables::getempCodeText(),
                    'disabled'=>false
                )
             )

            ->add('cpnCode','entity', array(
                    'class' => 'AppBundle\Entity\G_Company','choice_label' => 'cpnCode',
                )

            )
            ->add('name','text',
                array(
                'label' => variables::getFirstnameText(),

                )
            )
            ->add('lastname','text',
                array(
                'label' => variables::getLastnameText(),

                )
            )

        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper

            ->add('name')
            ->add('lastname')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper

            ->addIdentifier('empCode')
            ->add('name')
            ->add('lastname')
        ;
    }
}