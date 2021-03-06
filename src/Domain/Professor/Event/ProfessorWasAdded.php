<?php

// this file is auto-generated by prolic/fpp
// don't edit this file manually

declare(strict_types=1);

/*
 * This file is part of the `classroom-ddd` project.
 *
 * (c) Aula de Software Libre de la UCO <aulasoftwarelibre@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Professor\Event;

final class ProfessorWasAdded extends \Prooph\EventSourcing\AggregateChanged
{
    public const MESSAGE_NAME = 'App\Domain\Professor\Event\ProfessorWasAdded';

    protected $messageName = self::MESSAGE_NAME;

    protected $payload = [];

    private $professorId;
    private $username;
    private $password;
    private $role;

    public function professorId(): \App\Domain\Professor\Model\ProfessorId
    {
        if (null === $this->professorId) {
            $this->professorId = \App\Domain\Professor\Model\ProfessorId::fromString($this->aggregateId());
        }

        return $this->professorId;
    }

    public function username(): \App\Domain\Common\Model\Username
    {
        if (null === $this->username) {
            $this->username = \App\Domain\Common\Model\Username::fromString($this->payload['username']);
        }

        return $this->username;
    }

    public function password(): \App\Domain\Common\Model\Password
    {
        if (null === $this->password) {
            $this->password = \App\Domain\Common\Model\Password::fromString($this->payload['password']);
        }

        return $this->password;
    }

    public function role(): \App\Domain\Professor\Model\ProfessorRole
    {
        if (null === $this->role) {
            $this->role = \App\Domain\Professor\Model\ProfessorRole::fromName($this->payload['role']);
        }

        return $this->role;
    }

    public static function with(\App\Domain\Professor\Model\ProfessorId $professorId, \App\Domain\Common\Model\Username $username, \App\Domain\Common\Model\Password $password, \App\Domain\Professor\Model\ProfessorRole $role): ProfessorWasAdded
    {
        return new self($professorId->toString(), [
            'username' => $username->toString(),
            'password' => $password->toString(),
            'role' => $role->name(),
        ]);
    }

    protected function setPayload(array $payload): void
    {
        if (!isset($payload['username']) || !\is_string($payload['username'])) {
            throw new \InvalidArgumentException("Key 'username' is missing in payload or is not a string");
        }

        if (!isset($payload['password']) || !\is_string($payload['password'])) {
            throw new \InvalidArgumentException("Key 'password' is missing in payload or is not a string");
        }

        if (!isset($payload['role']) || !\is_string($payload['role'])) {
            throw new \InvalidArgumentException("Key 'role' is missing in payload or is not a string");
        }

        $this->payload = $payload;
    }
}
