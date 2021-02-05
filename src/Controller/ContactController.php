<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactType;
use App\Entity\Contact;

class ContactController extends AbstractController
{

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, MailerInterface $mailer): Response
    {

        // Create a new Contact Object
        $contact = new Contact();
        // Create the associated Form
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = new Email();
            if ($contact->getSubject() !== null) {
                $subject = $contact->getSubject();
                $message = $contact->getMessage();
                $email
                    ->from('ab2714d368-ae00ad@inbox.mailtrap.io')
                    ->to('david67230@gmail.com')
                    ->subject($subject)
                    ->html($message);


                $mailer->send($email);
                $this->addFlash('success', 'Email envoyé !');
            }

            return $this->redirectToRoute("contact");
        }
        // Render the form
        return $this->render('contact/index.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
