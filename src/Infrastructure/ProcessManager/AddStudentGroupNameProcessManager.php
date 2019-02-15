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

namespace App\Infrastructure\ProcessManager;

use App\Domain\Group\Event\GroupMemberWasAdded;
use App\Infrastructure\ReadModel\Repository\GroupViews;
use App\Infrastructure\ReadModel\Repository\StudentViews;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\EventHandlerInterface;

class AddStudentGroupNameProcessManager implements EventHandlerInterface
{
    /**
     * @var GroupViews
     */
    private $groupViews;
    /**
     * @var StudentViews
     */
    private $studentViews;

    public function __construct(GroupViews $groupViews, StudentViews $studentViews)
    {
        $this->groupViews = $groupViews;
        $this->studentViews = $studentViews;
    }

    public function __invoke(GroupMemberWasAdded $event)
    {
        $studentView = $this->studentViews->get($event->studentId()->toString());
        $groupView = $this->groupViews->get($event->groupId()->toString());

        $studentView->setGroupName($groupView->getName());

        $this->studentViews->save();
    }
}
