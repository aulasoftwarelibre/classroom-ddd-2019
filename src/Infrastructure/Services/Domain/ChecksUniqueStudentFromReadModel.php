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

use App\Domain\Student\Model\StudentCardNumber;
use App\Domain\Student\Model\StudentId;
use App\Domain\Student\Service\ChecksUniqueStudent;
use App\Infrastructure\Entity\StudentView;
use App\Infrastructure\ReadModel\Repository\StudentViews;

class ChecksUniqueStudentFromReadModel implements ChecksUniqueStudent
{
    /**
     * @var StudentViews
     */
    private $studentViews;

    public function __construct(StudentViews $studentViews)
    {
        $this->studentViews = $studentViews;
    }

    public function ofCardNumber(StudentCardNumber $cardNumber): ?StudentId
    {
        throw new \RuntimeException('Not implemented yet.');
    }
}
