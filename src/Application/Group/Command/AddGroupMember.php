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

namespace App\Application\Group\Command;

final class AddGroupMember extends \Prooph\EventSourcing\AggregateChanged
{
    public const MESSAGE_NAME = 'App\Application\Group\Command\AddGroupMember';

    protected $messageName = self::MESSAGE_NAME;

    protected $payload = [];

    private $groupId;
    private $studentId;

    public function groupId(): \App\Domain\Group\Model\GroupId
    {
        if (null === $this->groupId) {
            $this->groupId = \App\Domain\Group\Model\GroupId::fromString($this->aggregateId());
        }

        return $this->groupId;
    }

    public function studentId(): \App\Domain\Student\Model\StudentId
    {
        if (null === $this->studentId) {
            $this->studentId = \App\Domain\Student\Model\StudentId::fromString($this->payload['studentId']);
        }

        return $this->studentId;
    }

    public static function with(\App\Domain\Group\Model\GroupId $groupId, \App\Domain\Student\Model\StudentId $studentId): AddGroupMember
    {
        return new self($groupId->toString(), [
            'studentId' => $studentId->toString(),
        ]);
    }

    protected function setPayload(array $payload): void
    {
        if (!isset($payload['studentId']) || !\is_string($payload['studentId'])) {
            throw new \InvalidArgumentException("Key 'studentId' is missing in payload or is not a string");
        }

        $this->payload = $payload;
    }
}
