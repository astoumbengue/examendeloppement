<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Maison;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	 $faker = Factory::create('local');

       for ($i=0; $i<20; $i++) {
           $property = new Maison();
           $property
               ->setTitre($faker->words(3, true))
               ->setDescription($faker->sentences(5, true))
               ->setNbrechambre($faker->numberBetween(1,7))
               ->setEtage($faker->numberBetween(0,7))
               ->setPrix($faker->numberBetween(75000,500000))
               ->setAdresse($faker->address)
               ->setValidation(false);
           $manager->persist($property);
        // $product = new Product();
        // $manager->persist($product);
             }

        $manager->flush();
  
}
  }
