<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('admin@example.com');
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setPassword(password_hash('admin123', PASSWORD_BCRYPT));
        $manager->persist($user1);

        $manager->flush();
    }
}
