<?php

namespace Analatica\NavigateurBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Analatica\NavigateurBundle\Entity\Navigateur;
use Analatica\NavigateurBundle\Form\NavigateurType;

/**
 * Navigateur controller.
 *
 */
class NavigateurController extends Controller
{

    /**
     * Lists all Navigateur entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AnalaticaNavigateurBundle:Navigateur')->findAll();

        return $this->render('AnalaticaNavigateurBundle:Navigateur:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Navigateur entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Navigateur();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('navigateur_show', array('id' => $entity->getId())));
        }

        return $this->render('AnalaticaNavigateurBundle:Navigateur:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Navigateur entity.
     *
     * @param Navigateur $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Navigateur $entity)
    {
        $form = $this->createForm(new NavigateurType(), $entity, array(
            'action' => $this->generateUrl('navigateur_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Navigateur entity.
     *
     */
    public function newAction()
    {
        $entity = new Navigateur();
        $form = $this->createCreateForm($entity);

        return $this->render('AnalaticaNavigateurBundle:Navigateur:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Navigateur entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnalaticaNavigateurBundle:Navigateur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Navigateur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AnalaticaNavigateurBundle:Navigateur:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Navigateur entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnalaticaNavigateurBundle:Navigateur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Navigateur entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AnalaticaNavigateurBundle:Navigateur:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Navigateur entity.
     *
     * @param Navigateur $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Navigateur $entity)
    {
        $form = $this->createForm(new NavigateurType(), $entity, array(
            'action' => $this->generateUrl('navigateur_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Navigateur entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AnalaticaNavigateurBundle:Navigateur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Navigateur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('navigateur_edit', array('id' => $id)));
        }

        return $this->render('AnalaticaNavigateurBundle:Navigateur:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Navigateur entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AnalaticaNavigateurBundle:Navigateur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Navigateur entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('navigateur'));
    }

    /**
     * Creates a form to delete a Navigateur entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('navigateur_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}
