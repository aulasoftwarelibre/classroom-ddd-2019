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

namespace App\Domain\Group\Repository;

use App\Domain\Group\Exception\GroupIdDoesNotExistsException;
use App\Domain\Group\Model\GroupId;
use App\Domain\Group\Model\GroupInterface;

interface Groups
{
    /**
     * @param GroupInterface $group
     */
    public function save(GroupInterface $group): void;

    /**
     * @param GroupId $groupId
     *
     * @throws GroupIdDoesNotExistsException
     *
     * @return GroupInterface
     */
    public function get(GroupId $groupId): GroupInterface;

    /**
     * @param GroupId $groupId
     *
     * @return GroupInterface|null
     */
    public function find(GroupId $groupId): ?GroupInterface;

    /**
     * @return GroupId
     */
    public function nextIdentity(): GroupId;
}
