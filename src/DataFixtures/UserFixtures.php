<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        // $user = new Users();
        // $user
        // $user->setPassword($this->passwordEncoder->encodePassword($user, "admin"))
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
