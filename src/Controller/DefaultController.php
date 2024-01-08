<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    #[Route(
        "/articles",
        name:"profile_user", 
        methods:["POST", "GET"], 
        requirements: ['id' => "\d+"]
    )]
    public function hello() {
        return $this->render("example.html.twig", [
            'articles' => [
                [
                    "title" => "Titre 1",
                    "author"=> "Auteur 1" 
                ],
                [
                    "title" => "Titre 2",
                    "author"=> "Auteur 2" 
                ],
                [
                    "title" => "Titre 3",
                    "author"=> "Auteur 3" 
                ],
            ]
        ]);
    }

}