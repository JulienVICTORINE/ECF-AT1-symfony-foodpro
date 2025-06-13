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

        // // Pour les repas
        // $dishes = [
        //     // Entrées
        //     ['name' => 'Salade César', 'price' => 12.0, 'category' => 'Entrées', 'owner' => $chef1],
        //     ['name' => 'Soupe de potiron', 'price' => 8.0, 'category' => 'Entrées', 'owner' => $chef2],
        //     ['name' => 'Carpaccio de boeuf', 'price' => 16.0, 'category' => 'Entrées', 'owner' => $chef1],
        //     ['name' => 'Bruschetta', 'price' => 10.0, 'category' => 'Entrées', 'owner' => $chef2],

        //     // Plats
        //     ['name' => 'Boeuf bourguignon', 'price' => 24.0, 'category' => 'Plats', 'owner' => $chef1],
        //     ['name' => 'Saumon grillé', 'price' => 22.0, 'category' => 'Plats', 'owner' => $chef2],
        //     ['name' => 'Risotto aux champignons', 'price' => 18.0, 'category' => 'Plats', 'owner' => $chef1],
        //     ['name' => 'Coq au vin', 'price' => 26.0, 'category' => 'Plats', 'owner' => $chef2],

        //     // Desserts
        //     ['name' => 'Tiramisu', 'price' => 8.0, 'category' => 'Desserts', 'owner' => $chef1],
        //     ['name' => 'Tarte tatin', 'price' => 7.0, 'category' => 'Desserts', 'owner' => $chef2],
        //     ['name' => 'Crème brûlée', 'price' => 9.0, 'category' => 'Desserts', 'owner' => $chef1],
        //     ['name' => 'Mousse au chocolat', 'price' => 6.0, 'category' => 'Desserts', 'owner' => $chef2],
        // ];

        // for ($i = 0; $i < 3; $i++) {
        //     $name = 'r' . $i;
        //     $user = new User();
        //     $user->setPassword($name);
        //     $user->setEmail($name . '@foodpro.fr');
        //     $user->setFirstname($name);
        //     $user->setLastname($name);
        //     $user1->setCreatedAt(new \DateTimeImmutable("now"));

        //     foreach ($dishes as $d) {
        //         $dish = new Dish();
        //         $dish->setName($d['name'])
        //             ->setPrice($d['price'])
        //             ->setCategory($d['category'])
        //             ->setOwner($d['owner'])
        //             ->setCreated(new \DateTimeImmutable())
        //             ->setUpdatedAt(new \DateTimeImmutable());
        //         $manager->persist($dish);
        //     }   

        //     $manager->persist($user);
        // }

        $manager->flush();
    }
}
