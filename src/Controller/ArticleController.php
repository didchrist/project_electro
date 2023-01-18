<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_article')]
    public function index(ArticleRepository $repo): Response
    {
        $articles = $repo->findAllArticle();
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
            'articles' => $articles
        ]);
    }
}
