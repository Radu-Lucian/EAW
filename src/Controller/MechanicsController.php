<?php

namespace App\Controller;

use App\Entity\Mechanics;
use App\Form\MechanicsType;
use App\Repository\MechanicsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mechanics")
 */
class MechanicsController extends AbstractController
{
    /**
     * @Route("/", name="mechanics_index", methods={"GET"})
     */
    public function index(MechanicsRepository $mechanicsRepository): Response
    {
        return $this->render('mechanics/index.html.twig', [
            'mechanics' => $mechanicsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mechanics_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mechanic = new Mechanics();
        $form = $this->createForm(MechanicsType::class, $mechanic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mechanic);
            $entityManager->flush();

            return $this->redirectToRoute('mechanics_index');
        }

        return $this->render('mechanics/new.html.twig', [
            'mechanic' => $mechanic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mechanics_show", methods={"GET"})
     */
    public function show(Mechanics $mechanic): Response
    {
        return $this->render('mechanics/show.html.twig', [
            'mechanic' => $mechanic,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mechanics_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mechanics $mechanic): Response
    {
        $form = $this->createForm(MechanicsType::class, $mechanic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mechanics_index');
        }

        return $this->render('mechanics/edit.html.twig', [
            'mechanic' => $mechanic,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="mechanics_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Mechanics $mechanic): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mechanic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mechanic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mechanics_index');
    }
}
