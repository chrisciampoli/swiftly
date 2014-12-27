<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\CompanyPosition;
use AppBundle\Form\CompanyPositionType;

/**
 * CompanyPosition controller.
 *
 * @Route("/manager/positions")
 */
class CompanyPositionController extends Controller
{

    /**
     * Lists all CompanyPosition entities.
     *
     * @Route("/", name="manager_positions")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:CompanyPosition')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CompanyPosition entity.
     *
     * @Route("/", name="manager_positions_create")
     * @Method("POST")
     * @Template("AppBundle:CompanyPosition:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CompanyPosition();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('manager_positions_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CompanyPosition entity.
     *
     * @param CompanyPosition $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CompanyPosition $entity)
    {
        $form = $this->createForm(new CompanyPositionType(), $entity, array(
            'action' => $this->generateUrl('manager_positions_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CompanyPosition entity.
     *
     * @Route("/new", name="manager_positions_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CompanyPosition();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CompanyPosition entity.
     *
     * @Route("/{id}", name="manager_positions_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CompanyPosition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompanyPosition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CompanyPosition entity.
     *
     * @Route("/{id}/edit", name="manager_positions_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CompanyPosition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompanyPosition entity.');
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
    * Creates a form to edit a CompanyPosition entity.
    *
    * @param CompanyPosition $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CompanyPosition $entity)
    {
        $form = $this->createForm(new CompanyPositionType(), $entity, array(
            'action' => $this->generateUrl('manager_positions_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CompanyPosition entity.
     *
     * @Route("/{id}", name="manager_positions_update")
     * @Method("PUT")
     * @Template("AppBundle:CompanyPosition:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CompanyPosition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompanyPosition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('manager_positions_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CompanyPosition entity.
     *
     * @Route("/{id}", name="manager_positions_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:CompanyPosition')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CompanyPosition entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('manager_positions'));
    }

    /**
     * Creates a form to delete a CompanyPosition entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('manager_positions_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
