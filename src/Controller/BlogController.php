<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{

    /**
     * @Route("/")
     * @Route("/blog")
     */
    public function blogHome($postName = "Some blog title")
    {
        return $this->render(
            'blog.html.twig',
            [
                'title' => $postName,
            ]
        );
    }

    /**
     * @Route("/blog/{postName}")
     */
    public function showPost($postName = "default")
    {
        return $this->render(
            'blogpost.html.twig',
            [
                'title' => $postName,
            ]
        );
    }
}