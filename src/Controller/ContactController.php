<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Form\ContactFormType;

class ContactController extends AbstractController
{
    public function showForm(): Response
    {
        $form = $this->createForm(ContactFormType::class);

        return $this->render('contact/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function submitForm(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            // Check if the subject is not null
            $subject = $formData['subject'] ?? '';
            if ($subject !== '') {
                // Send email with form data
                $email = (new Email())
                    ->from($formData['email'])
                    ->to('mixed_vinyl@gmail.com') // Replace with your email address
                    ->subject($subject)
                    ->text($formData['message']);

                $mailer->send($email);

                // Redirect to a confirmation page after successful form submission
                return $this->redirectToRoute('confirmation');
            }
        }

        // If the form is not valid or not submitted, render the form again
        return $this->render('contact/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}