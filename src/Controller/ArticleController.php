<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\Type\CommentType;
use App\Service\CommentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/article/{slug}', name: 'article_show')]
    public function show(?Article $article, CommentService $commentService): Response
    {
        // Si l'article n'existe pas on est redirigé vers home
        if (!$article) {
            return $this->redirectToRoute('app_home');
        }

        $comment = new Comment($article);

        $commentForm = $this->createForm(CommentType::class, $comment);


        return $this->renderForm('article/show.html.twig', [
            'article' => $article,
            'comments' => $commentService->getPaginatedComments($article),
            'commentForm' => $commentForm
        ]);
    }
}
