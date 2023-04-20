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
    /**
     * Display home page
     * @Route("/", name="app_default_index")
     * @return Response A response instance with a render template : default/index.html.twig
     */
    #[Route('/', name: 'app_default_index')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * Display play page
     * @Route("/play", name="app_default_play")
     * @return Response A response instance with a render template : default/play.html.twig
     */
    #[Route('/play', name: 'app_default_play')]
    public function play(): Response
    {
        return $this->render('default/play.html.twig');
    }

    /**
     * Display wiki page
     * @Route("/wiki", name="app_default_wiki")
     * @return Response A response instance with a render template : default/wiki.html.twig
     */
    #[Route('/wiki_rules', name: 'app_default_wiki_rules')]
    public function wiki_rules(): Response
    {
        return $this->render('default/wiki_rules.html.twig');
    }

    /**
     * Display contact page
     * @Route("/contact", name="app_default_contact")
     * @return Response A response instance with a render template : default/contact.html.twig
     * @throws TransportExceptionInterface if the email cannot be sent
     */
    #[Route('/contact', name: 'app_default_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        // Create form
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        // If form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) :

            try {

                $this->sendEmail($form->getData(),$mailer);
                return $this->redirect($request->getUri());
            } catch (TransportExceptionInterface $e) {
                $this->addFlash('error', 'An error occurred while sending your message. Please try again later.');
            }

        endif;

        // Render template
        return $this->render('default/contact.html.twig', ['form_contact' => $form]);

    }

    /**
     * Send email to support and to the user
     * @param $data
     * @param MailerInterface $mailer
     * @throws TransportExceptionInterface if the email cannot be sent
     */
    private function sendEmail($data, MailerInterface $mailer){
        $email = new Email();
        $email->from("contact@naurellia.com")
            ->to("contact@naurellia.com")
            ->subject($data["username"]."  | website form")
            ->text($data["message"]);
        $mailer->send($email);

        $email2 = new Email();
        $email2->from("contact@naurellia.com")
            ->to($data["email"])
            ->subject("NaurelliaCraft | Do not reply !")
            ->text("Successfully sent your message : \n".$data["message"]);
        $mailer->send($email2);
    }
}
