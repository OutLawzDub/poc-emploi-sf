<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JobFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $jobs = [
            'Poissonier',
            'Analyste en chiffrement',
            'Mathématicien',
            'Physicien',
            'Boucher',
            'Assistant vétérinaire',
            'Livreur',
            'Avocat',
            'Gréffier',
            'Bucheron',
            'Orticulteur'
        ];

        for($i = 0; $i < count($jobs); $i++) {
            $job = new Job();

            $idRom = rand(10000, 99999);

            $job
                ->setIdRom($idRom)
                ->setJob($jobs[$i])
                ->setLien('http://localhost/' . $idRom)
                ;

            $this->addReference('job' . $i, $job);

            $manager->persist($job);
        }

        $manager->flush();
    }
}

