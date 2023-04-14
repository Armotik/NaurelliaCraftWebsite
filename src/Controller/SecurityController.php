<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\NewPasswordFormType;
use App\Repository\UserRepository;
use DateTime;
use IntlDateFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
             return $this->redirectToRoute('app_account', ['account' => $this->getUser()->getUserIdentifier()]);
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/{account}', name: 'app_account')]
    public function account(User $user, Request $request, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher): Response
    {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_default_index');
        }

        $form = $this->createForm(NewPasswordFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('plainPassword')->getData() !== $form->get('confirmPassword')->getData()) {
                $this->addFlash('error', 'Passwords do not match');
                return $this->redirectToRoute('app_account', ['account' => $this->getUser()->getUserIdentifier()]);
            }

            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $userRepository->createQueryBuilder('u')
                ->update()
                ->set('u.password', ':password')
                ->where('u.id = :id')
                ->setParameter('password', $user->getPassword())
                ->setParameter('id', $user->getId())
                ->getQuery()
                ->execute();

            return $this->redirectToRoute('app_logout');
        }

        $timestamp = $user->getCreatedAt()->getTimestamp();
        //Todo change the date format in the database to just put the timestamp

        $dateTime = DateTime::createFromFormat('U', $timestamp);
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
        $formattedDate = $formatter->format($dateTime);
        $formattedDate .= ' - ' . $dateTime->format('H:i');

        return $this->render('default/account.html.twig', ["date" => $formattedDate, 'form' => $form->createView()]);
    }
}
