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

final class GetAllGroupsHandler implements QueryHandlerInterface
{
    /**
     * @var GroupViews
     */
    private $groupViews;

    public function __construct(GroupViews $groupViews)
    {
        $this->groupViews = $groupViews;
    }

    /**
     * @param GetAllGroups $query
     *
     * @return array|GroupView[]
     */
    public function __invoke(GetAllGroups $query): array
    {
        return $this->groupViews->all();
    }
}
