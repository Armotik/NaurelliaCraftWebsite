<?php

namespace App\DataFixtures;

use App\Entity\Infractions;
use App\Entity\User;
use App\Entity\UserIG;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

class AppFixtures extends Fixture
{

    /**
     * AppFixtures constructor.
     * @param UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    { }

    /**
     * Load data fixtures with the passed ObjectManager
     * @param ObjectManager $manager The object manager
     */
    public function load(ObjectManager $manager): void
    {
        // Create a Admin user
        $user = new User();
        $user->setUsername("Admin");
        $user->setMail("admin@example.com");
        $user->setPassword($this->passwordHasher->hashPassword($user, 'root'));
        $user->setRoles(["ROLE_ADMIN"]);

        $manager->persist($user);

        // Create a Admin userIG
        $userIG = new UserIG();
        $userIG->setUsername("Armotik");
        $userIG->setUuid(Uuid::fromString("0c06acbf-5114-4153-82c5-2a85a3f4320e"));
        $userIG->setRanks(["ROLE_ADMIN"]);
        $userIG->setIsOp(true);

        $manager->persist($userIG);

        // Create a Test user
        $user2 = new User();
        $user2->setUsername("Armotika");
        $user2->setMail("armotika@example.com");
        $user2->setPassword($this->passwordHasher->hashPassword($user, 'test'));
        $user2->setRoles(["ROLE_TEST"]);

        $manager->persist($user2);

        // Create a Test userIG
        $userIG2 = new UserIG();
        $userIG2->setUsername("Armotika");
        $userIG2->setUuid(Uuid::fromString("d4d2ad76-f412-4c1e-8858-43045093e4ed"));

        $manager->persist($userIG2);

        // Create 10 users
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername("User$i");
            $user->setMail("user".$i."@example.com");
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'.$i));
            $user->setRoles(["ROLE_USER"]);

            $manager->persist($user);
        }

        // Create 6 usersIG
        for ($i = 0; $i < 6; $i++) {
            $user = new UserIG();

            $user->setUuid(Uuid::v4());
            $user->setUsername("User$i");

            $manager->persist($user);
        }

        // Create 1 infraction
        $infraction = new Infractions();
        $infraction->setTargetUUID($userIG2);
        $infraction->setStaffUUID($userIG);
        $infraction->setType("WARN");
        $infraction->setReason("Test Fixtures");

        $manager->persist($infraction);

        $manager->flush();
    }
}
