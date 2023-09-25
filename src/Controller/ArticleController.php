<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\Type\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/articles', name: 'article_all')]
    public function list(): Response
    {
        $articleRepository = $this->entityManager->getRepository(Article::class);
        $articles = $articleRepository->findAll();

        return $this->render('article/all.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/article/{slug}', name: 'article_show')]
    public function show(?Article $article): Response
    {
        if (!$article) {
            return $this->redirectToRoute('app_home');
        }
        $comment = new Comment($article);
        $commentForm = $this->createForm(CommentType::class, $comment);
        return $this->render('article/show.html.twig', [
            'article'=>$article,
            'commentForm'=>$commentForm,
        ]);
    }
}
