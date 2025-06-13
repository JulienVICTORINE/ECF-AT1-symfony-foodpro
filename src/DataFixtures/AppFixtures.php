<?php

namespace App\DataFixtures;

use App\Entity\Dish;
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

        $chef1 = new User();
        $chef1->setPassword('Chef123!');
        $chef1->setEmail('marie@chef.fr');
        $chef1->setFirstname('Marie');
        $chef1->setLastname('Dubois');
        $chef1->setRoles(array('ROLE_USER'));
        $chef1->setCreatedAt(new \DateTimeImmutable("now"));
        $manager->persist($chef1);

        $chef2 = new User();
        $chef2->setPassword('Chef123!');
        $chef2->setEmail('jean@cuisine.fr');
        $chef2->setFirstname('Jean');
        $chef2->setLastname('Martin');
        $chef2->setRoles(array('ROLE_USER'));
        $chef2->setCreatedAt(new \DateTimeImmutable("now"));
        $manager->persist($chef2);

        // for ($i = 0; $i < 3; $i++) {
        //     $name = 'r' . $i;
        //     $user = new User();
        //     $user->setPassword($name);
        //     $user->setEmail($name . '@foodpro.fr');
        //     $user->setFirstname($name);
        //     $user->setLastname($name);
        //     $user1->setCreatedAt(new \DateTimeImmutable("now"));

        //     for ($i = 0; $i < 4; $i++) {
        //         $dish = new Dish();
        //         $dish->setOwner($user);
        //         $dish->setName('name' . $i)
        //             ->setPrice('price')
        //             ->setCategory('Entrées' . $i)
        //             ->setCreated(new \DateTimeImmutable("now"))
        //             ->setUpdatedAt(new \DateTimeImmutable("now"));
        //         $manager->persist($dish);
        //     }
        //     for ($i = 5; $i < 8; $i++) {
        //         $dish = new Dish();
        //         $dish->setOwner($user);
        //         $dish->setName('name' . $i)
        //             ->setPrice('price')
        //             ->setCategory('Plats' . $i)
        //             ->setCreated(new \DateTimeImmutable("now"))
        //             ->setUpdatedAt(new \DateTimeImmutable("now"));
        //         $manager->persist($dish);
        //     }
        //     for ($i = 5; $i < 7; $i++) {
        //         $dish = new Dish();
        //         $dish->setOwner($user);
        //         $dish->setName('name' . $i)
        //             ->setPrice('price')
        //             ->setCategory('Desserts' . $i)
        //             ->setCreated(new \DateTimeImmutable("now"))
        //             ->setUpdatedAt(new \DateTimeImmutable("now"));
        //         $manager->persist($dish);
        //     }
        //     $manager->persist($user);
        // }

        $manager->flush();
    }
}
