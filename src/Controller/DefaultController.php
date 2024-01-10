<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    #[Route(
        "/",
        "home_page"
    )]
    public function index() {
        return $this->render("hello.html.twig");
    }

    #[Route(
        "/signin",
        name: "signin_page",
        methods: ['GET', 'POST']
    )]
    public function signin(
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $manager
    ) 
    {
        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $user = new User();
            $user
                ->setEmail($data['email'])
                ->setPassword($data['password']);
            $manager->persist($user);
            $manager->flush();
            dd($data, $user);
        }

        return $this->render("signin.html.twig", [
            'form' => $form->createView()
        ]);
    }

    #[Route(
        "/articles",
        name:"profile_user", 
        methods:["POST", "GET"], 
        requirements: ['id' => "\d+"]
    )]
    public function hello() 
    {
        return $this->render("example.html.twig", [
            'articles' => [
                [
                    "title" => "Titre 1",
                    "author"=> "Michel Boulon",
                    "picture" => "https://images.unsplash.com/photo-1682695794816-7b9da18ed470?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "description" => "Voilà un bel article sur le thème de ...",
                    

                ],
                [
                    "title" => "Ce que la plongée peut nous apprendre",
                    "author"=> "Martin Matin",
                    "picture" => "https://images.unsplash.com/photo-1682687982029-edb9aecf5f89?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "description" => "Voilà un bel article sur le thème de ..."
                ],
                [
                    "title" => "Titre 3",
                    "author"=> "Miranda Portique",
                    "picture" => "https://plus.unsplash.com/premium_photo-1683120924965-7a38795dd923?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "description" => "Voilà un bel article sur le thème de ..."
                ],
                [
                    "title" => "Titre 4",
                    "author"=> "Agnès Bouzin",
                    "picture" => "https://images.unsplash.com/photo-1704656924278-24b09a05f493?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "description" => "Voilà un bel article sur le thème de ..."
                ],
                [
                    "title" => "Titre 5",
                    "author"=> "Marc Limon",
                    "picture" => "https://plus.unsplash.com/premium_photo-1703703954965-557853f5f0fd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
                    "description" => "Voilà un bel article sur le thème de ..."
                ],
            ]
        ]);
    }

}