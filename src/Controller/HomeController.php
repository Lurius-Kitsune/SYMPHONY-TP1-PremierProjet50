<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/home', name: 'home_')]
class HomeController extends AbstractController
{
    #[Route('/homepage', name: 'homepage')]
    public function homePage(): Response
    {
        return $this->render('home/homepage.html.twig');
    }
}
