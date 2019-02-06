<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Administrator extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $administrator = new \App\Entity\Administrator();
        $administrator ->setEmail('administrator@skola.rs');
        $administrator ->setSifra('12345');
        $manager->persist($administrator);

        $manager->flush();
    }
}
