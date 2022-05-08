<?php

namespace App\Controller;

use App\Repository\StackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StackController extends AbstractController
{
    /**
     * @var StackRepository
     */
    private $repository;

    public function __construct(StackRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/stack', name: 'stacks')]
    public function index(): Response
    {
        $stacks = $this->repository->findMyFavorite();

        $favorite = [];

        foreach ($stacks as $stack) {
            $favorite[] = [
                'id' => $stack->getId(),
                'name' => $stack->getName(),
                'type' => $stack->getType(),
            ];
        }

        $data = json_encode($favorite);

        return $this->render('/stacks/index.html.twig', [
            'stacks' => $stacks,
            'data' => $data
        ]);
    }
}
