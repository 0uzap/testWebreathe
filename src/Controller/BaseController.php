<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\TypeDeDonneesType;
use App\Form\MesuresType;
use App\Form\ModulesType;
use App\Entity\Module;
use App\Entity\Mesures;
use App\Entity\DonneesNumeriques;


class BaseController extends AbstractController
{
    #[Route('/', name: 'acceuil')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
            
        ]);
    }

    #[Route('/ajoutTypeDonnee', name: 'ajoutTypeDonnee')]
    public function ajoutTypeDonnee(request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $donneesNumeriques = new DonneesNumeriques();
        $form = $this->createForm(TypeDeDonneesType::class, $donneesNumeriques);

        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()) {
                $entityManagerInterface->persist($donneesNumeriques);
                $entityManagerInterface->flush();

                return $this->redirectToRoute('acceuil');
            }
        }

        return $this->render('formulaireAjout/ajoutTypeDonnee.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/ajoutMesures', name: 'ajoutMesures')]
    public function ajoutMesures(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mesures = new Mesures();
        $form = $this->createForm(MesuresType::class, $mesures);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $nouveauModuleNom = $form->get('nouveau_module')->getData();

                if (!empty($nouveauModuleNom)) {
                    $nouveauModule = new Module();
                    $nouveauModule->setNom($nouveauModuleNom);
                    $entityManager->persist($nouveauModule);
                    $mesures->setModule($nouveauModule);
                }

                $entityManager->persist($mesures);
                $entityManager->flush();

                return $this->redirectToRoute('acceuil');
            }
        }
        return $this->render('formulaireAjout/ajoutMesures.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/graphique', name: 'graphique')]
    public function graphique(EntityManagerInterface $entityManagerInterface ): Response
    {
        $repoModule = $entityManagerInterface->getRepository(Module::class);
        $modules = $repoModule->findAll();

        return $this->render('base/graphique.html.twig', [
            'modules' => $modules,
        ]);
    }

}
