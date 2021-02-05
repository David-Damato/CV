<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use app\Entity\Resume;
use DateTime;

class ResumeFixtures extends Fixture
{

    const OBJECT = [
        'BTS' => [
            'type' => 'formation',
            'lieu' => 'Alphonse Henrich',
            'date_debut' => '01-09-2011',
            'date_fin' => '01-09-2013',
            'subject' => 'BTS',
            'message' => '« Industrialisation de produits mécaniques »
            (alternance)',
        ],
        'Bootcamp' => [
            'type' => 'formation',
            'lieu' => 'wild Code School',
            'date_debut' => '01-08-2020',
            'date_fin' => '15-02-2021',
            'subject' => 'Bootcamp',
            'message' => '« Developpeur web et mobile »',
        ],
        'PRE-CONTRACTING LINE DESIGNER' => [
            'type' => 'experience',
            'lieu' => 'SIDEL (Tetra pack group)',
            'date_debut' => '01-05-2016',
            'date_fin' => '01-08-2020',
            'subject' => 'CDI',
            'message' => 'Concevoir des plans d\'implantation pour différents clients - 
            Chiffrer et réaliser l\'offre selon le plan d\'implantation éffectués -
            Gestion de projets en lien avec les clients et les différents services internes',
        ],
        'DEVELOPPEUR WEB' => [
            'type' => 'experience',
            'lieu' => 'wild code school',
            'date_debut' => '01-08-2020',
            'date_fin' => '15-02-2021',
            'subject' => 'Projet consistant à réaliser un site de service en ligne',
            'message' => 'Utilisation du simple MVC
            Usage du HTML / CSS -
            Utilisation du CRUD / POO -
            Gestion d\'un projet via Github -
            Mise en place de la méthode Agile',
        ],
        'DEVELOPPEUR WEB' => [
            'type' => 'experience',
            'lieu' => 'wild code school',
            'date_debut' => '01-08-2020',
            'date_fin' => '15-02-2021',
            'subject' => 'Projet "Back to the future" consistant à réaliser un site avec une API',
            'message' => 'Gestion d\'un projet en un temps limité -
            Utilisation d\'une API -
            Utilisation du simple MVC -
            Usage du HTML / CSS -
            Utilisation du CRUD / POO',
        ],
        'DEVELOPPEUR WEB' => [
            'type' => 'experience',
            'lieu' => 'wild code school',
            'date_debut' => '01-08-2020',
            'date_fin' => '15-02-2021',
            'subject' => 'Projet consistant à réaliser un site d’évent et de traiteur pour un client',
            'message' => 'Gestion d\'un projet -
            Utilisation du SCRUM -
            Utilisation de Symfony -
            Usage du HTML / CSS / Twig -
            Utilisation du CRUD / POO',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (SELF::OBJECT as $nom => $data) {

            $object = new Resume();
            $object->setName($nom);
            $object->setType($data['type']);
            $object->setLieu($data['lieu']);
            $object->setDateDebut($data['date_debut']);
            $object->setDateFin($data['date_fin']);
            $object->setSubject($data['subject']);
            $object->setMessage($data['message']);
            $manager->persist($object);
        }
        $manager->flush();
    }
}

