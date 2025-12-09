<?php 

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Form\MenuForm;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class MenuController extends AbstractController
{
  #[Route('/admin/menu_gestion', name: "menu.gestion")]
  public function index(MenuRepository $repository): Response
  {
    $tabMenu = $repository->findAll();
    return $this->render('admin/menu_gestion.html.twig', [
      'tabMenu'  => $tabMenu,
      'userinfo' => $this->getUser()
    ]);
  }

  #[Route('admin/menu/add', name:'menu.add')]
  public function add(EntityManagerInterface $em, Request $request)
  {
    $menu = new Menu();
    

    $form = $this->createForm(MenuForm::class, $menu);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      $menu = $form->getData();
      $newPlats = $form->get('newPlats')->getData();

      foreach ($newPlats as $onePlat)
      {
        $em->persist($onePlat);
        $menu->addPlat($onePlat);
      }

      $em->persist($menu);
      $em->flush($menu);
      $this->addFlash('success', 'Le menu a bien été ajoutée.');
    }

    return $this->render('admin/menu-add.html.twig', [
      'form' => $form,
      'userinfo' => $this->getUser()
    ]);
  }


  #[Route('admin/menu/update-{id}', name:'menu.update')]
  public function update(Menu $menu, EntityManagerInterface $em, Request $request)
  {
    $form = $this->createForm(MenuForm::class,$menu);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      $newPlats = $form->get('newPlats')->getData();
      foreach ($newPlats as $onePlat)
      {
        $em->persist($onePlat);
        $menu->addPlat($onePlat);
      }
      $em->flush();
      $this->addFlash('success', 'Le menu a bien été modifié.');
      return $this->redirectToRoute('admin');
    }

    return $this->render('admin/menu-update.html.twig', [
      'form' => $form,
      'menu' => $menu
    ]);
  }

  #[Route('admin/menu/delete-{id}', name:'menu.delete')]
  public function delete(Menu $menu, EntityManagerInterface $em, Request $request)
  {
    $tokenName = 'delete'.$menu->getId();
    if($this->isCsrfTokenValid($tokenName, $request->request->get('_token')))
    {
      $em->remove($menu);
      $em->flush();
      $this->addFlash('success', 'Le menu a bien été supprimé');
    }
    else
    {
      $this->addFlash('error', 'Une erreur est survenue');
    }
    return $this->redirectToRoute('admin');
  }
  
}
