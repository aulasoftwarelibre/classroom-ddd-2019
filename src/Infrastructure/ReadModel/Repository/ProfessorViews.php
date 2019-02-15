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

use App\Infrastructure\Entity\ProfessorView;

interface ProfessorViews
{
    public function add(ProfessorView $professorView): void;

    public function get(string $professorId): ProfessorView;

    public function ofId(string $professorId): ?ProfessorView;

    public function ofUsername(string $username): ?ProfessorView;

    /**
     * @return array|ProfessorView[]
     */
    public function all(): array;
}
