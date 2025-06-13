<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user1 = new User();
        $user1->setPassword('Admin123!');
        $user1->setEmail('admin@foodpro.fr');
        $user1->setFirstname('admin');
        $user1->setLastname('admin');
        $user1->setRoles(array('ROLE_ADMIN'));
        $user1->setCreatedAt(new \DateTimeImmutable("now"));
        $manager->persist($user1);

        $manager->flush();
    }}
