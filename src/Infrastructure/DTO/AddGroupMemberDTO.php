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

use App\Infrastructure\Entity\StudentView;
use Symfony\Component\Validator\Constraints as Assert;

class AddGroupMemberDTO
{
    /**
     * @var StudentView
     * @Assert\NotBlank()
     * @Assert\Valid()
     */
    public $member;
}
