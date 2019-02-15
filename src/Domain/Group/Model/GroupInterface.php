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

namespace App\Domain\Group\Model;

use App\Domain\Student\Model\StudentId;

interface GroupInterface
{
    /**
     * @return GroupId
     */
    public function groupId(): GroupId;

    /**
     * @return GroupName
     */
    public function name(): GroupName;

    /**
     * @return StudentId|null
     */
    public function leader(): ?StudentId;

    public function remove(): void;

    public function assignLeader(StudentId $studentId): void;

    public function dismissLeader(): void;

    public function addMember(StudentId $studentId): void;

    public function removeMember(StudentId $studentId): void;
}
