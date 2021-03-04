<?php

namespace App\DataFixtures;

use App\Entity\Horaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class HoraireFixtures extends Fixture implements DependentFixtureInterface
{
    private function randomDate($start_date, $end_date)
    {
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        $val = rand($min, $max);

        return date('Y-m-d', $val);
    }

    public function load(ObjectManager $manager)
    {
        $nombreCampagnes = 5;

        for($i = 0; $i < $nombreCampagnes; $i++) {
            $campagne = $this->getReference('campagne' . $i);

            $dateStart  = $campagne->getDateStart();
            $dateEnd    = $campagne->getDateEnd();

            $nombreHoraire = 10;


            for($a = 0; $a < $nombreHoraire; $a++) {
                $randomDate = $this->randomDate($dateStart->format('Y-m-d H:i:s'), $dateEnd->format('Y-m-d H:i:s'));

                $horaire = new Horaire();

                $formatDateStartMatin = new \DateTime($randomDate . ' 09:00:00');
                $formatDateEndMatin   = new \DateTime($randomDate . ' 13:00:00');

                $formatDateStartAprem = new \DateTime($randomDate . ' 14:00:00');
                $formatDateEndAprem   = new \DateTime($randomDate . ' 18:00:00');

//                Matin

                $horaire
                    ->setDateStart($formatDateStartMatin)
                    ->setDateEnd($formatDateEndMatin)
                    ->setCampagne($campagne)
                    ->setJob($this->getReference('job' . rand(0, 10)))
                    ;

//                Après-midi

                $horaire
                    ->setDateStart($formatDateStartAprem)
                    ->setDateEnd($formatDateEndAprem)
                    ->setCampagne($campagne)
                    ->setJob($this->getReference('job' . rand(0, 10)))
                ;

                $manager->persist($horaire);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CampagneFixtures::class,
            JobFixtures::class
        ];
    }
}
