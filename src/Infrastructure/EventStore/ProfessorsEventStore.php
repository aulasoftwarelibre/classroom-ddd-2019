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

use App\Domain\Professor\Exception\ProfessorIdDoesNotExistsException;
use App\Domain\Professor\Model\ProfessorId;
use App\Domain\Professor\Model\ProfessorInterface;
use App\Domain\Professor\Repository\Professors;
use Prooph\EventSourcing\Aggregate\AggregateRepository;

class ProfessorsEventStore extends AggregateRepository implements Professors
{
    /**
     * {@inheritdoc}
     */
    public function save(ProfessorInterface $professor): void
    {
        $this->saveAggregateRoot($professor);
    }

    /**
     * {@inheritdoc}
     */
    public function get(ProfessorId $professorId): ProfessorInterface
    {
        $professor = $this->getAggregateRoot($professorId->toString());

        if (!$professor instanceof ProfessorInterface) {
            throw ProfessorIdDoesNotExistsException::withProfessorId($professorId->toString());
        }

        return $professor;
    }

    /**
     * {@inheritdoc}
     */
    public function find(ProfessorId $professorId): ?ProfessorInterface
    {
        return $this->getAggregateRoot($professorId->toString());
    }

    /**
     * {@inheritdoc}
     */
    public function nextIdentity(): ProfessorId
    {
        return ProfessorId::generate();
    }
}
