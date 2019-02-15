<?php

declare(strict_types=1);

/*
 * This file is part of the `classroom-ddd` project.
 *
 * (c) Aula de Software Libre de la UCO <aulasoftwarelibre@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Infrastructure\Controller;

use App\Application\Professor\Command\AddProfessor;
use App\Application\Professor\Query\GetAllProfessors;
use App\Application\Professor\Query\GetProfessorById;
use App\Domain\Common\Model\Password;
use App\Domain\Common\Model\Username;
use App\Domain\Professor\Model\ProfessorId;
use App\Domain\Professor\Model\ProfessorRole;
use App\Domain\Professor\Repository\Professors;
use App\Infrastructure\DTO\AddProfessorDTO;
use App\Infrastructure\Form\ProfessorViewType;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\CommandBus;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/professors")
 */
class ProfessorViewController extends AbstractController
{
    /**
     * @var QueryBus
     */
    private $queryBus;
    /**
     * @var CommandBus
     */
    private $commandBus;
    /**
     * @var Professors
     */
    private $professors;

    public function __construct(QueryBus $queryBus, CommandBus $commandBus, Professors $professors)
    {
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
        $this->professors = $professors;
    }

    /**
     * @Route("/", name="professor_view_index", methods={"GET"})
     */
    public function index(): Response
    {
        $professors = $this->queryBus->query(
            new GetAllProfessors()
        );

        return $this->render('professor_view/index.html.twig', [
            'professor_views' => $professors,
        ]);
    }

    /**
     * @Route("/new", name="professor_view_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $addProfessorDTO = new AddProfessorDTO();
        $form = $this->createForm(ProfessorViewType::class, $addProfessorDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role = $addProfessorDTO->isAssistant() ? ProfessorRole::professorAssistant() : ProfessorRole::professorCoordinator();

            $professorId = $this->professors->nextIdentity();
            $this->commandBus->dispatch(
                AddProfessor::with(
                    $professorId,
                    Username::fromString($addProfessorDTO->getUsername()),
                    Password::fromString($addProfessorDTO->getPassword()),
                    $role
                )
            );

            sleep(1);

            return $this->redirectToRoute('professor_view_show', ['id' => $professorId]);
        }

        return $this->render('professor_view/new.html.twig', [
            'professor_view' => $addProfessorDTO,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="professor_view_show", methods={"GET"})
     */
    public function show(string $id): Response
    {
        $professorView = $this->queryBus->query(
            GetProfessorById::with(
                ProfessorId::fromString($id)
            )
        );

        if (!$professorView) {
            throw $this->createNotFoundException('User not found');
        }

        return $this->render('professor_view/show.html.twig', [
            'professor_view' => $professorView,
        ]);
    }
}
