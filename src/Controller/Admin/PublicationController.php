<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleForm;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PublicationController extends AbstractController
{
  #[Route('/admin/publication', name:"publication")]
  
  public function index(ArticleRepository $repository): Response
  {
    $publication = new Article();
    $form = $this->createForm(ArticleForm::class, $publication);
    $publications = $repository->findAll();

    return $this->render('admin/publication.html.twig',[
      'form' => $form,
      'publications' => $publications
    ]);
  }


}
