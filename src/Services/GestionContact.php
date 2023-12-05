<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class GestionContact {

    private EntityManagerInterface $em;
    private MailerInterface $mailer;

    public function __construct(EntityManagerInterface $em, MailerInterface $mailer) {
        $this->em = $em;
        $this->mailer = $mailer;
    }

    public function creerContact(Contact $contact) {
        $contact->setDatePremierContact(new \DateTime());
        $this->em->persist($contact);
        $this->em->flush();
    }

    public function envoiMailContact(Contact $contact) {
        $email = (new TemplatedEmail())
                // ->from (new Address ('contact@benoitroche.fr'))
                ->from(new Address('no-reply@lucasfox.tech', 'noReply'))
                ->to($contact->getMail())
                ->subject('Demande de renseignement')
                ->text('Bonjour')
                ->attachFromPath('assets/pdf/presentation.pdf', 'Présentation')
                ->htmlTemplate('mails/mail.html.twig')
                ->context([
            'contact' => $contact,
        ]);
        $this->mailer->send($email);
    }
    
    public function envoiMailPromotion(Contact $contact, array $produits) {
        $email = (new TemplatedEmail())
                // ->from (new Address ('contact@benoitroche.fr'))
                ->from(new Address('no-reply@lucasfox.tech', 'No-Reply'))
                ->to($contact->getMail())
                ->subject('No promotion du moments')
                ->text('Bonjour')
                ->attachFromPath('assets/pdf/presentation.pdf', 'Présentation')
                ->htmlTemplate('mails/mailtous.html.twig')
                ->context([
            'contact' => $contact,
            'produits' => $produits,
        ]);
        $this->mailer->send($email);
    }
    
    public function getAllContact () : array {
        return $this->em->getRepository(Contact::class)->findAll();
    }
}
