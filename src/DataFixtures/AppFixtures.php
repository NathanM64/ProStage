<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Entreprise;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $Lindt = new Entreprise();
        $Lindt->setAdresse("11 rue avenue Miteran");
        $Lindt->setActivite("Chocolat");
        $Lindt->setNom("Lindt");
        $Lindt->setSite("Lindt.com");
        
        $manager->persist($Lindt);

        $manager->flush();
    }
}
