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

namespace App\Domain\Professor\Exception;

final class ProfessorUsernameAlreadyRegisteredException extends \Exception
{
    public function __construct(string $message = '', int $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function withUsername(string $username, int $code = 0, \Exception $previous = null): self
    {
        return new self(sprintf('Professor username `%s` already taken.', $username), $code, $previous);
    }
}
