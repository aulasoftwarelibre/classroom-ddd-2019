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

use App\Application\Group\Command\AddGroup;
use App\Application\Group\Command\AddGroupMember;
use App\Application\Group\Command\RemoveGroup;
use App\Application\Group\Query\GetAllGroups;
use App\Application\Group\Query\GetGroupById;
use App\Domain\Group\Model\GroupId;
use App\Domain\Group\Model\GroupName;
use App\Domain\Group\Repository\Groups;
use App\Domain\Student\Model\StudentId;
use App\Infrastructure\DTO\AddGroupDTO;
use App\Infrastructure\DTO\AddGroupMemberDTO;
use App\Infrastructure\Form\GroupViewMemberType;
use App\Infrastructure\Form\GroupViewType;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\CommandBus;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/groups")
 */
class GroupViewController extends AbstractController
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
     * @var Groups
     */
    private $groups;

    public function __construct(QueryBus $queryBus, CommandBus $commandBus, Groups $groups)
    {
        $this->queryBus = $queryBus;
        $this->commandBus = $commandBus;
        $this->groups = $groups;
    }

    /**
     * @Route("/", name="group_view_index", methods={"GET"})
     */
    public function index(): Response
    {
        $groupViews = $this->queryBus->query(
            new GetAllGroups()
        );

        return $this->render('group_view/index.html.twig', [
            'group_views' => $groupViews,
        ]);
    }

    /**
     * @Route("/new", name="group_view_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $addGroupDTO = new AddGroupDTO();
        $form = $this->createForm(GroupViewType::class, $addGroupDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $groupId = $this->groups->nextIdentity();
            $name = GroupName::fromString($addGroupDTO->name);

            $this->commandBus->dispatch(
                AddGroup::with(
                    $groupId,
                    $name
                )
            );

            return $this->redirectToRoute('group_view_show', ['id' => $groupId]);
        }

        return $this->render('group_view/new.html.twig', [
            'group_view' => $addGroupDTO,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="group_view_show", methods={"GET"})
     */
    public function show(string $id): Response
    {
        $groupView = $this->queryBus->query(
            GetGroupById::with(
                GroupId::fromString($id)
            )
        );

        return $this->render('group_view/show.html.twig', [
            'group_view' => $groupView,
        ]);
    }

    /**
     * @Route("/{id}", name="group_view_delete", methods={"DELETE"})
     */
    public function delete(Request $request, string $id): Response
    {
        if ($this->isCsrfTokenValid('delete'.$id, $request->request->get('_token'))) {
            $this->commandBus->dispatch(
                RemoveGroup::with(
                    GroupId::fromString($id)
                )
            );

            sleep(1);
        }

        return $this->redirectToRoute('group_view_index');
    }

    /**
     * @Route("/{id}/member", name="group_view_member_add", methods={"GET", "POST"})
     */
    public function addMember(Request $request, string $id): Response
    {
        $addGroupMemberDTO = new AddGroupMemberDTO();
        $form = $this->createForm(GroupViewMemberType::class, $addGroupMemberDTO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->commandBus->dispatch(
                AddGroupMember::with(
                    GroupId::fromString($id),
                    StudentId::fromString($addGroupMemberDTO->member->getId())
                )
            );

            sleep(1);

            return $this->redirectToRoute('group_view_show', ['id' => $id]);
        }

        return $this->render('group_view/member_new.html.twig', [
            'group_view_id' => $id,
            'group_view_member' => $addGroupMemberDTO,
            'form' => $form->createView(),
        ]);
    }
}
