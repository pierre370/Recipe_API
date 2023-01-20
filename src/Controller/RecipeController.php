<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @throws \Exception
     */
    public function submitRecipe(Request $request, EntityManagerInterface $em): string
    {
        $data = json_decode($request->getContent(), true);

        $tokenid = $data['tokenid'];
        $userid = $data['userid'];

        $recipe = new Recipe();
        $recipe->setTokenId($tokenid);
        $recipe->setUserId($userid);

        $em->persist($recipe);
        $em->flush();

        return new JsonResponse(['status' => 'success']);
    }
}
