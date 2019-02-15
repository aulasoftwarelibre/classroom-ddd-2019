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

namespace App\Tests\Behat\Repository;

use App\Domain\Professor\Exception\ProfessorIdDoesNotExistsException;
use App\Infrastructure\Entity\ProfessorView;
use App\Infrastructure\ReadModel\Repository\ProfessorViews;

class ProfessorViewsInMemoryRepository extends AbstractInMemoryRepository implements ProfessorViews
{
    public function add(ProfessorView $professorView): void
    {
        $this->_add($professorView->getId(), $professorView);
    }

    public function get(string $professorId): ProfessorView
    {
        $professor = $this->_ofId($professorId);

        if (!$professor instanceof ProfessorView) {
            throw ProfessorIdDoesNotExistsException::withProfessorId($professorId);
        }

        return $professor;
    }

    public function ofId(string $professorId): ?ProfessorView
    {
        return $this->_ofId($professorId);
    }

    public function ofUsername(string $username): ?ProfessorView
    {
        return $this->findOneBy('getUsername', $username);
    }
}
