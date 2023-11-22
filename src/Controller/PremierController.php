<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PremierController extends AbstractController
{
    #[Route('/premier', name: 'app_premier')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PremierController.php',
        ]);
    }
    
    #[Route('/message', name: 'message')]
    public function message(): Response
    {
        return new Response("<h2>Bienvenue dans le monde toujours inachevé de Symfony</h2>");
    }
}
