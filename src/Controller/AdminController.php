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
     * @Route("/admin/article/", name="admin_article_list")
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

            $article = $form->getData();
            $article->setUser($user);
            $entityManager->persist($article);
            $entityManager->flush();
        }
        return $this->render('admin/new_article.html.twig', [
            'controller_name' => 'AdminController',
            'newArticleForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/article/edit/{id}", name="admin_edit_article")
     */
    public function editArticle(EntityManagerInterface $entityManager, Request $request, Article $article)
    {
        $form = $this->createForm(BlogPostFormType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $entityManager->persist($article);
            $entityManager->flush();
        }

        return $this->render('admin/edit_article.html.twig', [
            'controller_name' => 'AdminController',
            'newArticleForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/article/preview/{id}", name="admin_preview_article")
     */
    public function previewArticle($id, EntityManagerInterface $entityManager, Request $request, Article $article)
    {
        $articleRepository = $entityManager->getRepository(Article::class);
        $article = $articleRepository->findOneBy(['id' => $id]);
        $postName = $article->getTitle();
        $postContents = $article->getText();

        return $this->render(
            'admin/blogpost_preview.html.twig',
            [
                'title' => $postName,
                'post' => $postContents,
            ]
        );
    }
}
