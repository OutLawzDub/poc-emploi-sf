<?php

namespace App\DataFixtures;

use App\Entity\Campagne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CampagneFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $nombreCampagne = 5;

        for($i = 0; $i < $nombreCampagne; $i++) {
            $campagne = new Campagne();

            $randomFirst  = rand(1, 200);
            $randomSecond = (rand(1, 50) + $randomFirst);

            $campagne
                ->setNomCampagne('Campagne ' . $i)
                ->setCreator($this->getReference('user' . rand(0, 4)))
                ->setDateStart(new \DateTime('+' . $randomFirst . ' days'))
                ->setDateEnd(new \DateTime('+' . $randomSecond.' days'))
            ;

            $manager->persist($campagne);

            $this->addReference('campagne' . $i, $campagne);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
