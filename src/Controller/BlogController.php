<?php

namespace App\Controller;


use App\Entity\Article;
use League\CommonMark\CommonMarkConverter;
use Doctrine\ORM\EntityManagerInterface;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{

    #[Route("/", name: "homepage")]
    #[Route("/blog", name: "blog_homepage")]
    public function blogHome(EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\Response
    {

        $articleRepository = $entityManager->getRepository(Article::class);
        $articles = $articleRepository->findAllActiveNewestFirst();
        $featuredArticles = $articleRepository->findAllActiveFeatured();

        return $this->render(
            'blog.html.twig',
            [
                'featuredArticles' => $featuredArticles,
                'articles' => $articles,
            ]
        );
    }

    #[Route("/blog/{slug}", name: "blog_page")]
    public function showPost($slug, EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\Response
    {
        $articleRepository = $entityManager->getRepository(Article::class);
        $article = $articleRepository->findOneBy(['slug' => $slug]);
        $postName = $article->getTitle();
        $postContents = $article->getText();


//        $converter = new GithubFlavoredMarkdownConverter([
        $converter = new CommonMarkConverter([
            'allow_unsafe_links' => false,
        ]);

        return $this->render(
            'blogpost.html.twig',
            [
                'title' => $postName,
                'post' => $converter->convert($postContents),
            ]
        );
    }
}