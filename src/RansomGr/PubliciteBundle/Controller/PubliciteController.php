<?php

namespace RansomGr\PubliciteBundle\Controller;

use RansomGr\PubliciteBundle\Entity\Publicite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Publicite controller.
 *
 */
class PubliciteController extends Controller
{
    /**
     * Lists all publicite entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publicites = $em->getRepository('RansomGrPubliciteBundle:Publicite')->findAll();

        return $this->render('publicite/index.html.twig', array(
            'publicites' => $publicites,
        ));
    }

    /**
     * Creates a new publicite entity.
     *
     */
    public function newAction(Request $request)
    {
        $publicite = new Publicite();
        $form = $this->createForm('RansomGr\PubliciteBundle\Form\PubliciteType', $publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($publicite);
            $em->flush();

            return $this->redirectToRoute('Admin_publicite_show', array('id' => $publicite->getId()));
        }

        return $this->render('publicite/new.html.twig', array(
            'publicite' => $publicite,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a publicite entity.
     *
     */
    public function showAction(Publicite $publicite)
    {
        $deleteForm = $this->createDeleteForm($publicite);

        return $this->render('publicite/show.html.twig', array(
            'publicite' => $publicite,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing publicite entity.
     *
     */
    public function editAction(Request $request, Publicite $publicite)
    {
        $deleteForm = $this->createDeleteForm($publicite);
        $editForm = $this->createForm('RansomGr\PubliciteBundle\Form\PubliciteType', $publicite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Admin_publicite_edit', array('id' => $publicite->getId()));
        }

        return $this->render('publicite/edit.html.twig', array(
            'publicite' => $publicite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a publicite entity.
     *
     */
    public function deleteAction(Request $request, Publicite $publicite)
    {
        $form = $this->createDeleteForm($publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publicite);
            $em->flush();
        }

        return $this->redirectToRoute('Admin_publicite_index');
    }

    /**
     * Creates a form to delete a publicite entity.
     *
     * @param Publicite $publicite The publicite entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Publicite $publicite)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Admin_publicite_delete', array('id' => $publicite->getId())))
            ->setMethod('DELETE')
            ->getForm();

    }
}
