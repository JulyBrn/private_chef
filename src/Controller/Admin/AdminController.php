<?php 

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AdminController extends AbstractController
{
  #[Route('/admin', name: 'admin')]
  public function index(): Response
  {
    // $this->denyAccessUnlessGranted('ROLE_USER');
    return $this->render('admin/admin.html.twig');
  }
}
