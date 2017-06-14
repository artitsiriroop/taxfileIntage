<?php

namespace AppBundle\Controller;

use AppBundle\Entity\m_employee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * M_employee controller.
 *
 */
class m_employeeController extends Controller
{
    /**
     * Lists all m_employee entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $m_employees = $em->getRepository('AppBundle:m_employee')->findAll();

        return $this->render('m_employee/index.html.twig', array(
            'm_employees' => $m_employees,
        ));
    }

    /**
     * Creates a new m_employee entity.
     *
     */
    public function newAction(Request $request)
    {
        $m_employee = new M_employee();
        $form = $this->createForm('AppBundle\Form\m_employeeType', $m_employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($m_employee);
            $em->flush();

            return $this->redirectToRoute('prefix_update_show', array('id' => $m_employee->getId()));
        }

        return $this->render('m_employee/new.html.twig', array(
            'm_employee' => $m_employee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a m_employee entity.
     *
     */
    public function showAction(m_employee $m_employee)
    {
        $deleteForm = $this->createDeleteForm($m_employee);

        return $this->render('m_employee/show.html.twig', array(
            'm_employee' => $m_employee,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing m_employee entity.
     *
     */
    public function editAction(Request $request, m_employee $m_employee)
    {
        $deleteForm = $this->createDeleteForm($m_employee);
        $editForm = $this->createForm('AppBundle\Form\m_employeeType', $m_employee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prefix_update_edit', array('id' => $m_employee->getId()));
        }

        return $this->render('m_employee/edit.html.twig', array(
            'm_employee' => $m_employee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a m_employee entity.
     *
     */
    public function deleteAction(Request $request, m_employee $m_employee)
    {
        $form = $this->createDeleteForm($m_employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($m_employee);
            $em->flush();
        }

        return $this->redirectToRoute('prefix_update_index');
    }

    /**
     * Creates a form to delete a m_employee entity.
     *
     * @param m_employee $m_employee The m_employee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(m_employee $m_employee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('prefix_update_delete', array('id' => $m_employee->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
