<?php

namespace App\Controller;

use App\Entity\Yeti;
use App\Entity\YetiVotes;
use App\Entity\Sex;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class YetiController extends AbstractController
{

    /**
     * "Top ten" limit
     *
     * @todo move to config
     */
    const HOMEPAGE_LIMIT = 10;

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'Homepage')]
    public function indexAction(): Response
    {
        return $this->render('yeti/index.html.twig', [
            'limit' => self::HOMEPAGE_LIMIT,
            'yetties' => $this->entityManager
                ->getRepository(Yeti::class)
                ->retrieveByRating(self::HOMEPAGE_LIMIT),
        ]);
    }

    #[Route('/yeti/show/{id}', name: 'detail')]
    public function showAction(int $id): Response
    {
        $yeti = $this->entityManager
            ->getRepository(Yeti::class)
            ->find($id)
        ;

        if (!$yeti)
        {
            return $this->redirectToRoute('Homepage');
        }

        return $this->render('yeti/show.html.twig', [
            'yeti' => $yeti,
        ]);
    }

    #[Route('/yeti/stats/{id}', name: 'stats')]
    public function statsAction(int $id): Response
    {
        $yeti = $this->entityManager
            ->getRepository(Yeti::class)
            ->find($id)
        ;

        if (!$yeti)
        {
            return $this->redirectToRoute('Homepage');
        }

        $stats = $this->entityManager
            ->getRepository(YetiVotes::class)
            ->retrieveStatsByDay($id)
        ;

        return $this->render('yeti/stats.html.twig', [
            'yeti' => $yeti,
            'stats' => $stats,
        ]);
    }

    #[Route('/yeti/new', name: 'NewYeti')]
    public function newAction(Request $request): Response
    {
        $yeti = new Yeti();

        $form = $this->createFormBuilder($yeti)
            ->add('name', TextType::class, ['label' => 'Jméno'])
            ->add('weight', IntegerType::class, ['label' => 'Váha'])
            ->add('height', IntegerType::class, ['label' => 'Výška'])
            ->add('sex', EntityType::class, [
                'label' => 'Pohlaví',
                'class' => Sex::class,
                'choice_label' => 'name',
            ])
            ->add('save', SubmitType::class, ['label' => 'Vytvořit'])
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $yeti->setRating(0);

            $this->entityManager->persist($yeti);
            $this->entityManager->flush();

            $this->addFlash('success', 'Uloženo');

            return $this->redirectToRoute('NewYeti');
        }

        return $this->render('yeti/new.html.twig', [
            'form' => $form,
            'yetties' => $this->entityManager
                ->getRepository(Yeti::class)
                ->retrieveAllYetties()
        ]);
    }

}

