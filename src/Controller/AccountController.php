<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(UserRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @param User $user
     * @return Response
     */
    #[Route('/account/{id}', name: 'account-user')]
    public function index(User $user): Response
    {
        $account = $this->repository->find($user->getId());
        return $this->render('profile/index.html.twig', [
            'account' => $account
        ]);
    }

    #[Route('/edit-profile/{id}', name: 'edit-profile')]
    public function edit(User $user, Request $request): Response
    {
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirect('/account/' . $user->getId());
        }
        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}
