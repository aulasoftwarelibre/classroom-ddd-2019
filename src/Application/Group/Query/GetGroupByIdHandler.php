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

namespace App\Application\Group\Query;

use App\Infrastructure\Entity\GroupView;
use App\Infrastructure\ReadModel\Repository\GroupViews;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\QueryHandlerInterface;

final class GetGroupByIdHandler implements QueryHandlerInterface
{
    /**
     * @var GroupViews
     */
    private $groupViews;

    public function __construct(GroupViews $groupViews)
    {
        $this->groupViews = $groupViews;
    }

    public function __invoke(GetGroupById $query): ?GroupView
    {
        $id = $query->groupId()->toString();

        return $this->groupViews->get($id);
    }
}
