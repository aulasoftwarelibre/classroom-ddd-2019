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

use App\Infrastructure\Entity\StudentView;

interface StudentViews
{
    public function add(StudentView $studentView): void;

    public function get(string $studentId): StudentView;

    public function ofId(string $studentId): ?StudentView;

    public function ofCardNumber(string $cardNumber): ?StudentView;

    public function remove(string $studentId): void;

    /**
     * @return array|StudentView[]
     */
    public function all(): array;

    public function save(): void;
}
