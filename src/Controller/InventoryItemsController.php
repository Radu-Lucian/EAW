<?php

namespace App\Controller;

use App\Entity\InventoryItems;
use App\Form\InventoryItemsType;
use App\Repository\InventoryItemsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inventory")
 */
class InventoryItemsController extends AbstractController
{
    /**
     * @Route("/", name="inventory_items_index", methods={"GET"})
     */
    public function index(InventoryItemsRepository $inventoryItemsRepository): Response
    {
        return $this->render('inventory_items/index.html.twig', [
            'inventory_items' => $inventoryItemsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="inventory_items_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $inventoryItem = new InventoryItems();
        $form = $this->createForm(InventoryItemsType::class, $inventoryItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inventoryItem);
            $entityManager->flush();

            return $this->redirectToRoute('inventory_items_index');
        }

        return $this->render('inventory_items/new.html.twig', [
            'inventory_item' => $inventoryItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inventory_items_show", methods={"GET"})
     */
    public function show(InventoryItems $inventoryItem): Response
    {
        return $this->render('inventory_items/show.html.twig', [
            'inventory_item' => $inventoryItem,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="inventory_items_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InventoryItems $inventoryItem): Response
    {
        $form = $this->createForm(InventoryItemsType::class, $inventoryItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inventory_items_index');
        }

        return $this->render('inventory_items/edit.html.twig', [
            'inventory_item' => $inventoryItem,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inventory_items_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InventoryItems $inventoryItem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inventoryItem->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inventoryItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inventory_items_index');
    }
}
