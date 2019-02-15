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

namespace App\Infrastructure\ReadModel\Repository;

use App\Infrastructure\Entity\GroupView;

interface GroupViews
{
    public function add(GroupView $groupView): void;

    public function get(string $groupId): GroupView;

    public function ofId(string $groupId): ?GroupView;

    /**
     * @return array|GroupView[]
     */
    public function all(): array;

    public function remove(string $groupId): void;

    public function save(): void;
}
