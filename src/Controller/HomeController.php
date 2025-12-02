<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Prospect;
use App\Entity\User;
use App\Form\ContactForm;
use App\Repository\ArticleRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

use function Symfony\Component\Clock\now;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(Request $request,  MailerInterface $mailer, EntityManagerInterface $entityManager, ArticleRepository $article): Response
    {
        $contacts = new Prospect();
        $form = $this->createForm( ContactForm::class , $contacts);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            // Envoi de l'email
            $emailtosend = (new TemplatedEmail())
                ->from($contacts->getEmail())
                ->to('julybrn60@gmail.com')
                ->subject('Demande de contact')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([ 'data' => $contacts ]);
            $mailer->send($emailtosend);

            $contacts->setDate(new DateTime('now'));
            // Enregistrement dans la base de données
            $entityManager->persist($contacts);
            $entityManager->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé !');
            
            return $this->redirect($this->generateUrl('home').'#contact-form'); 
        }

        $tabArticle = $article->findAll();

      
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form,
            'tabArticle' => $tabArticle

        ]);
    }
}
