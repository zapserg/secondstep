<?php

namespace Acme\SecondBazBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\SecondBazBundle\Entity\Tovar;
use Acme\SecondBazBundle\Form\TovarType;

/**
 * Tovar controller.
 *
 * @Route("/tov")
 */
class TovarController extends Controller
{

    /**
     * Lists all Tovar entities.
     *
     * @Route("/", name="tov")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeSecondBazBundle:Tovar')->findAll();

        // Creating pagnination
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $entities,
            $this->get('request')->query->get('page', 1),5);
      
        return array(
            'entities' => $pagination,
        );
    }
    /**
     * Creates a new Tovar entity.
     *
     * @Route("/", name="tov_create")
     * @Method("POST")
     * @Template("AcmeSecondBazBundle:Tovar:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Tovar();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tov_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Tovar entity.
     *
     * @param Tovar $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tovar $entity)
    {
        $form = $this->createForm(new TovarType(), $entity, array(
            'action' => $this->generateUrl('tov_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Tovar entity.
     *
     * @Route("/new", name="tov_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Tovar();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Tovar entity.
     *
     * @Route("/{id}", name="tov_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSecondBazBundle:Tovar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tovar entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Tovar entity.
     *
     * @Route("/{id}/edit", name="tov_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSecondBazBundle:Tovar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tovar entity.');
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
    * Creates a form to edit a Tovar entity.
    *
    * @param Tovar $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tovar $entity)
    {
        $form = $this->createForm(new TovarType(), $entity, array(
            'action' => $this->generateUrl('tov_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Изменить'));

        return $form;
    }
    /**
     * Edits an existing Tovar entity.
     *
     * @Route("/{id}", name="tov_update")
     * @Method("PUT")
     * @Template("AcmeSecondBazBundle:Tovar:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSecondBazBundle:Tovar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tovar entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tov_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Tovar entity.
     *
     * @Route("/{id}", name="tov_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeSecondBazBundle:Tovar')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tovar entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tov'));
    }

    /**
     * Creates a form to delete a Tovar entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tov_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}
