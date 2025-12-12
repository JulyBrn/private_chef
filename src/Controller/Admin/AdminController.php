<?php

namespace App\Controller\Admin;


use App\Repository\ArticleRepository;
use App\Repository\MenuRepository;
use App\Repository\ProspectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class AdminController extends AbstractController
{
  #[Route('/admin', name: 'admin')]
  public function index(ArticleRepository $article, ProspectRepository $prospect, MenuRepository $menu,Request $request): Response
  {
    $publications = $article->findAll();

    $tabMenu = $menu->findAll();
    
    $page = $request->query->getInt('page',1);
    $prospects = $prospect->paginateProspect($page);
    

    // $this->denyAccessUnlessGranted('ROLE_USER');
    return $this->render('admin/admin.html.twig', [
      'publications' => $publications,
      'prospects'    => $prospects,
      'userinfo'     => $this->getUser(),
      'tabMenu'         => $tabMenu
    ]);
  }
}
