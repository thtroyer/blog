<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{

    /**
     * @Route("/about")
     */
    public function showPost($postName = "default")
    {
        return $this->render(
            'about.html.twig',
            [
                'title' => $postName,
            ]
        );
    }
}