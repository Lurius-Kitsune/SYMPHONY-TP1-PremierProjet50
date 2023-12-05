<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Persistence\ManagerRegistry;
use App\Services\GestionContact;
use App\Entity\Contact;
use App\Entity\Produit;

#[Route('/contact', name: 'contact_')]
class ContactController extends AbstractController {

    #[Route('/demande', name: 'demande')]
    public function demandeContact(Request $request, GestionContact $gestionContact): Response {
        $contact = new Contact();
        $form = $this->createFormBuilder($contact)
                ->add('titre', ChoiceType::class, array(
                    'choices' => array(
                        'Monsieur' => 'M',
                        'Madame' => 'F',
                    ), 'multiple' => false,
                    'expanded' => true,
                ))
                ->add('nom', TextType::class, array(
                    'label' => 'Nom : ',
                    'required' => true,
                    'attr' => ['placeholder' => 'votre nom'],
                ))
                ->add('prenom', TextType::class, array(
                    'label' => 'Prenom : ',
                    'required' => true,
                    'attr' => ['placeholder' => 'votre prenom'],
                ))
                ->add('mail', EmailType::class, array(
                    'label' => 'Mail : ',
                    'required' => true,
                ))
                ->add('tel', TextType::class, array(
                    'label' => 'Tel : ',
                    'required' => true,
                ))
                ->add('Envoyer', SubmitType::class)
                ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $gestionContact->creerContact($contact);
            $gestionContact->envoiMailContact($contact);
            $this->addFlash('notification', 'Votre message a bien été envoyé. L\'équipe vous contactera au plus vite');

            return $this->redirectToRoute("app_principal");
        }
        return $this->render('contact/contact.html.twig',
                        ['formContact' => $form->createView(),
                            'titre' => 'Formulaire de contact',
        ]);
    }

    #[Route('/envoitous', name: 'envoitous')]
    public function envoieTousContact(Request $request, GestionContact $gestionContact, ManagerRegistry $doctrine): Response {
        $contacts = $gestionContact->getAllContact();
        $produits = $doctrine->getRepository(Produit::class)->findAll();

        foreach ($contacts as $contact) {
            $gestionContact->envoiMailPromotion($contact, $produits);
        }

        $this->addFlash('notification', 'Promotions envoyé avec succées');

        return $this->redirectToRoute("app_principal");
    }
}
