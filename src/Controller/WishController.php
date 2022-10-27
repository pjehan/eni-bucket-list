<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use App\Util\Censurator;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/wish')]
class WishController extends AbstractController
{
    #[Route('/', name: 'wish_list')]
    public function list(WishRepository $wishRepository): Response
    {
        // Récupérer la liste des souhaits
        $wishes = $wishRepository->findAllWithCategories();

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

    #[Route('/create', name: 'wish_create', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function create(Request $request, EntityManagerInterface $em, Censurator $censurator): Response
    {
        $wish = new Wish();
        $wish->setAuthor($this->getUser()->getPseudo());
        $formWish = $this->createForm(WishType::class, $wish);

        $formWish->handleRequest($request);

        if ($formWish->isSubmitted() && $formWish->isValid()) {
            $wish->setDescription($censurator->purify($wish->getDescription()));

            $em->persist($wish);
            $em->flush();

            $this->addFlash('success', 'Le souhait a bien été créé');

            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }

        return $this->render('wish/create.html.twig', [
            'formWish' => $formWish->createView()
        ]);
    }

    #[Route('/update/{id}', name: 'wish_update', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function update(Request $request, EntityManagerInterface $em, Wish $wish): Response
    {
        $formWish = $this->createForm(WishType::class, $wish);

        $formWish->handleRequest($request);

        if ($formWish->isSubmitted() && $formWish->isValid()) {
            //$em->persist($wish);
            $em->flush();

            $this->addFlash('success', 'Le souhait a bien été modifié');

            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }

        return $this->render('wish/update.html.twig', [
            'wish' => $wish,
            'formWish' => $formWish->createView()
        ]);
    }

    #[Route('/delete/{id}', name: 'wish_delete', methods: ['POST'])]
    public function delete(Request $request, EntityManagerInterface $em, Wish $wish): Response
    {
        if ($this->isCsrfTokenValid('delete' . $wish->getId(), $request->request->get('_token'))) {
            $em->remove($wish);
            $em->flush();
        } else {
            $this->addFlash('error', 'Le token CSRF est invalide !');
        }

        return $this->redirectToRoute('wish_list');
    }
}
