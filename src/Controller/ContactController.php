<?php

namespace App\Controller;

use App\Entity\Prospect;
use App\Form\ContactForm;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
  #[Route('/contact', name: 'contact')]
  public function contact(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager) : Response
  {
    $contacts = new Prospect();
    $form = $this->createForm( ContactForm::class, $contacts);
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
        
        return $this->redirect($this->generateUrl('contact')); 
    }

    return $this->render('contact/contact.html.twig', [
      'controller_name' => 'ContactController',
      'form' => $form
    ]
  );
  }
}