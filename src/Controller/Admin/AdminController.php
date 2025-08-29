<?php 

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Prospect;
use App\Form\ArticleForm;
use App\Repository\ArticleRepository;
use App\Repository\ProspectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
final class AdminController extends AbstractController
{
  #[Route('/admin', name: 'admin')]
  public function index(ArticleRepository $article, ProspectRepository $prospect, UserRepository $users,EntityManagerInterface $em): Response
  {
    $publications = $article->findAll();
    $prospects = $prospect->findAll();

    // dd($this->getUser());

    // $this->denyAccessUnlessGranted('ROLE_USER');
    return $this->render('admin/admin.html.twig',[
      'publications' => $publications,
      'prospects' => $prospects,
      'userinfo' => $this->getUser()
    ]);
  }
}
