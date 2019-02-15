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

namespace App\Domain\Professor\Repository;

use App\Domain\Professor\Exception\ProfessorIdDoesNotExistsException;
use App\Domain\Professor\Model\ProfessorId;
use App\Domain\Professor\Model\ProfessorInterface;

interface Professors
{
    /**
     * @param ProfessorInterface $professor
     */
    public function save(ProfessorInterface $professor): void;

    /**
     * @param ProfessorId $professorId
     *
     * @throws ProfessorIdDoesNotExistsException
     *
     * @return ProfessorInterface
     */
    public function get(ProfessorId $professorId): ProfessorInterface;

    /**
     * @param ProfessorId $professorId
     *
     * @return ProfessorInterface|null
     */
    public function find(ProfessorId $professorId): ?ProfessorInterface;

    /**
     * @return ProfessorId
     */
    public function nextIdentity(): ProfessorId;
}
