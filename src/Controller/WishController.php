<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    #[Route('/wishes', name: "wish_")]
    class WishController extends AbstractController
    {
        #[Route('/list', name: 'list')]
        public function list(): Response
        {
            return $this->render('wish/list.html.twig');
        }

        #[Route('/details/{id}', name: 'details', requirements: ['id' => "\d+"])]
        public function details($id): Response
        {
            return $this->render('wish/details.html.twig');
        }
    }
