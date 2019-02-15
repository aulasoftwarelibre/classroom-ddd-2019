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

namespace App\Domain\Group\Model;

use App\Domain\Group\Event\GroupLeaderWasAssigned;
use App\Domain\Group\Event\GroupLeaderWasDismissed;
use App\Domain\Group\Event\GroupMemberWasAdded;
use App\Domain\Group\Event\GroupMemberWasRemoved;
use App\Domain\Group\Event\GroupWasAdded;
use App\Domain\Group\Event\GroupWasRemoved;
use App\Domain\Student\Model\StudentId;
use AulaSoftwareLibre\DDD\BaseBundle\Domain\ApplyMethodDispatcherTrait;
use Prooph\EventSourcing\AggregateRoot;

final class Group extends AggregateRoot implements GroupInterface
{
    use ApplyMethodDispatcherTrait;

    /**
     * @var GroupId
     */
    private $groupId;

    /**
     * @var GroupName
     */
    private $name;

    /**
     * @var array|StudentId[]
     */
    private $members;

    /**
     * @var StudentId|null
     */
    private $leader;

    /**
     * @return GroupId
     */
    public function groupId(): GroupId
    {
        return $this->groupId;
    }

    /**
     * @return GroupName
     */
    public function name(): GroupName
    {
        return $this->name;
    }

    /**
     * @return StudentId|null
     */
    public function leader(): ?StudentId
    {
        return $this->leader;
    }

    public static function add(
        GroupId $groupId,
        GroupName $groupName
    ): self {
        $group = new self();

        $group->recordThat(GroupWasAdded::with(
            $groupId,
            $groupName
        ));

        return $group;
    }

    public function remove(): void
    {
        $this->recordThat(
            GroupWasRemoved::with(
                $this->groupId
            )
        );
    }

    public function assignLeader(StudentId $studentId): void
    {
        // TODO: logic

        $this->recordThat(
            GroupLeaderWasAssigned::with(
                $this->groupId,
                $studentId
            )
        );
    }

    public function dismissLeader(): void
    {
        // TODO: logic

        $this->recordThat(
            GroupLeaderWasDismissed::with(
                $this->groupId
            )
        );
    }

    public function addMember(StudentId $studentId): void
    {
        // TODO: logic

        $this->recordThat(
            GroupMemberWasAdded::with(
                $this->groupId,
                $studentId
            )
        );
    }

    public function removeMember(StudentId $studentId): void
    {
        // TODO: logic

        $this->recordThat(
            GroupMemberWasRemoved::with(
                $this->groupId,
                $studentId
            )
        );
    }

    public function __toString(): string
    {
        return $this->name->toString();
    }

    protected function aggregateId(): string
    {
        return $this->groupId->toString();
    }

    protected function applyGroupWasAdded(GroupWasAdded $event): void
    {
        $this->groupId = $event->groupId();
        $this->name = $event->groupName();
        $this->members = [];
    }

    protected function applyGroupWasRemoved(GroupWasRemoved $event): void
    {
        throw new \RuntimeException('Not implemented yet.');
    }

    protected function applyGroupMemberWasAdded(GroupMemberWasAdded $event): void
    {
        throw new \RuntimeException('Not implemented yet.');
    }

    protected function applyGroupMemberWasRemoved(GroupMemberWasRemoved $event): void
    {
        throw new \RuntimeException('Not implemented yet.');
    }

    protected function applyGroupLeaderWasAssigned(GroupLeaderWasAssigned $event): void
    {
        throw new \RuntimeException('Not implemented yet.');
    }

    protected function applyGroupLeaderWasDismissed(GroupLeaderWasDismissed $event): void
    {
        throw new \RuntimeException('Not implemented yet.');
    }
}
