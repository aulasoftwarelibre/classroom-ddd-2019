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

namespace App\Domain\Student\Model;

use App\Domain\Common\Model\Person;

interface StudentInterface
{
    /**
     * @return StudentId
     */
    public function studentId(): StudentId;

    /**
     * @return StudentCardNumber
     */
    public function cardNumber(): StudentCardNumber;

    /**
     * @return Person
     */
    public function person(): Person;

    /**
     * Remove student.
     */
    public function remove(): void;
}
