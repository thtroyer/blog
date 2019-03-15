<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    /**
     * @Route("/contact")
     */
    public function showPost($postName = "default")
    {
        return $this->render(
            'contact.html.twig',
            [
                'title' => $postName,
            ]
        );
    }
}