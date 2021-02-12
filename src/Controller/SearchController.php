<?php declare(strict_types=1);

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\ElasticaBundle\Finder\TransformedFinder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/search", name="search_car")
 */
class SearchController extends AbstractController
{
    /**
     * @Route("/car", name="search_car")
     */
    public function searchCar(Request $request, SessionInterface $session, TransformedFinder $carsFinder): Response
    {
        $q = (string) $request->query->get('q', '');
        $results = !empty($q) ? $carsFinder->findHybrid($q) : [];
        $session->set('q', $q);

        return $this->render('search/search.html.twig', compact('results', 'q'));
    }
}