<?php

namespace App\Controller;

use App\Entity\Presentation;
use App\Entity\User;
use App\Form\Presentation1Type;
use App\Form\UserType;
use App\Repository\PresentationRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/manager")
 */
class ManagerController extends AbstractController
{
    /**
     * @Route("/manager", name="app_manager")
     */
    public function index(PresentationRepository $presentationRepository, UserRepository $userRepository): Response
    {
        return $this->render('manager/index.html.twig', [
            'controller_name' => 'ManagerController',
            'presentation' => $presentationRepository->findAll(),
            'user' => $userRepository->findAll(),
        ]);
    }

    // ajout user
    /**
     * @Route("/newUser", name="app_user_new", methods={"GET", "POST"})
     */
    public function newUser(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    // editer user
    /**
     * @Route("/{id}/editUser", name="app_user_edit", methods={"GET", "POST"})
     */
    public function editUser(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    // supprimer user
    /**
     * @Route("/{id}/user", name="app_user_delete", methods={"POST"})
     */
    public function deleteUser(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    // liste user
    /**
     * @Route("/user", name="app_user_index", methods={"GET"})
     */
    public function listUser(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    // afficher user

    /**
     * @Route("/{id}/user", name="app_user_show", methods={"GET"})
     */
    public function showUser(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/editPresentation", name="app_presentation_edit", methods={"GET", "POST"})
     */
    public function editPresentation(Request $request, Presentation $presentation, PresentationRepository $presentationRepository): Response
    {
        $form = $this->createForm(Presentation1Type::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $presentationRepository->add($presentation, true);

            return $this->redirectToRoute('app_presentation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presentation/edit.html.twig', [
            'presentation' => $presentation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/presentations", name="app_presentation_index", methods={"GET"})
     */
    public function indexPresentation(PresentationRepository $presentationRepository): Response
    {
        return $this->render('presentation/index.html.twig', [
            'presentations' => $presentationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/newPresentation", name="app_presentation_new", methods={"GET", "POST"})
     */
    public function newPresentation(Request $request, PresentationRepository $presentationRepository): Response
    {
        $presentation = new Presentation();
        $form = $this->createForm(Presentation1Type::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $presentationRepository->add($presentation, true);

            return $this->redirectToRoute('app_presentation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presentation/new.html.twig', [
            'presentation' => $presentation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/showPresentation", name="app_presentation_show", methods={"GET"})
     */
    public function showPresentation(Presentation $presentation): Response
    {
        return $this->render('presentation/show.html.twig', [
            'presentation' => $presentation,
        ]);
    }

    /**
     * @Route("/{id}/deletePresentation", name="app_presentation_delete", methods={"POST"})
     */
    public function deletePresentation(Request $request, Presentation $presentation, PresentationRepository $presentationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presentation->getId(), $request->request->get('_token'))) {
            $presentationRepository->remove($presentation, true);
        }

        return $this->redirectToRoute('app_presentation_index', [], Response::HTTP_SEE_OTHER);
    }
}
