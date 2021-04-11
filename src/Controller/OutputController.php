<?php

namespace App\Controller;

use App\Entity\Output;
use App\Form\OutputType;
use App\Repository\OutputRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/output")
 */
class OutputController extends AbstractController
{
    /**
     * @Route("/json", name="output_json", methods={"GET"})
     */
    public function jsonify(OutputRepository $outputRepository): JsonResponse
    {
        return $this->json(
            $outputRepository->findAll()
        );
    }

    /**
     * @Route("/", name="output_index", methods={"GET"})
     */
    public function index(OutputRepository $outputRepository): Response
    {
        return $this->render('output/index.html.twig', [
            'outputs' => $outputRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="output_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $output = new Output();
        $form = $this->createForm(OutputType::class, $output);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($output);
            $entityManager->flush();

            return $this->redirectToRoute('output_index');
        }

        return $this->render('output/new.html.twig', [
            'output' => $output,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ajax/{id}", name="ajax_output", defaults={"id": 1})
     */
    public function ajaxOutputSwitch(Output $output, EntityManagerInterface $manager): JsonResponse
    {
        if($output->getState()){

            $output->setState(false);

            $manager->persist($output);
            $manager->flush();

            return $this->json(
                $output,
                200
            );

        } else {

            $output->setState(true);

            $manager->persist($output);
            $manager->flush();

            return $this->json(
                $output,
                200
            );
        }
    }

    /**
     * @Route("/{id}/edit", name="output_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Output $output): Response
    {
        $form = $this->createForm(OutputType::class, $output);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('output_index');
        }

        return $this->render('output/edit.html.twig', [
            'output' => $output,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="output_delete", methods={"GET"})
     */
    public function delete(Request $request, Output $output): Response
    {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($output);
            $entityManager->flush();

        return $this->redirectToRoute('output_index');
    }
}
