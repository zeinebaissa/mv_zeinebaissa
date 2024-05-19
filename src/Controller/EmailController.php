<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailController extends AbstractController
{
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('mixd_Vinyl@gmail.com')
            ->to('zeinebaissa2003@gmail.com')
            ->subject('Testing MailHog with Symfony')
            ->text('This is a test email sent using MailHog!')
            ->html('<p>This is a test email sent using <strong>MailHog</strong>!</p>');

        $mailer->send($email);

        return new Response('Email sent and captured by MailHog');
    }
}

