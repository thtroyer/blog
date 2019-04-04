<?php

namespace App\Controller;

use App\Form\BlogPostFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function new_article()
    {
        $form = $this->createForm(BlogPostFormType::class);
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'newArticleForm' => $form->createView(),
        ]);
    }
}
