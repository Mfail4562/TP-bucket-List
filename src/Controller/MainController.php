<?php

    namespace App\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;

    class MainController extends AbstractController
    {

        /**
         * @Route("/", name="main_home")
         */
        public function home(): Response
        {
            return $this->render('main/home.html.twig');
        }

        /**
         * @Route("/about_us", name="main_about_us")
         */
        public function about_us(): Response
        {
            $file = file_get_contents('../data/team.json');
            $teamMembers = json_decode($file, true);
            dump($teamMembers);
            return $this->render('main/about_us.html.twig', [
                'teamMembers' => $teamMembers
            ]);
        }
    }