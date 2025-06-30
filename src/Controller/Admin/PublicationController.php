<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleForm;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PublicationController extends AbstractController
{
  #[Route('/admin/publication', name:"publication")]
  public function index(ArticleRepository $repository): Response
  {

    $publications = $repository->findAll();
    
    return $this->render('admin/publication.html.twig',[
      'publications' => $publications
    ]);
  }

  #[Route('/admin/publication/edit-{id}', name:"publication.update")]
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
      ]);
  }
}
