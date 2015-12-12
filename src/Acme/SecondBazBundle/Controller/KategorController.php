<?php

namespace Acme\SecondBazBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\SecondBazBundle\Entity\Kategor;
use Acme\SecondBazBundle\Form\KategorType;

/**
 * Kategor controller.
 *
 * @Route("/katg")
 */
class KategorController extends Controller
{

    /**
     * Lists all Kategor entities.
     *
     * @Route("/", name="katg")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AcmeSecondBazBundle:Kategor')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Kategor entity.
     *
     * @Route("/", name="katg_create")
     * @Method("POST")
     * @Template("AcmeSecondBazBundle:Kategor:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Kategor();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('katg_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Kategor entity.
     *
     * @param Kategor $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Kategor $entity)
    {
        $form = $this->createForm(new KategorType(), $entity, array(
            'action' => $this->generateUrl('katg_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Создать'));

        return $form;
    }

    /**
     * Displays a form to create a new Kategor entity.
     *
     * @Route("/new", name="katg_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Kategor();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Kategor entity.
     *
     * @Route("/{id}", name="katg_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSecondBazBundle:Kategor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Kategor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Kategor entity.
     *
     * @Route("/{id}/edit", name="katg_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSecondBazBundle:Kategor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Kategor entity.');
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
    * Creates a form to edit a Kategor entity.
    *
    * @param Kategor $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Kategor $entity)
    {
        $form = $this->createForm(new KategorType(), $entity, array(
            'action' => $this->generateUrl('katg_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Обновить'));

        return $form;
    }
    /**
     * Edits an existing Kategor entity.
     *
     * @Route("/{id}", name="katg_update")
     * @Method("PUT")
     * @Template("AcmeSecondBazBundle:Kategor:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeSecondBazBundle:Kategor')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Kategor entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('katg_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Kategor entity.
     *
     * @Route("/{id}", name="katg_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AcmeSecondBazBundle:Kategor')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Kategor entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('katg'));
    }

    /**
     * Creates a form to delete a Kategor entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('katg_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Удалить'))
            ->getForm()
        ;
    }
}
