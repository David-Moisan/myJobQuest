<?php

namespace App\Controller;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    /**
     * @var CompanyRepository
     */
    private $repository;

    public function __construct(CompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/list-company', name: 'companies')]
    public function index(): Response
    {
        $companies = $this->repository->findAll();
        return $this->render('company/index.html.twig', [
            'companies' => $companies
        ]);
    }

    #[Route('/company/{id}', name: 'company.edit')]
    public function edit(Company $company): Response
    {
        return $this->render('company/edit.html.twig', [
            'company' => $company
        ]);
    }
}
