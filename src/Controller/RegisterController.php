<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'register_control', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('register/index.html.twig');
    }

#[Route('/register', name: 'register_process', methods: ['POST'])]
public function process(Request $request): Response
{
    // Récupérer les données du formulaire
    $name = $request->request->get('name');
    $email = $request->request->get('email');
    $password = $request->request->get('password');
    
    // Créer un nouvel objet User
    $user = new User();
    $user->setName($name);
    $user->setEmail($email);
    $user->setPassword($password);
    
    // Sauvegarder en DB (pour l'instant, on affiche juste un message)
    // TODO: on va faire ça
    
    return $this->render('register/success.html.twig', [
        'name' => $name
    ]);
}
}