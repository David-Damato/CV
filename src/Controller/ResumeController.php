<?php

namespace App\Controller;

use App\Entity\Resume;
use App\Form\ResumeType;
use App\Repository\ResumeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/resume")
 */
class ResumeController extends AbstractController
{
    /**
     * @Route("/", name="resume_index", methods={"GET"})
     */
    public function index(ResumeRepository $resumeRepository): Response
    {
        $formation = $resumeRepository->findBy(
            ['type' => 'formation']
        );
        $experience = $resumeRepository->findBy(
            ['type' => 'experience']
        );

        return $this->render('resume/index.html.twig', [
            'formation' => $formation,
            'experience' => $experience,
        ]);
    }

    /**
     * @Route("/new", name="resume_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $resume = new Resume();
        $form = $this->createForm(ResumeType::class, $resume);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resume);
            $entityManager->flush();

            return $this->redirectToRoute('resume_index');
        }
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        return $this->render('resume/new.html.twig', [
            'resume' => $resume,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resume_show", methods={"GET"})
     */
    public function show(Resume $resume): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        return $this->render('resume/show.html.twig', [
            'resume' => $resume,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="resume_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Resume $resume): Response
    {
        $form = $this->createForm(ResumeType::class, $resume);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('resume_index');
        }
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        return $this->render('resume/edit.html.twig', [
            'resume' => $resume,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="resume_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Resume $resume): Response
    {
        if ($this->isCsrfTokenValid('delete' . $resume->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($resume);
            $entityManager->flush();
        }
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        return $this->redirectToRoute('resume_index');
    }
}
