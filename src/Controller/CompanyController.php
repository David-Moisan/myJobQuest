<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompanyController extends AbstractController
{
    /**
     * @var CompanyRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(CompanyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * Index va chercher la liste des entreprises
     */
    #[Route('/list-company', name: 'companies')]
    public function index(): Response
    {
        $companies = $this->repository->findAll();
        return $this->render('company/index.html.twig', [
            'companies' => $companies
        ]);
    }

    /**
     * @param Company $company
     * @param Request $request
     * @return Response
     */
    #[Route('/company/edit/{id}', name: 'company.edit')]
    public function edit(Company $company, Request $request): Response
    {
        $form = $this->createForm(CompanyType::class, $company);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('companies');
        }

        return $this->render('company/edit.html.twig', [
            'company' => $company,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    #[Route('/add-company', name: 'company.create')]
    public function create(Request $request): Response
    {
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($company);
            $this->em->flush();
            return $this->redirectToRoute('companies');
        }


        return $this->render('company/new.html.twig', [
            'company' => $company,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Company $company
     * @param Request $request 
     * @return RedirectResponse
     */
    #[Route('/company/delete/{id}', name: 'company.delete')]
    public function delete(Company $company, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $company->getId(), $request->get('_token'))) {
            $this->em->remove($company);
            $this->em->flush();
        }
        return $this->redirectToRoute('companies');
    }
}
