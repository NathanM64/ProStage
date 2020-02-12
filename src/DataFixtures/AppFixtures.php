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
            $Stage->SetDescriptionMission($faker->realText($maxNbChars = 255 , $indexSize = 2));
            $Stage->setEmail($faker->realText($maxNbChars = 30 , $indexSize = 2));

            $Stage2 = new Stage();
            $Stage2->setTitre($faker->realText($maxNbChars = 50 , $indexSize = 2));
            $Stage2->SetDescriptionMission($faker->realText($maxNbChars = 255 , $indexSize = 2));
            $Stage2->setEmail($faker->realText($maxNbChars = 30 , $indexSize = 2));
            
            $Stage->addFormation($Formation);
            $Stage2->addFormation($Formation);
            
            $Entreprise->addStage($Stage);
            $Entreprise->addStage($Stage2);
                
            $manager->persist($Stage);
            $manager->persist($Stage2);
        

        }
        
        
        $manager->flush();
    }
}
