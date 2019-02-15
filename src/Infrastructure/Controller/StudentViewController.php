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

use App\Application\Student\Command\AddStudent;
use App\Application\Student\Command\RemoveStudent;
use App\Application\Student\Query\GetAllStudents;
use App\Application\Student\Query\GetStudentById;
use App\Domain\Common\Model\Age;
use App\Domain\Common\Model\FirstName;
use App\Domain\Common\Model\LastName;
use App\Domain\Common\Model\Person;
use App\Domain\Student\Model\StudentCardNumber;
use App\Domain\Student\Model\StudentId;
use App\Domain\Student\Repository\Students;
use App\Infrastructure\DTO\AddStudentDTO;
use App\Infrastructure\Form\StudentViewType;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\CommandBus;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/students")
 */
class StudentViewController extends AbstractController
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
     * @var Students
     */
    private $students;

    public function __construct(QueryBus $queryBus, CommandBus $commandBus, Students $students)
    {
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
        $this->students = $students;
    }

    /**
     * @Route("/", name="student_view_index", methods={"GET"})
     */
    public function index(): Response
    {
        $students = $this->queryBus->query(
            new GetAllStudents()
        );

        return $this->render('student_view/index.html.twig', [
            'student_views' => $students,
        ]);
    }

    /**
     * @Route("/new", name="student_view_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $addStudentDTO = new AddStudentDTO();
        $form = $this->createForm(StudentViewType::class, $addStudentDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $studentId = $this->students->nextIdentity();
            $cardNumber = StudentCardNumber::fromString($addStudentDTO->cardNumber);
            $person = new Person(
                FirstName::fromString($addStudentDTO->firstName),
                LastName::fromString($addStudentDTO->lastName),
                Age::fromScalar($addStudentDTO->age)
            );

            $this->commandBus->dispatch(
                AddStudent::with(
                    $studentId,
                    $cardNumber,
                    $person
                )
            );

            sleep(1);

            return $this->redirectToRoute('student_view_show', ['id' => $studentId]);
        }

        return $this->render('student_view/new.html.twig', [
            'student_view' => $addStudentDTO,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="student_view_show", methods={"GET"})
     */
    public function show(string $id): Response
    {
        $studentView = $this->queryBus->query(
            GetStudentById::with(
                StudentId::fromString($id)
            )
        );

        return $this->render('student_view/show.html.twig', [
            'student_view' => $studentView,
        ]);
    }

    /**
     * @Route("/{id}", name="student_view_delete", methods={"DELETE"})
     */
    public function delete(Request $request, string $id): Response
    {
        if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $this->commandBus->dispatch(
                RemoveStudent::with(
                    StudentId::fromString($id)
                )
            );

            sleep(1);
        }

        return $this->redirectToRoute('student_view_index');
    }
}
