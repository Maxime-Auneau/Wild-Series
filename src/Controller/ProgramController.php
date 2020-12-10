<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Season;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Entity\Program;


/**
 * @Route("/programs", name="program_")
 */

class ProgramController extends AbstractController
{
    /**
     * Show all rows from Program's entity
     *
     * @Route("/", name="index")
     * @return Response  A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs
        ]);
    }

    /**
     * Getting a program by id
     * @Route("/show/{id<^[0-9]+$>}", name="show")
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['id' => $id]);

        if(!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' .$id . 'found in program\'s table.'
            );
        }

        return $this->render('program/show.html.twig', [
            'program' => $program
        ]);
    }

    /**
     * @Route ("/{programId}/season/{seasonId}", methods={"GET"}, name="season_show")
     * @param int $programId
     * @param int $seasonId
     * @return Response
     */
    public function showSeason(int $programId, int $seasonId): Response
    {
        $seasonInfos = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findOneBy(['id' => $seasonId]);

        $programInfos = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['id' => $programId]);

        return $this->render('program/season_show.html.twig', [
            'programId' => $programId,
            'seasonId' => $seasonId,
            'season' => $seasonInfos,
            'program' => $programInfos
        ]);
    }
}