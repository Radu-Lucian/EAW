<?php

namespace App\Controller;

use App\Entity\Progress;
use App\Form\ProgressType;
use App\Repository\ProgressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/progress")
 */
class ProgressController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/", name="progress_index", methods={"GET"})
     */
    public function index(ProgressRepository $progressRepository): Response
    {
        if (!$this->security->isGranted('ROLE_ADMIN')) {
            $user = $this->getUser();
            return $this->render('progress/userIndex.html.twig', [
                'progress' => $progressRepository->findByUserId($user->getId()),
            ]);
    
        } else {
            return $this->render('progress/index.html.twig', [
                'progress' => $progressRepository->findAll(),
            ]);
    
        }
    }

    /**
     * @Route("/new", name="progress_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $progress = new Progress();
        $form = $this->createForm(ProgressType::class, $progress);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($progress);
            $entityManager->flush();

            return $this->redirectToRoute('progress_index');
        }

        return $this->render('progress/new.html.twig', [
            'progress' => $progress,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="progress_show", methods={"GET"})
     */
    public function show(Progress $progress): Response
    {
        return $this->render('progress/show.html.twig', [
            'progress' => $progress,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="progress_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Progress $progress): Response
    {
        $form = $this->createForm(ProgressType::class, $progress);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('progress_index');
        }

        return $this->render('progress/edit.html.twig', [
            'progress' => $progress,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="progress_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Progress $progress): Response
    {
        if ($this->isCsrfTokenValid('delete'.$progress->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($progress);
            $entityManager->flush();
        }

        return $this->redirectToRoute('progress_index');
    }
}
