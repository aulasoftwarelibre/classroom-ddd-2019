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

namespace App\Infrastructure\EventStore;

use App\Domain\Group\Exception\GroupIdDoesNotExistsException;
use App\Domain\Group\Model\GroupId;
use App\Domain\Group\Model\GroupInterface;
use App\Domain\Group\Repository\Groups;
use Prooph\EventSourcing\Aggregate\AggregateRepository;

class GroupsEventStore extends AggregateRepository implements Groups
{
    /**
     * {@inheritdoc}
     */
    public function save(GroupInterface $group): void
    {
        $this->saveAggregateRoot($group);
    }

    /**
     * {@inheritdoc}
     */
    public function get(GroupId $groupId): GroupInterface
    {
        $group = $this->getAggregateRoot($groupId->toString());

        if (!$group instanceof GroupInterface) {
            throw GroupIdDoesNotExistsException::withGroupId($groupId->toString());
        }

        return $group;
    }

    /**
     * {@inheritdoc}
     */
    public function find(GroupId $groupId): ?GroupInterface
    {
        return $this->getAggregateRoot($groupId->toString());
    }

    /**
     * {@inheritdoc}
     */
    public function nextIdentity(): GroupId
    {
        return GroupId::generate();
    }
}
