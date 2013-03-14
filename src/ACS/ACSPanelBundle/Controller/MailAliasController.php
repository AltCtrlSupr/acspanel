<?php


namespace ACS\ACSPanelBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ACS\ACSPanelBundle\Entity\MailAlias;
use ACS\ACSPanelBundle\Form\MailAliasType;

/**
 * MailAlias controller.
 *
 */
class MailAliasController extends Controller
{
    /**
     * Lists all MailAlias entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ACSACSPanelBundle:MailAlias')->findAll();

        return $this->render('ACSACSPanelBundle:MailAlias:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Finds and displays a MailAlias entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ACSACSPanelBundle:MailAlias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MailAlias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACSACSPanelBundle:MailAlias:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new MailAlias entity.
     *
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.context')->getToken()->getUser();
        if (!$user->canUseResource('MailAlias',$em)) {
            throw new \Exception('You don\'t have enough resources!');
        }

        $entity = new MailAlias();
        $form   = $this->createForm(new MailAliasType(), $entity);

        return $this->render('ACSACSPanelBundle:MailAlias:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new MailAlias entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new MailAlias();
        $form = $this->createForm(new MailAliasType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mailalias_show', array('id' => $entity->getId())));
        }

        return $this->render('ACSACSPanelBundle:MailAlias:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing MailAlias entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ACSACSPanelBundle:MailAlias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MailAlias entity.');
        }

        $editForm = $this->createForm(new MailAliasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACSACSPanelBundle:MailAlias:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing MailAlias entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ACSACSPanelBundle:MailAlias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MailAlias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new MailAliasType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('mailalias_edit', array('id' => $id)));
        }

        return $this->render('ACSACSPanelBundle:MailAlias:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a MailAlias entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ACSACSPanelBundle:MailAlias')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MailAlias entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('mailalias'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
