<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Entreprise;
use App\Entity\Formations;
use App\Entity\Stage;
use App\Entity\User;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Création d'un Utilisateur admin

        $nathan = new User();
        $nathan ->setPrenom("Nathan");
        $nathan ->setNom("Marimbordes");
        $nathan ->setEmail("marimbordes.nathan@gmail.com");
        $nathan ->setRoles(['ROLE_USER','ROLE_ADMIN']);
        $nathan ->setPassword('$2y$10$uembXr0po.FF1UYp4QlBVenhEOuHIWhvddjuXh4EH33I4dyWHwwtq');

        $manager->persist($nathan);
        $user = new User();
        $user ->setPrenom("u");
        $user ->setNom("u");
        $user ->setEmail("u@gmail.com");
        $user ->setRoles("ROLE_USER");
        $user ->setPassword('$2y$10$uembXr0po.FF1UYp4QlBVenhEOuHIWhvddjuXh4EH33I4dyWHwwtq');

        $manager->persist($user);
        $faker = \Faker\Factory::create('fr_FR');
        
        for ($i=0 ; $i < 10 ; $i++) { 
            
            $Entreprise = new Entreprise();
            $Entreprise->setAdresse($faker->address);
            $Entreprise->setActivite($faker->catchphrase);
            $Entreprise->setNom($faker->company);
            $Entreprise->setSite($faker->url);
            $manager->persist($Entreprise);

            $Formation = new Formations();
            $Formation ->setLibelle($faker->realText($maxNbChars = 50 , $indexSize = 2));
            $Formation ->setNomComplet($faker->realText($maxNbChars = 50 , $indexSize = 2));
            $manager->persist($Formation);
             
            
            $Stage = new Stage();
            $Stage->setTitre($faker->realText($maxNbChars = 50 , $indexSize = 2));
            $Stage->SetDescriptionMission($faker->realText($maxNbChars = 255 , $indexSize = 2));
            $Stage->setEmail($faker->safeEmail);

            $Stage2 = new Stage();
            $Stage2->setTitre($faker->realText($maxNbChars = 50 , $indexSize = 2));
            $Stage2->SetDescriptionMission($faker->realText($maxNbChars = 255 , $indexSize = 2));
            $Stage2->setEmail($faker->safeEmail);
            
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
