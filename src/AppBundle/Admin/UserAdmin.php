<?php
/**
 * Created by PhpStorm.
 * User: arttit
 * Date: 14/4/2560
 * Time: 7:29 น.
 */

namespace AppBundle\Admin;
use AppBundle\GVal\variables;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;



class UserAdmin extends AbstractAdmin
{
    /**
     * Turns the role's array keys into string <ROLES_NAME> keys.
     * @todo Move to convenience or make it recursive ? ;-)
     */
    protected static function flattenRoles($rolesHierarchy)
    {
        $flatRoles = array();
        foreach($rolesHierarchy as $roles) {

            if(empty($roles)) {
                continue;
            }

            foreach($roles as $role) {
                if(!isset($flatRoles[$role])) {
                    $flatRoles[$role] = $role;
                }
            }
        }

        return $flatRoles;
    }
    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
            ->add('username')
            ->add('email')
            ->end()
            // .. more info
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $roles = $container->getParameter('security.role_hierarchy.roles');
        $rolesChoices = self::flattenRoles($roles);
        $enableChoice=array('yes'=>1,'no'=>0);

        $formMapper

            ->add('username')
            ->add('email')
            ->add('plainPassword', 'text', array('required' => false))
            ->add('cpnCode','entity', array(
                    'class' => 'AppBundle\Entity\G_Company','choice_label' => 'cpnCode',
                )

            )
            ->add('enabled', 'choice', array(
                'choices'  => $enableChoice,
                'multiple' => false
                )
            )
            ->add('roles', 'choice', array(
                    'choices'  => $rolesChoices,
                    'multiple' => true
                )
            )
            ->end()
            // .. more info
        ;

       /* if (!$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Management')
                ->add('roles', 'sonata_security_roles', array(
                    'expanded' => true,
                    'multiple' => true,
                    'required' => false
                ))
                ->add('locked', null, array('required' => false))
                ->add('expired', null, array('required' => false))
                ->add('enabled', null, array('required' => false))
                ->add('credentialsExpired', null, array('required' => false))
                ->end()

        }*/
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('id')
            ->add('username')
            ->add('email')
        ;
    }
    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $container = $this->getConfigurationPool()->getContainer();
        $roles = $container->getParameter('security.role_hierarchy.roles');
        $rolesChoices = self::flattenRoles($roles);
        $listMapper
            ->addIdentifier('username')
            ->add('email')
            ->add('enabled', null, array('editable' => true))
            ->add('roles', 'choice', array(
                    'choices'  => $rolesChoices,
                    'multiple' => true
                )
            );

        ;

        if ($this->isGranted('ROLE_ALLOWED_TO_SWITCH')) {
            $listMapper
                ->add('impersonating', 'string', array('template' => 'SonataUserBundle:Admin:Field/impersonating.html.twig'))
            ;
        }
    }


}