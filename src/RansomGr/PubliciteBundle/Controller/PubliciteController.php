<?php

namespace RansomGr\PubliciteBundle\Controller;

use DateTime;
use RansomGr\PubliciteBundle\Entity\Publicite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        return $this->render('@RansomGrPublicite/publicite/index.html.twig', array(
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
        /**
         * @var UploadedFile $file
         */
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $file=$publicite->getPhoto();
            $photo=md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),$photo
            );
            $publicite->setPhoto($photo);
            $em->persist($publicite);
            $em->flush();

            return $this->redirectToRoute('Admin_Publicite_show', array('id' => $publicite->getId()));
        }

        return $this->render('@RansomGrPublicite/publicite/new.html.twig', array(
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

        return $this->render('@RansomGrPublicite/publicite/show.html.twig', array(
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
        $publicite->setPhoto(
            new File($this->getParameter('image_directory').'/'.$publicite->getPhoto())

        );
        /**
         * @var UploadedFile $file
         */
        $file=$publicite->getPhoto();
        $editForm = $this->createForm('RansomGr\PubliciteBundle\Form\PubliciteType', $publicite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $file=$publicite->getPhoto();
            $photo=md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),$photo
            );

            $publicite->setPhoto($photo);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Admin_Publicite_index', array('id' => $publicite->getId()));
        }

        return $this->render('@RansomGrPublicite/publicite/edit.html.twig', array(
            'publicite' => $publicite,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'photo'=> $file->getFilename()
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

        return $this->redirectToRoute('Admin_Publicite_index');
    }
    public function removeAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $publicite=$this->getDoctrine()->getManager()->getRepository("RansomGrPubliciteBundle:Publicite")->find($id);
        $em->remove($publicite);
        $em->flush();
        return $this->redirectToRoute('Admin_Publicite_index');
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
            ->setAction($this->generateUrl('Admin_Publicite_delete', array('id' => $publicite->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    public function fetchAllActivePubsAction()
    {

        $em=$this->getDoctrine()->getManager();
        $pubs=$em->getRepository('RansomGrPubliciteBundle:Publicite')->findAllordered();
        $EligiblePubs=array();
        forEach($pubs as $pub)
        {
            if($pub->getDateDebut()<=(new DateTime())&&$pub->getDateFin()>=(new DateTime()))
                $EligiblePubs[]=$pub;
        }
   $content='';
        forEach($pubs as $pub)
        {
          $content.="<div  data-p='170.00' >
          <a href='".$pub->getLien()."' >
          <img data-u='image' src='/MySoulMate-Symphony/web/images/".$pub->getPhoto()."' ></a></div>";
        }
        return new JsonResponse(array('pubs'=>$content));
    }
}
