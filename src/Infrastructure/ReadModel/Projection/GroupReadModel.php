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

namespace App\Infrastructure\ReadModel\Projection;

use App\Domain\Group\Event\GroupLeaderWasAssigned;
use App\Domain\Group\Event\GroupLeaderWasDismissed;
use App\Domain\Group\Event\GroupMemberWasAdded;
use App\Domain\Group\Event\GroupMemberWasRemoved;
use App\Domain\Group\Event\GroupWasAdded;
use App\Domain\Group\Event\GroupWasRemoved;
use App\Infrastructure\Entity\GroupView;
use App\Infrastructure\ReadModel\Repository\GroupViews;
use AulaSoftwareLibre\DDD\BaseBundle\Domain\ApplyMethodDispatcherTrait;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\EventHandlerInterface;
use AulaSoftwareLibre\DDD\BaseBundle\Prooph\EventStore\Projection\AbstractDoctrineReadModel;
use Doctrine\Common\Persistence\ManagerRegistry;

class GroupReadModel extends AbstractDoctrineReadModel implements EventHandlerInterface
{
    use ApplyMethodDispatcherTrait {
        applyMessage as public __invoke;
    }

    /**
     * @var GroupViews
     */
    private $groupViews;

    public function __construct(
        ManagerRegistry $registry,
        GroupViews $groupViews
    ) {
        parent::__construct($registry, GroupView::class);

        $this->groupViews = $groupViews;
    }

    protected function applyGroupWasAdded(GroupWasAdded $event): void
    {
        throw new \RuntimeException('Not implemented yet.');
    }

    protected function applyGroupWasRemoved(GroupWasRemoved $event): void
    {
        throw new \RuntimeException('Not implemented yet.');
    }

    protected function applyGroupMemberWasAdded(GroupMemberWasAdded $event)
    {
        throw new \RuntimeException('Not implemented yet.');
    }

    protected function applyGroupMemberWasRemoved(GroupMemberWasRemoved $event)
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
