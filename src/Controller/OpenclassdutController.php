<?php

namespace App\Controller;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OpenclassdutController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    
    
    
    

    public function accueil()
    {
        
        return $this->render('openclassdut/accueil.html.twig', [
            'controller_name' => 'OpenclassdutController',
        ]);
    }
    /**
     * @Route("/entreprises", name="entreprises")
     */
    public function entreprises()
    {
        return $this->render('openclassdut/entreprises.html.twig', [
            'controller_name' => 'OpenclassdutController',
        ]);
    }
    /** 
     * @Route("/formations", name="formations")
     */
    public function formations()
    {
        return $this->render('openclassdut/formations.html.twig', [
            'controller_name' => 'OpenclassdutController',
        ]);
    }
    /** 
     * @Route("/stage", name="stage")
     */
    public function stage()
    {
        
        $repositoryStages = $this->getDoctrine()->getRepository(Stage::class);
        
        $stages = $repositoryStages -> findAll();

        

        return $this->render('openclassdut/stage.html.twig',['listeStages' => $stages]);
    }    
    /** 
     * @Route("/stageDetaillee/{id}", name="stageDetaillee")
     */
    
    public function stageDetaillee($id)
    {
        $repositoryStages = $this->getDoctrine()->getRepository(Stage::class);

        $infoStage = $repositoryStages -> find($id);
        
        return $this->render('openclassdut/stageDetaillee.html.twig',['id' => $id, 'infoStage' => $infoStage]);
    }
    
}
