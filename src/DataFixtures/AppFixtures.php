<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formations;
use App\Entity\Stage;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        
        for ($i=0 ; $i < 10 ; $i++) { 
            
            $Entreprise = new Entreprise();
            $Entreprise->setAdresse($faker->realText($maxNbChars = 50 , $indexSize = 2));
            $Entreprise->setActivite($faker->realText($maxNbChars = 50 , $indexSize = 2));
            $Entreprise->setNom($faker->realText($maxNbChars = 30 , $indexSize = 2));
            $Entreprise->setSite($faker->realText($maxNbChars = 50 , $indexSize = 2));
            $manager->persist($Entreprise);

            $Formation = new Formations();
            $Formation ->setLibelle($faker->realText($maxNbChars = 50 , $indexSize = 2));
            $Formation ->setNomComplet($faker->realText($maxNbChars = 50 , $indexSize = 2));
            $manager->persist($Formation);
             
            
            $Stage = new Stage();
            $Stage->setTitre($faker->realText($maxNbChars = 50 , $indexSize = 2));
            $Stage->SetDescriptionMission($faker->realText($maxNbChars = 400 , $indexSize = 2));
            $Stage->setEmail($faker->realText($maxNbChars = 30 , $indexSize = 2));
            
            $Stage->addFormation($Formation);
            
            $Entreprise->addStage($Stage);
                
            $manager->persist($Stage);
        

        }
        
        
        $manager->flush();
    }
}
