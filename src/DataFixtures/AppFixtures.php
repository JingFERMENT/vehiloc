<?php

namespace App\DataFixtures;

use App\Factory\VoitureFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        VoitureFactory::createMany(10);
        // $manager->flush();
    }
}


