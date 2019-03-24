<?php

namespace App\Controller;


use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     * @Route("/blog", name="blog_homepage")
     */
    public function blogHome($postName = "Some blog title")
    {

        $articleRepository = $entityManager->getRepository(Article::class);
        $article = $articleRepository->findOneBy(['slug' => $slug]);
        $postName = $article->getTitle();
        $postContents = $article->getText();

        return $this->render(
            'blog.html.twig',
            [
                'title' => $postName,
            ]
        );
    }

    /**
     * @Route("/blog/{slug}", name="blog_page")
     */
    public function showPost($slug, EntityManagerInterface $entityManager)
    {
        $articleRepository = $entityManager->getRepository(Article::class);
        $article = $articleRepository->findOneBy(['slug' => $slug]);
        $postName = $article->getTitle();
        $postContents = $article->getText();

        return $this->render(
            'blogpost.html.twig',
            [
                'title' => $postName,
                'post' => $postContents,
            ]
        );
    }
}