<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public const RECRUITER_USER_REFERENCE = 'recruiter-user';

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Compte APPLICANT
        $user1 = (new User())
            ->setEmail("applicant@gmail.com")
            ->setRoles(array("ROLE_APPLICANT"));
            
        $password = $this->hasher->hashPassword($user1, 'Jello');
        $user1->setPassword($password);
        
        $manager->persist($user1);

        // Compte RECRUITER
        $user2 = (new User())
            ->setEmail("recruiter@gmail.com")
            ->setRoles(array("ROLE_RECRUITER"));
            
        $password = $this->hasher->hashPassword($user2, 'Jello');
        $user2->setPassword($password);
        
        $manager->persist($user2);

        // Compte ADMIN
        $user3 = (new User())
            ->setEmail("admin@gmail.com")
            ->setRoles(array("ROLE_ADMIN"));
            
        $password = $this->hasher->hashPassword($user3, 'Jello');
        $user3->setPassword($password);
        
        $manager->persist($user3);

        // Compte SUPER ADMIN
        $user4 = (new User())
            ->setEmail("superadmin@gmail.com")
            ->setRoles(array("ROLE_SUPER_ADMIN"));
            
        $password = $this->hasher->hashPassword($user4, 'Jello');
        $user4->setPassword($password);
        
        $manager->persist($user4);

        // Compte Antoine => Don't Touch
        $user5 = (new User())
            ->setEmail("quidelantoine@gmail.com")
            ->setRoles(array("ROLE_ADMIN"));
        $password = $this->hasher->hashPassword($user5, 'michel');
        $user5->setPassword($password);
        $manager->persist($user5);
        // Compte Antoine

        $manager->flush();

        $this->addReference(self::RECRUITER_USER_REFERENCE, $user2);
    }
}
