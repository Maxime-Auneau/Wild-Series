<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Actor;

/**
 * Class ActorController
 * @package App\Controller
 * @Route("/actor", name="actor_")
 */
class ActorController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param $actorRepository
     * @return Response
     */
    public function index(ActorRepository $actorRepository): Response
    {
        return $this->render('actor/index.html.twig', [
            'actors' => $actorRepository->findAll(),
        ]);
    }

    /**
     * @param Actor $actor
     * @return Response
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(Actor $actor): Response
    {
        return $this->render('actor/show.html.twig', ['actor' => $actor]);
    }
}
