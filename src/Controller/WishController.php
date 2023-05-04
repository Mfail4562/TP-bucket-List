<?php

    namespace App\Controller;

    use App\Repository\WishRepository;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    #[Route('/wishes', name: "wish_")]
    class WishController extends AbstractController
    {
        #[Route('/list', name: 'list')]
        public function list(WishRepository $wishRepository): Response
        {
            $wishes = $wishRepository->findBy(['isPublished' => true], ['dateCreated' => 'DESC']);
            return $this->render('wish/list.html.twig', [
                'wishes' => $wishes
            ]);
        }

        #[Route('/details/{id}', name: 'details', requirements: ['id' => "\d+"])]
        public function details($id, WishRepository $wishRepository): Response
        {
            $wish = $wishRepository->find($id);

            if (!$wish) {
                throw $this->createNotFoundException("This wish do not exists! Sorry!");
            }

            return $this->render('wish/details.html.twig', [
                'wish' => $wish
            ]);
        }
    }
