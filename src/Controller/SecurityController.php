<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\FileFormType;
use App\Form\NewPasswordFormType;
use App\Repository\InfractionsRepository;
use App\Repository\UserIGRepository;
use App\Repository\UserRepository;
use DateTime;
use IntlDateFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * Displays the login page
     * @param AuthenticationUtils $authenticationUtils The authentication utils
     * @param User $user The user
     * @return Response Returns the login page
     */
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, User $user): Response
    {
        // redirect to the account page if the user is already logged in
        if ($this->getUser()) {
            return $this->redirectToRoute('app_account', ['account' => $user->getId()]);
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * Logs out the user
     * @return void
     */
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * Displays the account page
     * @param Request $request The request
     * @param UserRepository $userRepository The user repository
     * @param UserPasswordHasherInterface $userPasswordHasher The user password hasher
     * @param UserIGRepository $userIGRepository The user IG repository
     * @param InfractionsRepository $infractionsRepository The infractions repository
     * @return Response Returns the account page
     */
    #[Route(path: '/{account}', name: 'app_account', methods: ['GET','POST'])]
    public function account(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $userPasswordHasher, UserIGRepository $userIGRepository, InfractionsRepository $infractionsRepository): Response
    {

        // Redirect to the home page if the user is not logged in
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_default_index');
        }

        /*
         * Get the date of the user's creation
         * and format it to a string in French
         */
        $timestamp = $this->getUser()->getCreatedAt()->getTimestamp();

        $dateTime = DateTime::createFromFormat('U', $timestamp);
        $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
        $formattedDate = $formatter->format($dateTime);

        // Check if the user has a skin
        $file_exists = file_exists("uploads/skins/skin-" . $this->getUser()->getUserIdentifier() . ".png");

        $form = $this->createForm(NewPasswordFormType::class, $this->getUser());
        $form->handleRequest($request);

        // Change the user's password if the form is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {

            // Check if the passwords match
            if ($form->get('plainPassword')->getData() !== $form->get('confirmPassword')->getData()) {
                $this->addFlash('error', 'Passwords do not match');
                return $this->redirectToRoute('app_account', ['account' => $this->getUser()->getUserIdentifier()]);
            }

            // hash the password
            $this->getUser()->setPassword(
                $userPasswordHasher->hashPassword(
                    $this->getUser(),
                    $form->get('plainPassword')->getData()
                )
            );

            // Update the user's password in the database
            $userRepository->createQueryBuilder('u')
                ->update()
                ->set('u.password', ':password')
                ->where('u.id = :id')
                ->setParameter('password', $this->getUser()->getPassword())
                ->setParameter('id', $this->getUser()->getId())
                ->getQuery()
                ->execute();

            // Redirect to the login page
            return $this->redirectToRoute('app_logout');
        }

        // Create the form to upload a skin
        $fileform = $this->createForm(FileFormType::class);
        $fileform->handleRequest($request);

        // Upload the skin if the form is submitted and valid
        if ($fileform->isSubmitted() && $fileform->isValid()) {
            $file = $fileform->get('file')->getData();

            // Check if the file is a PNG
            if ($file) {

                // Generate a unique name for the file
                $newFilename = 'skin-' . $this->getUser()->getUserIdentifier() . '.' . $file->guessExtension();

                // Move the file to the directory where skins are stored
                try {
                    $file->move(
                        $this->getParameter('skin_directory'),
                        $newFilename
                    );

                    // Update the user's skin URL in the database
                    $this->getUser()->setSkinURL($newFilename);
                    $userRepository->createQueryBuilder('u')
                        ->update()
                        ->set('u.skinURL', ':skinURL')
                        ->where('u.id = :id')
                        ->setParameter('skinURL', $this->getUser()->getSkinURL())
                        ->setParameter('id', $this->getUser()->getId())
                        ->getQuery()
                        ->execute();

                    // Problem here

                    return $this->redirectToRoute('app_account', ['account' => $this->getUser()->getUserIdentifier(), "date" => $formattedDate, 'form' => $form->createView(), 'fileform' => $fileform->createView(), 'file_exists' => $file_exists, 'user' => $this->getUser()], Response::HTTP_OK );


                } catch (FileException $e) {

                    return $this->redirectToRoute('app_account', ['account' => $this->getUser()->getUserIdentifier(), "date" => $formattedDate, 'form' => $form->createView(), 'fileform' => $fileform->createView(), 'file_exists' => $file_exists, 'user' => $this->getUser()], Response::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
        }

        // Get the user's infractions if the user is linked to an IG account
        if ($this->getUser()->isIsLinked()) {

            // Get the user's IG account
            $userIG = $userIGRepository->findOneBy(['username' => $this->getUser()->getUsername()]);

            // Get the user's infractions
            $infractions = $infractionsRepository->findBy(['targetUUID' => $userIG->getId()]);

            return $this->render('default/account.html.twig', ["date" => $formattedDate, 'form' => $form->createView(), 'fileform' => $fileform->createView(), 'file_exists' => $file_exists, 'user' => $this->getUser(), 'infractions' => $infractions, 'userIG' => $userIG]);
        }

        return $this->render('default/account.html.twig', ["date" => $formattedDate, 'form' => $form->createView(), 'fileform' => $fileform->createView(), 'file_exists' => $file_exists, 'user' => $this->getUser()]);
    }
}
