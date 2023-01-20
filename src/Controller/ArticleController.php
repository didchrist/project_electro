<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_article')]
    public function index(ArticleRepository $repo, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $filtre = $request->query->get('filtre', 'a.univers');
        $filtre2 = $request->query->get('famille');
        $filtre3 = $request->query->get('sous_famille');
        $articles = $repo->findAllArticle($page, $filtre, $filtre2, $filtre3);

        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles,
            'filtre' => $filtre
        ]);
    }
}