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

namespace App\Infrastructure\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final class AddStudentDTO
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(min="6", max="10")
     */
    public $cardNumber;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    public $firstName;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    public $lastName;

    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Type(type="int")
     * @Assert\GreaterThan(0)
     */
    public $age;
}
