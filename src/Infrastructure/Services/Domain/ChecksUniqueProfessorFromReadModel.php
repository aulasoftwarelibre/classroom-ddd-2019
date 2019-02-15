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

namespace App\Infrastructure\Services\Domain;

use App\Domain\Common\Model\Username;
use App\Domain\Professor\Model\ProfessorId;
use App\Domain\Professor\Service\ChecksUniqueProfessor;
use App\Infrastructure\Entity\ProfessorView;
use App\Infrastructure\ReadModel\Repository\ProfessorViews;

class ChecksUniqueProfessorFromReadModel implements ChecksUniqueProfessor
{
    /**
     * @var ProfessorViews
     */
    private $professorViews;

    public function __construct(ProfessorViews $professorViews)
    {
        $this->professorViews = $professorViews;
    }

    public function ofUsername(Username $username): ?ProfessorId
    {
        throw new \RuntimeException('Not implemented yet.');
    }
}
