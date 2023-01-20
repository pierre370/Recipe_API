<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function login(Request $request, UserPasswordEncoderInterface $encoder, JWTEncoderInterface $JWTEncoder)
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $password = $data['password'];
        // Check if the user exists in the database
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $email]);
        if (!$user) {
            return new JsonResponse(['error' => 'Invalid credentials1'], Response::HTTP_UNAUTHORIZED);
        }

        // Check if the password is correct
        /*
        if (!$encoder->isPasswordValid($user, $password)) {
            return new JsonResponse(['error' => 'Invalid credentials2'], Response::HTTP_UNAUTHORIZED);
        }
        */

        // Generate a JWT token
        //$token = $JWTEncoder->encode([$user->getUsername()]);
        if($user){
            return new JsonResponse(['username' => $user->getUsername()]);
        }
    }
}
