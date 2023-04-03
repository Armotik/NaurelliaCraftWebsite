<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_default_index')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    #[Route('/play', name: 'app_default_play')]
    public function play(): Response
    {
        return $this->render('default/play.html.twig');
    }

    #[Route('/wiki_rules', name: 'app_default_wiki_rules')]
    public function wiki_rules(): Response
    {
        return $this->render('default/wiki_rules.html.twig');
    }

    #[Route('/contact', name: 'app_default_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) :
            $this->sendEmail($form->getData(),$mailer);
            // on revient sur la même page
            return $this->redirect($request->getUri());
        endif;
        return $this->render('default/contact.html.twig', ['form_contact' => $form]);

    }

    /**
     * @throws TransportExceptionInterface
     */
    private function sendEmail($data, MailerInterface $mailer){
        $email = new Email();
        $email->from($data["email"])
            ->to("support@naurellia.com")
            ->subject($data["name"]."  | website form")
            ->text($data["message"]);
        $mailer->send($email);

        $email2 = new Email();
        $email2->from($data["email"])
            ->to($data["email"])
            ->subject("NaurelliaCraft | Do not reply !")
            ->text("Successfully sent your message : \n".$data["message"]);
        $mailer->send($email2);
    }

}
