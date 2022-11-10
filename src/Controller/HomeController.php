<?php

namespace App\Controller;

use App\Repository\PresentationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route ("/", name="Accueil")
     */
    public function Accueil(PresentationRepository $presentationRepository, UserRepository $userRepository): Response
    {
        $user = $userRepository->findAll();
        $presentation = $presentationRepository->findAll();
        return $this->render('home.html.twig', [
            'presentation' => $presentation,
            'user' => $user
        ]);
    }

}