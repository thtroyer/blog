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
    public function new_article(BlogPostFormType $blogForm)
    {
        $builder = $this->createFormBuilder();
        $blogForm->buildForm($builder, []);
        $form = $builder->getForm();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),
        ]);
    }
}
