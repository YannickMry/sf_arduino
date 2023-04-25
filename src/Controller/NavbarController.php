<?php

namespace App\Controller;

use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavbarController extends AbstractController
{

    public function showRooms(RoomRepository $roomRepository): Response
    {
        return $this->render('navbar/rooms.html.twig', [
            'rooms' => $roomRepository->findAll()
        ]);
    }
}
