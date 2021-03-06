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

namespace App\Application\Professor\Query;

final class GetProfessorById extends \Prooph\Common\Messaging\Query
{
    use \Prooph\Common\Messaging\PayloadTrait;

    public const MESSAGE_NAME = 'App\Application\Professor\Query\GetProfessorById';

    protected $messageName = self::MESSAGE_NAME;

    public function professorId(): \App\Domain\Professor\Model\ProfessorId
    {
        return \App\Domain\Professor\Model\ProfessorId::fromString($this->payload['professorId']);
    }

    public static function with(\App\Domain\Professor\Model\ProfessorId $professorId): GetProfessorById
    {
        return new self([
            'professorId' => $professorId->toString(),
        ]);
    }

    protected function setPayload(array $payload): void
    {
        if (!isset($payload['professorId']) || !\is_string($payload['professorId'])) {
            throw new \InvalidArgumentException("Key 'professorId' is missing in payload or is not a string");
        }

        $this->payload = $payload;
    }
}
