<?php

namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{

    /**
     * @Route("/about", name="about_page")
     */
    public function showPost(EntityManagerInterface $entityManager)
    {
        $postName = "default";
        $userRepository = $entityManager->getRepository(User::class);
        $users = $userRepository->findAll();
        $user_data = [];
        foreach ($users as $user) {
            $user_data[] = [
                'id' => $user->getId(),
                'name' => $user->getNameToShow(),
                'username' => $user->getUsername(),
                'dateCreated' => $user->getCreatedDate()->format('Y-m-d H:i:s'),
                'lastModified' => $user->getLastModified()->format('Y-m-d H:i:s'),
            ];
        }

        return $this->render(
            'about.html.twig',
            [
                'title' => $postName,
                'user_data' => print_r($user_data,true),
            ]
        );
    }
}