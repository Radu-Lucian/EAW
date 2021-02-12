<?php

namespace App\Controller;

use App\Entity\Talons;
use App\Form\CarsType;
use App\Form\TalonsType;
use App\Repository\TalonsRepository;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/talons")
 */
class TalonsController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    /**
     * @Route("/", name="talons_index", methods={"GET"})
     */
    public function index(TalonsRepository $talonsRepository): Response
    {
        if (!$this->security->isGranted('ROLE_ADMIN')) {
            $user = $this->getUser();
            return $this->render('talons/userIndex.html.twig', [
                'talons' => $talonsRepository->findByUserId($user->getId()),
            ]);
        } else {
            return $this->render('talons/index.html.twig', [
                'talons' => $talonsRepository->findAll(),
            ]);
        }
    }

    /**
     * @Route("/new", name="talons_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $talon = new Talons();
        $form = $this->createForm(TalonsType::class, $talon);
            
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($talon);
            $entityManager->flush();

            return $this->redirectToRoute('talons_index');
        }

        return $this->render('talons/new.html.twig', [
            'talon' => $talon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="talons_show", methods={"GET"})
     */
    public function show(Talons $talon): Response
    {
        return $this->render('talons/show.html.twig', [
            'talon' => $talon,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="talons_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Talons $talon): Response
    {
        $form = $this->createForm(TalonsType::class, $talon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('talons_index');
        }

        return $this->render('talons/edit.html.twig', [
            'talon' => $talon,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="talons_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Talons $talon): Response
    {
        if ($this->isCsrfTokenValid('delete'.$talon->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($talon);
            $entityManager->flush();
        }

        return $this->redirectToRoute('talons_index');
    }
}
