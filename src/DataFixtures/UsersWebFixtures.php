<?php

namespace App\DataFixtures;

use App\Entity\UsersWeb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UsersWebFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 10; $i++) {
            $user = new UsersWeb();
            $user->setUsername('user' . $i);
            $user->setMail('user' . $i . '@example.com');
            $user->setPassword('password' . $i);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
