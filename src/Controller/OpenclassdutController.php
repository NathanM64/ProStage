<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OpenclassdutController extends AbstractController
{
    public function accueil()
    {
        return $this->render('openclassdut/accueil.html.twig', [
            'controller_name' => 'OpenclassdutController',
        ]);
    }
    public function entreprises()
    {
        return $this->render('openclassdut/entreprises.html.twig', [
            'controller_name' => 'OpenclassdutController',
        ]);
    }
}
