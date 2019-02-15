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

namespace App\Domain\Professor\Model;

use App\Domain\Common\Model\Password;
use App\Domain\Common\Model\Username;
use App\Domain\Professor\Event\ProfessorWasAdded;
use AulaSoftwareLibre\DDD\BaseBundle\Domain\ApplyMethodDispatcherTrait;
use Prooph\EventSourcing\AggregateRoot;

final class Professor extends AggregateRoot implements ProfessorInterface
{
    use ApplyMethodDispatcherTrait;

    /**
     * @var ProfessorId
     */
    private $professorId;

    /**
     * @var Username
     */
    private $username;

    /**
     * @var Password
     */
    private $password;

    /**
     * @var ProfessorRole
     */
    private $role;

    public static function add(
        ProfessorId $professorId,
        Username $username,
        Password $password,
        ProfessorRole $role): self
    {
        $professor = new self();

        $professor->recordThat(ProfessorWasAdded::with(
            $professorId,
            $username,
            $password,
            $role
        ));

        return $professor;
    }

    /**
     * {@inheritdoc}
     */
    public function professorId(): ProfessorId
    {
        return $this->professorId;
    }

    /**
     * {@inheritdoc}
     */
    public function username(): Username
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function password(): Password
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function role(): ProfessorRole
    {
        return $this->role;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return $this->username->toString();
    }

    protected function aggregateId(): string
    {
        return $this->professorId->toString();
    }

    protected function applyProfessorWasAdded(ProfessorWasAdded $event): void
    {
        throw new \RuntimeException('Not implemented yet.');
    }
}
