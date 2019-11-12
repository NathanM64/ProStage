<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OpenclassdutController extends AbstractController
{
    public function index()
    {
        return $this->render('openclassdut/index.html.twig', [
            'controller_name' => 'OpenclassdutController',
        ]);
    }
}
