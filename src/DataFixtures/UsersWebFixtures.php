<?php

namespace App\DataFixtures;

use App\Entity\UsersIG;
use App\Entity\UsersWeb;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Uuid;

class UsersWebFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 10; $i++) {
            $userWeb = new UsersWeb();
            $userIG = new UsersIG();

            $userWeb->setUsername('userWeb' . $i);
            $userWeb->setMail('userWeb' . $i . '@example.com');
            $userWeb->setPassword('password' . $i);

            $userIG->setUuid(Uuid::V4_RANDOM);
            $userIG->setUsername("userIG" . $i);
            $userIG->setRanks([]);
            $userIG->setIsLinked(false);
            $userIG->setIsOnline(false);
            $userIG->setJoinedAt(new \DateTime);

            $manager->persist($userWeb);
            $manager->persist($userIG);
        }

        $manager->flush();
    }
}
