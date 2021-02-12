<?php

namespace App\Controller;

use App\Entity\UserTicketsMechanics;
use App\Form\UserTicketsMechanicsType;
use App\Repository\UserTicketsMechanicsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @IsGranted("ROLE_ADMIN")
 * @Route("/user_tickets_mechanics")
 */
class UserTicketsMechanicsController extends AbstractController
{
    /**
     * @Route("/", name="user_tickets_mechanics_index", methods={"GET"})
     */
    public function index(UserTicketsMechanicsRepository $userTicketsMechanicsRepository): Response
    {
        return $this->render('user_tickets_mechanics/index.html.twig', [
            'user_tickets_mechanics' => $userTicketsMechanicsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_tickets_mechanics_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $userTicketsMechanic = new UserTicketsMechanics();
        $form = $this->createForm(UserTicketsMechanicsType::class, $userTicketsMechanic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userTicketsMechanic);
            $entityManager->flush();

            return $this->redirectToRoute('user_tickets_mechanics_index');
        }

        return $this->render('user_tickets_mechanics/new.html.twig', [
            'user_tickets_mechanic' => $userTicketsMechanic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_tickets_mechanics_show", methods={"GET"})
     */
    public function show(UserTicketsMechanics $userTicketsMechanic): Response
    {
        return $this->render('user_tickets_mechanics/show.html.twig', [
            'user_tickets_mechanic' => $userTicketsMechanic,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_tickets_mechanics_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserTicketsMechanics $userTicketsMechanic): Response
    {
        $form = $this->createForm(UserTicketsMechanicsType::class, $userTicketsMechanic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_tickets_mechanics_index');
        }

        return $this->render('user_tickets_mechanics/edit.html.twig', [
            'user_tickets_mechanic' => $userTicketsMechanic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_tickets_mechanics_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserTicketsMechanics $userTicketsMechanic): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userTicketsMechanic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userTicketsMechanic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_tickets_mechanics_index');
    }
}
