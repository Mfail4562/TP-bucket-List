<?php

    namespace App\Controller;

    use App\Entity\Wish;
    use App\Form\WishType;
    use App\Repository\WishRepository;
    use DateTime;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    #[Route('/wishes', name: "wish_")]
    class WishController extends AbstractController
    {
        #[Route('/list', name: 'list')]
        public function list(WishRepository $wishRepository): Response
        {
            $wishes = $wishRepository->getAllWishes();
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

        #[Route('/create_wish', name: 'create')]
        public function create_wish(
            Request                $request,
            EntityManagerInterface $entityManager
        ): Response
        {

            $wish = new Wish();
            $wish
                ->setIsPublished(false)
                ->setDateCreated(new DateTime());
            $wishForm = $this->createForm(WishType::class, $wish);

            $wishForm->handleRequest($request);

            if ($wishForm->isSubmitted() && $wishForm->isValid()) {

                $wish->setIsPublished(true);

                $entityManager->persist($wish);
                $entityManager->flush();

                $this->addFlash('success', 'Idea successfully added!');

                return $this->redirectToRoute('wish_details', ['id' => $wish->getId()]);
            }


            return $this->render('wish/create_wish.html.twig', [
                'wishForm' => $wishForm->createView(),
            ]);
        }
    }
