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

    // $this->denyAccessUnlessGranted('ROLE_USER');
    return $this->render('admin/admin.html.twig',[
      'publications' => $publications,
      'prospects' => $prospects,
      'userinfo' => $this->getUser()
    ]);
  }

   #[Route('/admin/edit-{id}', name:"update")]
  public function update(Article $article, Request $request, EntityManagerInterface $em)
  {
    $form = $this->createForm(ArticleForm::class, $article);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      $em->flush();
      $this->addFlash('success','La publication a bien été modifiée.');
      return $this->redirectToRoute('publication');
    }

    return $this->render('admin/publication-update.html.twig',[
      'article' => $article,
      'form' => $form,
      'userinfo' => $this->getUser()
      ]);
  }
}
