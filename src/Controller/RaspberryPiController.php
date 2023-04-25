<?php

namespace App\Controller;

use App\Entity\RaspberryPi;
use App\Form\RaspberryPiType;
use App\Repository\RaspberryPiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/raspberry", name="app_raspberry_")
 */
class RaspberryPiController extends AbstractController
{
    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(RaspberryPiRepository $raspberryPiRepository): Response
    {
        return $this->render('raspberry_pi/index.html.twig', [
            'raspberry_pis' => $raspberryPiRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, RaspberryPiRepository $raspberryPiRepository): Response
    {
        $raspberryPi = new RaspberryPi();
        $form = $this->createForm(RaspberryPiType::class, $raspberryPi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $raspberryPiRepository->add($raspberryPi, true);

            return $this->redirectToRoute('app_raspberry_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('raspberry_pi/new.html.twig', [
            'raspberry_pi' => $raspberryPi,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, RaspberryPi $raspberryPi, RaspberryPiRepository $raspberryPiRepository): Response
    {
        $form = $this->createForm(RaspberryPiType::class, $raspberryPi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $raspberryPiRepository->add($raspberryPi, true);

            return $this->redirectToRoute('app_raspberry_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('raspberry_pi/edit.html.twig', [
            'raspberry_pi' => $raspberryPi,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"})
     */
    public function delete(Request $request, RaspberryPi $raspberryPi, RaspberryPiRepository $raspberryPiRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$raspberryPi->getId(), $request->request->get('_token'))) {
            $raspberryPiRepository->remove($raspberryPi, true);
        }

        return $this->redirectToRoute('app_raspberry_index', [], Response::HTTP_SEE_OTHER);
    }
}
