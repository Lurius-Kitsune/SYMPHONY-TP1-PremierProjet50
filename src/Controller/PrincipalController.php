<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Employe;
use DateTime;
use DateTimeZone;

class PrincipalController extends AbstractController {

    #[Route('/principal', name: 'app_principal')]
    public function index(): Response {
        return $this->render('principal/index.html.twig', [
                    'controller_name' => 'PrincipalController',
        ]);
    }

    #[Route('/welcome/{nom}', name: 'welcome')]
    public function welcome(string $nom): Response {
        return $this->render('principal/welcome.html.twig', [
                    'nom' => $nom,
        ]);
    }

    #[Route('/message/{cp}/{sexe}', name: 'message')]
    public function message(string $cp, ?string $sexe): Response {
        $date = new DateTime('now', new DateTimeZone("Europe/Paris"));
        $date = $date->format('l j F Y H:i');
        return $this->render('principal/message.html.twig', [
                    'cp' => $cp,
                    'sexe' => $sexe,
                    'date' => $date,
        ]);
    }

    #[Route('/employes', name: 'employes')]
    public function afficheEmployes(ManagerRegistry $doctrine): Response {
        $employes = $doctrine->getRepository(Employe::class)->findAll();
        $titre = "Liste des employés";
        return $this->render('principal/employes.html.twig', compact('titre', 'employes'));
    }
    
        #[Route('/employe/{idEmploye}', name: 'employe')]
    public function afficheEmploye(string $idEmploye, ManagerRegistry $doctrine): Response {
        $employe = $doctrine->getRepository(Employe::class)->find($idEmploye);
        $titre = "Employé n°$idEmploye";
        return $this->render('principal/employe.html.twig', compact('titre', 'employe'));
    }
}
