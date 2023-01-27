<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_article')]
    public function index(ArticleRepository $repo, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $filtre['univers'] = $request->query->get('univers');
        $filtre2 = $request->query->get('famille');
        $filtre['famille'] = $request->query->get('famille');
        $filtre['sous_famille'] = $request->query->get('sous_famille');
        $filtre['marque'] = $request->query->get('marque');
        $filtre['code'] = $request->query->get('code');

        $articles = $repo->findAllArticle($page, $filtre, $filtre2);

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
            'filtre' => $filtre
        ]);
    }
    #[Route('/recherche', name: 'recherche_article')]
    public function rechercheArticle(ArticleRepository $repo, Request $request): JsonResponse
    {
        $recherche = json_decode(\file_get_contents('php://input'), true);
        $recherche = $recherche['recherche'];
        $result = $repo->findByRecherche($recherche);

        return $this->json($result);
    }
}