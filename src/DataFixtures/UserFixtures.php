<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        $nombreUsers = 5;

        for($i = 0; $i < $nombreUsers; $i++) {
           $user = new User();

           if(rand(1, 10) >= 7) {
               $role = ["ROLE_USER"];
           } else {
               $role = ["ROLE_ADMIN"];
           }

           $password = $this->encoder->encodePassword($user, 'ok123');

           $user
               ->setEmail($faker->email)
               ->setRoles($role)
               ->setPassword($password);

           $manager->persist($user);

           $this->addReference('user' . $i, $user);

        }

        $manager->flush();
    }
}
