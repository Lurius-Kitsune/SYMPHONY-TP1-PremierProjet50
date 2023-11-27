<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;
use DateTimeZone;

class PrincipalController extends AbstractController
{
    #[Route('/principal', name: 'app_principal')]
    public function index(): Response
    {
        return $this->render('principal/index.html.twig', [
            'controller_name' => 'PrincipalController',
        ]);
    }
    
    #[Route('/welcome/{nom}', name: 'welcome')]
    public function welcome(string $nom): Response
    {
        return $this->render('principal/welcome.html.twig', [
            'nom' => $nom,
        ]);
    }
    
    #[Route('/message/{cp}/{sexe}', name: 'message')]
    public function message(string $cp, ?string $sexe): Response
    {
        $date = new DateTime('now', new DateTimeZone("Europe/Paris"));
        $date = $date->format('l j F Y H:i');
        return $this->render('principal/message.html.twig', [
            'cp' => $cp,
            'sexe' => $sexe,
            'date' => $date,
        ]);
    }
}
