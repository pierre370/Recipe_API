<?php

namespace App\Controller;

use App\Entity\User;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class FormController extends AbstractController
{
    /**
     * @throws \Exception
     */
    public function submit(Request $request, EntityManagerInterface $em): string
    {
        $data = json_decode($request->getContent(), true);

        $username = $data['username'];
        $email = $data['email'];
        $name = $data['name'];
        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $password = $data['password'];
        $data = $request->request->all();

        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setRoles(['1']);
        $user->setName($name);
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setPassword($password);

        $em->persist($user);
        $em->flush();

        return new JsonResponse(['status' => 'success']);
    }
}
