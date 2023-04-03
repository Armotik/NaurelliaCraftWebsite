<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    { }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("anthonymudet94@gmail.com");
        $user->setPassword($this->passwordHasher->hashPassword($user, "root"));
        // $manager->persist($product);

        $manager->flush();
    }
}
