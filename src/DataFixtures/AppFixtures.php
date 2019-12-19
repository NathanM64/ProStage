<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Entreprise;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        $nbEntrep = 10;
        for ($i=0 ; $i < $nbEntrep ; $i++) { 
            
            $Lindt = new Entreprise();
            $Lindt->setAdresse($faker->realText($maxNbChars = 50 , $indexSize = 2));
            $Lindt->setActivite($faker->realText($maxNbChars = 50 , $indexSize = 2));
            $Lindt->setNom($faker->realText($maxNbChars = 30 , $indexSize = 2));
            $Lindt->setSite($faker->realText($maxNbChars = 50 , $indexSize = 2));
            
            $manager->persist($Lindt);
        }
        

        $manager->flush();
    }
}
