<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Contact;

class GestionContact {

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function creerContact(Contact $contact) {
        $contact->setDatePremierContact(new \DateTime());
        $this->em->persist($contact);
        $this->em->flush();
    }
}