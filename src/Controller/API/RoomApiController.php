<?php

namespace App\Controller\API;

use App\Entity\RaspberryPi;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api")
 */
class RoomApiController extends AbstractController
{
    /**
     * @Route("/raspberrypi/{raspberryPi}/outputs", name="api_raspberrypi_outputs", methods={"GET"})
     */
    public function jsonify(RaspberryPi $raspberryPi): JsonResponse
    {
        return $this->json(
            $raspberryPi->getOutputs(),
            200,
            [],
            ['groups' => 'api_output']
        );
    }
}