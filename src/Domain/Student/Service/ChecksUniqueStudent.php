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

namespace App\Domain\Student\Service;

use App\Domain\Student\Model\StudentCardNumber;
use App\Domain\Student\Model\StudentId;

interface ChecksUniqueStudent
{
    public function ofCardNumber(StudentCardNumber $cardNumber): ?StudentId;
}
