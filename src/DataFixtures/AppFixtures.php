<?php

namespace App\DataFixtures;

use App\Entity\Producer;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $producer1 = new Producer();
        // $producer1->setName('Mastermet');
        // $manager->persist($producer1);


        // $product1 = new Product();
        // $product1->setCode('MM1');
        // $product1->setName('MM1');
        // $product1->setProducer($producer1);
        // $product1->setPrice('100.25');
        // $product1->setStock(20);
        // $manager->persist($product1);

        // $product2 = new Product();
        // $product2->setCode('MM2');
        // $product2->setName('MM2');
        // $product2->setProducer($producer1);
        // $product2->setPrice('37');
        // $product2->setStock(33);
        // $manager->persist($product2);

        $manager->flush();
    }
}
