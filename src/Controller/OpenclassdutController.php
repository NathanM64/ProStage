<?php

namespace App\Controller;
use App\Entity\Stage;
use App\Entity\Entreprise;
use App\Entity\Formations;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;


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

    public function ajouterUneEntreprise(Request $request, ObjectManager $manager)
    {
        //Création d'un objet entreprise vide
        $entreprise = new Entreprise();



        //Création du formulaire permettant de saisir une entreprise
        $formulaireEntreprise = $this->createFormBuilder($entreprise)
            ->add('nom')
            ->add('activite')
            ->add('adresse', TextareaType::class)
            ->add('site')
            ->getForm();
        
        //Enregistrer les donnéees dans l'objet $entreprise une fois la soumission du formulaire
        $formulaireEntreprise -> handleRequest($request);

        if($formulaireEntreprise->isSubmitted() && $formulaireEntreprise -> isValid())
        {
            //Enregistrement de l'entreprise en BD
            $manager -> persist($entreprise);
            $manager ->flush();

            //On  redirige l'utilisateur vers la page qui liste toutes les entreprises
            return $this->redirect($this->generateUrl('entreprises'));
        }
        

        return $this->render('openclassdut/ajouterUneEntreprise.html.twig',array('vueFormulaireEntreprise'=>$formulaireEntreprise->createView()));
    }
    public function modifierUneEntreprise(Request $request, ObjectManager $manager, Entreprise $entreprise)
    {
        // creation d'un objet formulaire pour saisir un nouveau stage
        $formulaireEntreprise = $this -> createFormBuilder($entreprise)
                -> add ('nom')
                -> add ('activite')
                -> add ('adresse',TextareaType::class)
                -> add ('site',UrlType::class)
                -> getForm();

        $formulaireEntreprise -> handleRequest($request);

        //traiter les données du formulaire s'il a été soumi
        if ($formulaireEntreprise -> isSubmitted() && $formulaireEntreprise -> isValid() )
        {
            // enregistrer l'entreprise en BD
            $manager -> persist($entreprise);
            $manager->flush();

            //redirection de l'utilisateur vers la page affichant la list des entreprises
            return $this->redirectToRoute('entreprises');
        }

        // générer la vue représentant le formulaire
        $vueFormulaireModifEntreprise = $formulaireEntreprise -> createView();


        // afficher la page d'ajout d'une ressource
        return $this->render('openclassdut/modifierUneEntreprise.html.twig', ['vueFormulaireModifEntreprise' => $vueFormulaireModifEntreprise]);

    }
//    public function ajouterUnStage(Request $request, ObjectManager $manager)
//    {
//        //Création d'un objet entreprise  = new Stage();
//
//
//
//        //Création du formulaire permettant de saisir une entreprisevide
//        //        $stage
//        $formulaireStage = $this->createFormBuilder($stage)
//            ->add('titre', TextType::class)
//            ->add('descriptionMission')
//            ->add('email', TextareaType::class)
//            ->add('entreprise', UrlType::class)
//            ->getForm();
//
//        //Enregistrer les donnéees dans l'objet $entreprise une fois la soumission du formulaire
//        $formulaireStage -> handleRequest($request);
//
//        if($formulaireStage->isSubmitted())
//        {
//            //Enregistrement de l'entreprise en BD
//            $manager -> persist($stage);
//            $manager ->flush();
//
//            //On  redirige l'utilisateur vers la page qui liste toutes les entreprises
//            return $this->redirect($this->generateUrl('entreprises'));
//        }
//
//
//        return $this->render('openclassdut/ajotuerUnStage.html.twig',array('vueFormulaireStage'=>$formulaireStage->createView()));
//    }
    
}
