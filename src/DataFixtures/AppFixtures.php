<?php

namespace App\DataFixtures;

use App\Entity\Infractions;
use App\Entity\ShopItem;
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
    {
    }

    /**
     * Load data fixtures with the passed ObjectManager
     * @param ObjectManager $manager The object manager
     */
    public function load(ObjectManager $manager): void
    {

        /*
         *
         * Shop items fixtures
         *
         */

        // Create 1 shop item (Hero Rank)
        $heroRank = new ShopItem();
        $heroRank->setId(1);
        $heroRank->setDesignation("Hero");
        $heroRank->setPrice(5.00);
        $heroRank->setReference("NC_RK001");
        $heroRank->setQuantity(null);
        $heroRank->setDescription('The "Hero" rank offers you an enhanced gameplay experience with exclusive perks such as a personalized rank on our Discord server and a personalized in-game display. You\'ll also have access to three instant teleportation points, the /craft command, and you\'ll get priority in the VIP queue. In addition, you\'ll enjoy double XP and quest rewards as well as access to more quests. Each day, you\'ll receive a heroic crate, in addition you\'re town will receive 10 additional claims to protect your land. Join the NaurelliaCraft community for an unparalleled gaming experience!');
        $heroRank->setAdvantages([
            "Custom Discord Rank",
            "Custom In Game display",
            "3 homes",
            "Instant teleportation",
            "/craft command",
            "Access to the VIP queue",
            "XP x2",
            "Quest rewards x2",
            "More quests",
            "1 hero crate per day",
            "+10 bonus claims"
        ]);

        $manager->persist($heroRank);

        // Create 1 shop item (Legend Rank)
        $legendRank = new ShopItem();
        $legendRank->setId(2);
        $legendRank->setDesignation("Legend");
        $legendRank->setPrice(15.00);
        $legendRank->setReference("NC_RK002");
        $legendRank->setQuantity(null);
        $legendRank->setDescription("The \"Legend\" rank in our NaurelliaCraft store offers you an enhanced gameplay experience with exclusive perks such as a custom rank on our Discord server and a custom in-game display. You'll also have access to five instant teleportation points, the /craft command as well as /furnace, and you'll be able to move up in the VIP queue. In addition, you'll enjoy double XP and quest rewards as well as access to more quests. Each day you will receive a legend crate and in addition to that your town will receive 20 extra claims to protect your land. You will also be able to cast your spells 1s faster and you will be able to sell in the strongholds. Join the VIP community for an unparalleled gaming experience!");
        $legendRank->setAdvantages([
            "Custom Discord Rank",
            "Custom In Game display",
            "5 homes",
            "Instant teleportation",
            "/craft command",
            "/furnace command",
            "Access to the VIP queue",
            "XP x3",
            "Quest rewards x3",
            "More quests",
            "1 legend crate per day",
            "+20 bonus claims",
            "Spells are 1s faster",
            "No more fall damage in your city",
            "Be able to sell in the strongholds"
        ]);

        $manager->persist($legendRank);

        // Create 1 shop item (Premium Rank)
        $premiumRank = new ShopItem();
        $premiumRank->setId(3);
        $premiumRank->setDesignation("Premium");
        $premiumRank->setPrice(50.00);
        $premiumRank->setReference("NC_RK003");
        $premiumRank->setQuantity(null);
        $premiumRank->setDescription("The \"Premium\" rank in our NaurelliaCraft store offers you an enhanced gameplay experience with exclusive perks such as a custom rank on our Discord server and a custom in-game display. You will also have access to five instant teleportation points, /craft, /furnace, /nv, /townfly and /bottle commands, and you will have priority in the VIP queue. In addition, you'll enjoy double XP and quest rewards as well as access to more quests. Each day you will receive a legend crate and on top of that your town will receive 30 extra claims to protect your land. You will also be able to cast your spells 1s faster and you will be able to sell in the strongholds. Join the VIP community for an unparalleled gaming experience!");
        $premiumRank->setAdvantages([
            "Custom Discord Rank",
            "Custom In Game display",
            "7 homes",
            "Instant teleportation",
            "/craft command",
            "/furnace command",
            "/nv command",
            "/townfly command",
            "/bottle command",
            "Access to the VIP queue",
            "XP x4",
            "Quest rewards x4",
            "More quests",
            "1 premium crate per day",
            "+30 bonus claims",
            "Spells are 1.5s faster",
            "No more fall damage in your city",
            "Be able to sell in the strongholds"
        ]);

        $manager->persist($premiumRank);

        // Create 1 shop item (Royal Rank)
        $royalRank = new ShopItem();
        $royalRank->setId(4);
        $royalRank->setDesignation("Royal");
        $royalRank->setPrice(5.00);
        $royalRank->setReference("NC_RK004");
        $royalRank->setQuantity(null);
        $royalRank->setDescription("The \"Royal\" rank in our NaurelliaCraft store offers you an enhanced gameplay experience with exclusive perks such as a custom rank on our Discord server and a custom in-game display. You will also have access to five instant teleportation points, /craft, /furnace, /nv, /townfly, /bottle, /nick, /head, and /ec commands, as well as priority in the VIP queue. In addition, you'll enjoy double XP and quest rewards as well as access to more quests. Each day you will receive a legend crate and on top of that your town will receive 40 extra claims to protect your land. You will also be able to cast your spells 1s faster and you will be able to sell in the strongholds. This rank is a subscription and requires the \"Premium\" rank and to thank players for their support, they will have access to exclusive discounts on our entire store. Join the VIP community for an unparalleled gaming experience!");
        $royalRank->setAdvantages([
            "Custom Discord Rank",
            "Custom In Game display",
            "10 homes",
            "Instant teleportation",
            "/craft command",
            "/furnace command",
            "/nv command",
            "/townfly command",
            "/bottle command",
            "/head command",
            "/nick command",
            "/ec command",
            "Access to the VIP queue",
            "XP x5",
            "Quest rewards x5",
            "More quests",
            "1 royal crate per day",
            "+40 bonus claims",
            "Spells are 2s faster",
            "No more fall damage in your city",
            "Be able to sell in the strongholds",
            "Exclusives reductions on the shop"
        ]);

        $manager->persist($royalRank);

        // Create 1 shop item (Gold x1000)
        $gold1 = new ShopItem();
        $gold1->setId(101);
        $gold1->setDesignation("Gold x1000");
        $gold1->setPrice(10.00);
        $gold1->setReference("NC_GD001");
        $gold1->setQuantity(null);
        $gold1->setDescription("The \"Gold x1000\" item in our NaurelliaCraft store offers you 1000 gold coins to spend in game for cosmetics.");
        $gold1->setAdvantages([
            "1000 gold coins"
        ]);

        $manager->persist($gold1);

        // Create 1 shop item (Gold 2500)
        $gold2 = new ShopItem();
        $gold2->setId(102);
        $gold2->setDesignation("Gold x2500");
        $gold2->setPrice(25.00);
        $gold2->setReference("NC_GD002");
        $gold2->setQuantity(null);
        $gold2->setDescription("The \"Gold x2500\" item in our NaurelliaCraft store offers you 2000 gold coins to spend in game for cosmetics.");
        $gold2->setAdvantages([
            "2500 gold coins"
        ]);

        $manager->persist($gold2);

        // Create 1 shop item (Gold x5000)
        $gold3 = new ShopItem();
        $gold3->setId(103);
        $gold3->setDesignation("Gold x5000");
        $gold3->setPrice(45.00);
        $gold3->setReference("NC_GD003");
        $gold3->setQuantity(null);
        $gold3->setDescription("The \"Gold x5000\" item in our NaurelliaCraft store offers you 5000 gold coins to spend in game for cosmetics.");
        $gold3->setAdvantages([
            "5000 gold coins"
        ]);

        $manager->persist($gold3);

        // Create 1 shop item (Gold x10000)
        $gold4 = new ShopItem();
        $gold4->setId(104);
        $gold4->setDesignation("Gold x10000");
        $gold4->setPrice(80.00);
        $gold4->setReference("NC_GD004");
        $gold4->setQuantity(null);
        $gold4->setDescription("The \"Gold x10000\" item in our NaurelliaCraft store offers you 10000 gold coins to spend in game for cosmetics.");
        $gold4->setAdvantages([
            "10000 gold coins"
        ]);

        $manager->persist($gold4);

        /*
         *
         * Users and UserIG fixtures
         *
         */

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
        $userIG->addRank($legendRank);
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
            $user->setMail("user" . $i . "@example.com");
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password' . $i));

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
