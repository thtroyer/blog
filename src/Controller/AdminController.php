<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\BlogPostFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/article/new", name="new_article")
     */
    public function new_article(EntityManagerInterface $entityManager, Request $request)
    {
        $form = $this->createForm(BlogPostFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $article = new Article();
            $article->setSlug($data['slug']);
            $article->setTitle($data['title']);
            $article->setText($data['text']);
            $article->setSummary($data['summary']);
            $article->setSubtext($data['subtext']);
            $article->setEnabled($data['enabled']);
            $article->setFeaturedPriority($data['featuredPriority']);
            $entityManager->persist($article);
        }
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'newArticleForm' => $form->createView(),
        ]);
    }
}
