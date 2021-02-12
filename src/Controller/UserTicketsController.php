<?php

namespace App\Controller;

use App\Entity\UserTickets;
use App\Form\UserTicketsType;
use App\Repository\UserTicketsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * @Route("/user_tickets")
 */
class UserTicketsController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/", name="user_tickets_index", methods={"GET"})
     */
    public function index(UserTicketsRepository $userTicketsRepository): Response
    {
        if (!$this->security->isGranted('ROLE_ADMIN')) {
            $user = $this->getUser();
            return $this->render('user_tickets/userIndex.html.twig', [
                'user_tickets' => $userTicketsRepository->findByUserId($user->getId()),
            ]);
        } else {
            return $this->render('user_tickets/index.html.twig', [
                'user_tickets' => $userTicketsRepository->findAll(),
            ]);
        }
    }

    /**
     * @Route("/new", name="user_tickets_new", methods={"GET","POST"})
     */
    public function new(Request $request, MailerInterface $mailer): Response
    {
        $userTicket = new UserTickets();
        $form = $this->createForm(UserTicketsType::class, $userTicket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userTicket);
            $entityManager->flush();

            $email = (new Email())
                ->from('proiectFinal@gmail.com')
                ->to('radulucian.andrei@gmail.com')
                ->subject('AutoService: New Ticket')
                ->text("A new ticket has been submited!");

            $mailer->send($email);

            return $this->redirectToRoute('user_tickets_index');
        }

        return $this->render('user_tickets/new.html.twig', [
            'user_ticket' => $userTicket,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_tickets_show", methods={"GET"})
     */
    public function show(UserTickets $userTicket): Response
    {
        return $this->render('user_tickets/show.html.twig', [
            'user_ticket' => $userTicket,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_tickets_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, UserTickets $userTicket): Response
    {
        $form = $this->createForm(UserTicketsType::class, $userTicket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_tickets_index');
        }

        return $this->render('user_tickets/edit.html.twig', [
            'user_ticket' => $userTicket,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_tickets_delete", methods={"DELETE"})
     */
    public function delete(Request $request, UserTickets $userTicket): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userTicket->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userTicket);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_tickets_index');
    }
}
