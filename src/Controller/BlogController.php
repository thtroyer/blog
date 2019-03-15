<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{

    /**
     * @Route("/")
     * @Route("/blog")
     * @Route("/blog/{postName}")
     */
    public function showPost($postName = "default")
    {
        return $this->render(
            'blog.html.twig',
            [
                'title' => $postName,
            ]
        );
    }
}