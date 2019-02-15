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

final class RemoveGroup extends \Prooph\EventSourcing\AggregateChanged
{
    public const MESSAGE_NAME = 'App\Application\Group\Command\RemoveGroup';

    protected $messageName = self::MESSAGE_NAME;

    protected $payload = [];

    private $groupId;

    public function groupId(): \App\Domain\Group\Model\GroupId
    {
        if (null === $this->groupId) {
            $this->groupId = \App\Domain\Group\Model\GroupId::fromString($this->aggregateId());
        }

        return $this->groupId;
    }

    public static function with(\App\Domain\Group\Model\GroupId $groupId): RemoveGroup
    {
        return new self($groupId->toString(), [
        ]);
    }

    protected function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }
}
