<?php

namespace App\Controller;

use App\Repository\InfosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(InfosRepository $infosRepository): Response
    {   
        //recherche du path du logo
        $mappingsParams = $this->getParameter('vich_uploader.mappings');
        $imagePath = $mappingsParams['infos']['uri_prefix'].'/';
        
        //recherche des infos de l'accueil, du header et du footer 
        $infos = $infosRepository->getInfos();
    
        return $this->render('home/index.html.twig', [
            'director' => 'Vincent Parrot', 
            'infos' => $infos,
            'imagePath' => $imagePath
        ]);
    }
    #[Route('/admin', name: 'app_admin')]
    public function admin(Security $security): Response
    {
        $user = $security->getUser();
        return $this->render('admin/dashboard.html.twig', [
            'user' => $user,
        ]);
    }
}
