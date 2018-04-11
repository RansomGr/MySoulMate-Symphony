<?php

namespace RansomGr\PubliciteBundle\Controller;

use RansomGr\PubliciteBundle\Entity\PubPos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Pubpo controller.
 *
 */
class PubPosController extends Controller
{
    /**
     * Lists all pubPo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pubPos = $em->getRepository('RansomGrPubliciteBundle:PubPos')->findAll();

        return $this->render('@RansomGrPublicite/pubpos/index.html.twig', array(
            'pubPos' => $pubPos,
        ));
    }

    /**
     * Creates a new pubPo entity.
     *
     */
    public function newAction(Request $request)
    {
        $pubPo = new PubPos();
        $form = $this->createForm('RansomGr\PubliciteBundle\Form\PubPosType', $pubPo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pubPo);
            $em->flush();

            return $this->redirectToRoute('Admin_Publicite_Position_show', array('id' => $pubPo->getId()));
        }

        return $this->render('@RansomGrPublicite/pubpos/new.html.twig', array(
            'pubPo' => $pubPo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pubPo entity.
     *
     */
    public function showAction(PubPos $pubPo)
    {
        $deleteForm = $this->createDeleteForm($pubPo);

        return $this->render('@RansomGrPublicite/pubpos/show.html.twig', array(
            'pubPo' => $pubPo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pubPo entity.
     *
     */
    public function editAction(Request $request, PubPos $pubPo)
    {
        $deleteForm = $this->createDeleteForm($pubPo);
        $editForm = $this->createForm('RansomGr\PubliciteBundle\Form\PubPosType', $pubPo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Admin_Publicite_Position_edit', array('id' => $pubPo->getId()));
        }

        return $this->render('@RansomGrPublicite/pubpos/edit.html.twig', array(
            'pubPo' => $pubPo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pubPo entity.
     *
     */
    public function deleteAction(Request $request, PubPos $pubPo)
    {
        $form = $this->createDeleteForm($pubPo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pubPo);
            $em->flush();
        }

        return $this->redirectToRoute('Admin_Publicite_Position_index');
    }
    public function removeAction($id)
{
    $em=$this->getDoctrine()->getManager();
    $publicite=$this->getDoctrine()->getManager()->getRepository("RansomGrPubliciteBundle:PubPos")->find($id);
    $em->remove($publicite);
    $em->flush();
    return $this->redirectToRoute('Admin_Publicite_Position_index');
}

    /**
     * Creates a form to delete a pubPo entity.
     *
     * @param PubPos $pubPo The pubPo entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(PubPos $pubPo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Admin_Publicite_Position_delete', array('id' => $pubPo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
