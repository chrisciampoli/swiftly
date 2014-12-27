<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\CompanyShift;
use AppBundle\Form\CompanyShiftType;

/**
 * CompanyShift controller.
 *
 * @Route("/manager/company/shifts")
 */
class CompanyShiftController extends Controller
{

    /**
     * Lists all CompanyShift entities.
     *
     * @Route("/", name="manager_company_shifts")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:CompanyShift')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CompanyShift entity.
     *
     * @Route("/", name="manager_company_shifts_create")
     * @Method("POST")
     * @Template("AppBundle:CompanyShift:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CompanyShift();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('manager_company_shifts_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CompanyShift entity.
     *
     * @param CompanyShift $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CompanyShift $entity)
    {
        $form = $this->createForm(new CompanyShiftType(), $entity, array(
            'action' => $this->generateUrl('manager_company_shifts_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CompanyShift entity.
     *
     * @Route("/new", name="manager_company_shifts_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CompanyShift();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CompanyShift entity.
     *
     * @Route("/{id}", name="manager_company_shifts_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CompanyShift')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompanyShift entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CompanyShift entity.
     *
     * @Route("/{id}/edit", name="manager_company_shifts_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CompanyShift')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompanyShift entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a CompanyShift entity.
    *
    * @param CompanyShift $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CompanyShift $entity)
    {
        $form = $this->createForm(new CompanyShiftType(), $entity, array(
            'action' => $this->generateUrl('manager_company_shifts_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CompanyShift entity.
     *
     * @Route("/{id}", name="manager_company_shifts_update")
     * @Method("PUT")
     * @Template("AppBundle:CompanyShift:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CompanyShift')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompanyShift entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('manager_company_shifts_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CompanyShift entity.
     *
     * @Route("/{id}", name="manager_company_shifts_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:CompanyShift')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CompanyShift entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('manager_company_shifts'));
    }

    /**
     * Creates a form to delete a CompanyShift entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('manager_company_shifts_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
