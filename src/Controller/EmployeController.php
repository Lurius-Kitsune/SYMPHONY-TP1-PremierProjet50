<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;

#[Route('/employe', name: 'employe_')]
class EmployeController extends AbstractController {

    #[Route('/voir/{id}', name: 'voir')]
    public function voir(int $id): Response {
        return $this->render('employe/voir.html.twig', [
                    'employeId' => $id,
        ]);
    }

    #[Route('/voirmieux/{id}', name: 'voirmieux', defaults: ['id' => 99], requirements: ['id' => '\d+'])]
    public function voirMieux(int $id): Response {
        return $this->render('employe/voir.html.twig', [
                    'employeId' => $id,
        ]);
    }

    #[Route('/voirnomb/{nom}', name: 'voirnomb', requirements: ["nom"=>"[B][a-zàéèêçîô-]*"], options:['utf8' => true])]
    public function voirNomB(string $nom): Response {
        return $this->render('employe/voirnomb.html.twig', [
                    'employeNom' => $nom,
        ]);
    }
    
    #[Route('/redirection/{nom}', name: 'redirection', requirements: ["nom"=>"[A-Za-z]*"], options:['utf8' => true])]
    public function redirection(string $nom): RedirectResponse { 
        return $this->redirectToRoute('employe_voirnomb', ['nom' => 'Bond']);
    }
    
    #[Route('/{_local}/cv/{id}', name: 'cv', requirements: ["id"=>"\d+", "_locale" => "fr|en"])]
    public function employeCv(string $id, Request $request): BinaryFileResponse { 
        $langue = $request->getLocale();
        switch ($langue) {
            case 'fr':
                $file = 'ressources\CV_FR.pdf';
                break;
            
            case 'en':
                $file = 'ressources\CV_EN.pdf';
                break;

            default:
                break;
        }
        //return $this->file($pdfPath, 'votre_fichier.pdf', ResponseHeaderBag::DISPOSITION_INLINE
        return new BinaryFileResponse($file);
        
    }
}
