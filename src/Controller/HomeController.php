<?php

namespace App\Controller;

use App\Repository\HistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(HistoryRepository $historyRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'histories' => $historyRepository->getAllHistoryByUser($this->getUser()),
        ]);
    }
}
