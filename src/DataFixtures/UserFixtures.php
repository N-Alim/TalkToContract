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
        $manager->flush();
    }
}
