<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\CompanyLocation;
use AppBundle\Form\CompanyLocationType;

/**
 * CompanyLocation controller.
 *
 * @Route("/manager/locations")
 */
class CompanyLocationController extends Controller
{

    /**
     * Lists all CompanyLocation entities.
     *
     * @Route("/", name="manager_locations")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:CompanyLocation')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CompanyLocation entity.
     *
     * @Route("/", name="manager_locations_create")
     * @Method("POST")
     * @Template("AppBundle:CompanyLocation:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CompanyLocation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('manager_locations_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CompanyLocation entity.
     *
     * @param CompanyLocation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CompanyLocation $entity)
    {
        $form = $this->createForm(new CompanyLocationType(), $entity, array(
            'action' => $this->generateUrl('manager_locations_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CompanyLocation entity.
     *
     * @Route("/new", name="manager_locations_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CompanyLocation();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CompanyLocation entity.
     *
     * @Route("/{id}", name="manager_locations_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CompanyLocation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompanyLocation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CompanyLocation entity.
     *
     * @Route("/{id}/edit", name="manager_locations_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CompanyLocation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompanyLocation entity.');
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
    * Creates a form to edit a CompanyLocation entity.
    *
    * @param CompanyLocation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CompanyLocation $entity)
    {
        $form = $this->createForm(new CompanyLocationType(), $entity, array(
            'action' => $this->generateUrl('manager_locations_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CompanyLocation entity.
     *
     * @Route("/{id}", name="manager_locations_update")
     * @Method("PUT")
     * @Template("AppBundle:CompanyLocation:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:CompanyLocation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CompanyLocation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('manager_locations_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CompanyLocation entity.
     *
     * @Route("/{id}", name="manager_locations_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:CompanyLocation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CompanyLocation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('manager_locations'));
    }

    /**
     * Creates a form to delete a CompanyLocation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('manager_locations_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
