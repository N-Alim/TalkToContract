<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = (new User())
            ->setEmail("admin@gmail.com")
            ->setRoles(array("ROLE_ADMIN"));
            
        $password = $this->hasher->hashPassword($user1, 'Jello');
        $user1->setPassword($password);
        
        $manager->persist($user1);

        // Compte USER
        $user3 = (new User())
            ->setEmail("user@gmail.com")
            ->setRoles(array("ROLE_USER"));
            
        $password = $this->hasher->hashPassword($user3, 'Jello');
        $user3->setPassword($password);
        
        $manager->persist($user1);
        // Compte USER

        // Compte Antoine => Don't Touch
        $user2 = (new User())
            ->setEmail("quidelantoine@gmail.com")
            ->setRoles(array("ROLE_ADMIN"));
        $password = $this->hasher->hashPassword($user1, 'michel');
        $user2->setPassword($password);
        $manager->persist($user2);
        // Compte Antoine

        $manager->flush();
    }
}
