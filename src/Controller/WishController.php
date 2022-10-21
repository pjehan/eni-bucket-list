<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wish')]
class WishController extends AbstractController
{
    #[Route('/', name: 'wish_list')]
    public function list(WishRepository $wishRepository): Response
    {
        // Récupérer la liste des souhaits
        $wishes = $wishRepository->findAll();

        return $this->render('wish/index.html.twig', [
            'wishes' => $wishes
        ]);
    }

    #[Route('/{id}', name: 'wish_detail', requirements: ['id' => '\d+'])]
    public function detail(WishRepository $wishRepository, int $id): Response
    {
        $wish = $wishRepository->find($id);

        return $this->render('wish/detail.html.twig', [
            'wish' => $wish
        ]);
    }
}
