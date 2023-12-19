<?php

namespace App\Controller;

use App\Entity\Yeti;
use App\Entity\Sex;
use App\Entity\YetiVotes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class VoteController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/vote', name: 'vote')]
    public function index(): Response
    {
        return $this->render('vote/index.html.twig', [
            'yeti' => $this->entityManager
                ->getRepository(Yeti::class)
                ->retrieveRandomRecord(),
        ]);
    }


    #[Route('/vote/inc/{id}', name: 'vote_increment')]
    public function incrementAction(int $id): Response
    {
        return $this->saveVoteAndRedirect($id, 1);
    }


    #[Route('/vote/dec/{id}', name: 'vote_decrement')]
    public function decrementAction(int $id): Response
    {
        return $this->saveVoteAndRedirect($id, -1);
    }


    private function saveVoteAndRedirect(int $id, int $vote)
    {
        $yeti = $this->entityManager
            ->getRepository(Yeti::class)
            ->find($id)
        ;

        if (!$yeti)
        {
            return $this->redirectToRoute('vote');
        }

        $yetiVote = new YetiVotes();
        $yetiVote
            ->setYeti($yeti)
            ->setVote($vote)
            ->setCreatedAt(new \DateTime())

        ;
        $this->entityManager->persist($yetiVote);
        $this->entityManager->flush();

        $calculatedRating = $this->entityManager
            ->getRepository(YetiVotes::class)
            ->getCalculatedRating($id)
        ;

        $yeti->setRating($calculatedRating);
        $this->entityManager->persist($yeti);
        $this->entityManager->flush();

        $this->addFlash('success', 'Hlas zaznamenán');
        return $this->redirectToRoute('vote');

    }

}

