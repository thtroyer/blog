<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{

    /**
     * @Route("/blog/{postName}")
     */
    public function showPost($postName)
    {
        return $this->render(
            'blog.html.twig',
            [
                'title' => $postName,
            ]
        );
    }
}