<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\User;
use App\Form\BlogPostFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return new Response('todo');
    }

    /**
     * @Route("/admin/article/", name="admin_article")
     */
    public function articleList(EntityManagerInterface $entityManager, Request $request, UserRepository $userRepository)
    {
        $articleRepository = $entityManager->getRepository(Article::class);
        $articles = $articleRepository->findAll();

        return $this->render('admin/article_list.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/admin/article/new", name="admin_new_article")
     */
    public function newArticle(EntityManagerInterface $entityManager, Request $request, UserRepository $userRepository)
    {
        $form = $this->createForm(BlogPostFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository = $entityManager->getRepository(User::class);
            $user = $userRepository->findOneBy(['id' => 1]);

            $data = $form->getData();
            $article = new Article();
            $article->setSlug($data['slug']);
            $article->setTitle($data['title']);
            $article->setText($data['text']);
            $article->setSummary($data['summary']);
            $article->setSubtext($data['subtext']);
            $article->setEnabled($data['enabled']);
            $article->setFeaturedPriority($data['featuredPriority']);
            $article->setUser($user);
            $entityManager->persist($article);
            $entityManager->flush();
        }
        return $this->render('admin/new_article.html.twig', [
            'controller_name' => 'AdminController',
            'newArticleForm' => $form->createView(),
        ]);
    }
}
