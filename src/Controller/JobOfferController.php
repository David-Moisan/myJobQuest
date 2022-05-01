<?php

namespace App\Controller;

use App\Entity\JobOffer;
use App\Form\JobOfferType;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobOfferController extends AbstractController
{
    /**
     * @var JobOfferRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(JobOfferRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @return Response
     */
    #[Route('/job-offers', name: 'job-offers')]
    public function index(): Response
    {
        $jobOffers = $this->repository->findAll();
        return $this->render('jobs/index.html.twig', [
            'jobOffers' => $jobOffers
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    #[Route('/add-new-job-offers', name: 'job-offer.create')]
    public function new(Request $request): Response
    {
        $jobOffer = new JobOffer();
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($jobOffer);
            $this->em->flush();
            return $this->redirectToRoute('job-offers');
        }

        return $this->render('jobs/new.html.twig', [
            'jobOffer' => $jobOffer,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param JobOffer $jobOffer entity
     * @param Request $request 
     * @return Response
     */
    #[Route('/edit-job-offers/{id}', name: 'job-offer.edit')]
    public function edit(JobOffer $jobOffer, Request $request): Response
    {
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            return $this->redirectToRoute('job-offers');
        }

        return $this->render('jobs/edit.html.twig', [
            'jobOffer' => $jobOffer,
            'form' => $form->createView()
        ]);
    }

    /**
     * @param JobOffer $jobOffer entity
     * @param Request $request 
     * @return RedirectResponse
     */
    #[Route('/delete-job-offer/{id}', name: 'job-offer.delete')]
    public function delete(JobOffer $jobOffer, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $jobOffer->getId(), $request->get('_token'))) {
            $this->em->remove($jobOffer);
            $this->em->flush();
        }
        return $this->redirectToRoute('job-offers');
    }
}
