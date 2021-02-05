<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use app\Entity\Skills;

class SkillsFixtures extends Fixture
{

    const OBJECT = [
        'HTML' => [
            'type' => 'HardSkills',
            'description1' => 'UTilisation du CSS',
            'description2' => 'Utilisation de Bootstrap',
            'description3' => '',
            'description4' => '',
        ],
        'PHP' => [
            'type' => 'HardSkills',
            'description1' => 'Utilisation du Symfony',
            'description2' => 'Utilisation du MVC',
            'description3' => 'Utilisation de la POO',
            'description4' => '',
        ],
        'MySQL' => [
            'type' => 'HardSkills',
            'description1' => 'Création d\'une DB',
            'description2' => 'Gestion d\'une DB',
            'description3' => '',
            'description4' => '',
        ],
        'Autonomie' => [
            'type' => 'SoftSkills',
            'description1' => 'Le fait de m\'interesser à beaucoup de choses m\'a permis d\'avoir une certaines autonomie dans mon travail et aprentissage',
            'description2' => '',
            'description3' => '',
            'description4' => '',
        ],
        'Gestion de projet' => [
            'type' => 'SoftSkills',
            'description1' => 'Après avoir fait 5 ans de BE, j\'ai acquis une certaines expériences des projets',
            'description2' => '',
            'description3' => '',
            'description4' => '',
        ],
        'Sens du collectif' => [
            'type' => 'SoftSkills',
            'description1' => 'Le fait de travailler avec plusieurs services en constant, j\'ai acquis un bon sens du collectif',
            'description2' => '',
            'description3' => '',
            'description4' => '',
        ],
        'Sens du collectif' => [
            'type' => 'SoftSkills',
            'description1' => 'Ayant travailler sur des projets avant-vente avec des clients, j\'ai souvent travailler sous pression',
            'description2' => '',
            'description3' => '',
            'description4' => '',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (SELF::OBJECT as $nom => $data) {
            $object = new Skills();
            $object->setName($nom);
            $object->setType($data['type']);
            $object->setDescription1($data['description1']);
            $object->setDescription2($data['description2']);
            $object->setDescription3($data['description3']);
            $object->setDescription4($data['description4']);
            $manager->persist($object);
        }
        $manager->flush();
    }
}
