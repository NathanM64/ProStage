<?php

namespace App\Controller;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OpenclassdutController extends AbstractController
{
    
    public function accueil()
    {
        
        return $this->render('openclassdut/accueil.html.twig', ['controller_name' => 'OpenclassdutController',]);
    }
    
    public function entreprises()
    {
        $repositoryEntreprise = $this->getDoctrine()->getRepository(Entreprise::class);

        $infoEntreprises = $repositoryEntreprise->findAll();

        return $this->render('openclassdut/entreprises.html.twig', ['controller_name' => 'OpenclassdutController', 'infoEntreprises' => $infoEntreprises]);
    }
    
    public function formations()
    {
        
        $repositoryFormation = $this->getDoctrine()->getRepository(Formations::class);

        $infoFormation = $repositoryFormation->findAll();
   
        return $this->render('openclassdut/formations.html.twig', ['controller_name' => 'OpenclassdutController', 'infoFormation' => $infoFormation ]);
    }

    public function stage()
    {
        
        $repositoryStages = $this->getDoctrine()->getRepository(Stage::class);
        
        $stages = $repositoryStages -> getStageEtEntrepriseEtFormation();

        return $this->render('openclassdut/stage.html.twig',['listeStages' => $stages]);
    }    
   
    
    public function stageDetaille($id)
    {
        $repositoryStages = $this->getDoctrine()->getRepository(Stage::class);

        $infoStage = $repositoryStages -> find($id);
        
        return $this->render('openclassdut/stageDetaille.html.twig',['id' => $id, 'infoStage' => $infoStage]);
    }

    public function stageParEntreprise($nom)
    {
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        $infoStages = $repositoryStage->getStagesParEntreprise($nom);

        return $this->render('openclassdut/stageParEntreprise.html.twig', ['infoStages' => $infoStages]);
    }

    public function stageParFormation($nom)
    {
        $repositoryStage = $this->getDoctrine()->getRepository(Stage::class);

        $infoStages = $repositoryStage->getStagesParFormation($nom);

        return $this->render('openclassdut/stageParFormation.html.twig', ['infoStages' => $infoStages]);
    }
    
}
