<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
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
public function process(Request $request, EntityManagerInterface $entityManager): Response
{
    $name = $request->request->get('name');
    $email = $request->request->get('email');
    $password = $request->request->get('password');
    
    // Créer un nouvel objet User
    $user = new User();
    $user->setName($name);
    $user->setEmail($email);
    $user->setPassword($password);
    
    // Dire à Doctrine: "prépare cette entité pour la sauvegarde"
    $entityManager->persist($user);
    
    // Exécuter la sauvegarde en DB
    $entityManager->flush();
    
    return $this->render('register/success.html.twig', [
        'name' => $name
    ]);
}

    #[Route('/users', name: 'users_list', methods: ['GET'])]
    public function listUsers(EntityManagerInterface $entityManager): Response
{
    $users = $entityManager->getRepository(User::class)->findAll();
    
    return $this->render('users/list.html.twig', [
        'users' => $users
    ]);
}
}