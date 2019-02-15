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

namespace App\Infrastructure\EventStore;

use App\Domain\Student\Exception\StudentIdDoesNotExistsException;
use App\Domain\Student\Model\StudentId;
use App\Domain\Student\Model\StudentInterface;
use App\Domain\Student\Repository\Students;
use Prooph\EventSourcing\Aggregate\AggregateRepository;

class StudentsEventStore extends AggregateRepository implements Students
{
    /**
     * {@inheritdoc}
     */
    public function save(StudentInterface $student): void
    {
        $this->saveAggregateRoot($student);
    }

    /**
     * {@inheritdoc}
     */
    public function get(StudentId $studentId): StudentInterface
    {
        $student = $this->getAggregateRoot($studentId->toString());

        if (!$student instanceof StudentInterface) {
            throw StudentIdDoesNotExistsException::withStudentId($studentId->toString());
        }

        return $student;
    }

    /**
     * {@inheritdoc}
     */
    public function find(StudentId $studentId): ?StudentInterface
    {
        return $this->getAggregateRoot($studentId->toString());
    }

    /**
     * {@inheritdoc}
     */
    public function nextIdentity(): StudentId
    {
        return StudentId::generate();
    }
}
