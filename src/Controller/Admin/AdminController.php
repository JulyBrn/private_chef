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
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
#[IsGranted('ROLE_USER')]
final class AdminController extends AbstractController
{
  #[Route('/admin', name: 'admin')]
  public function index(ArticleRepository $article, ProspectRepository $prospect, Request $request): Response
  {
    $publications = $article->findAll();

    $page = $request->query->getInt('page', 1);
    $prospects = $prospect->paginateProspect($page);

    dd($request->getLocale());
    // dd($maxPage);

    // $this->denyAccessUnlessGranted('ROLE_USER');
    return $this->render('admin/admin.html.twig',[
      'publications' => $publications,
      'prospects' => $prospects,
      'userinfo' => $this->getUser()
    ]);
  }
}
