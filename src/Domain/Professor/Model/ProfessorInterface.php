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

namespace App\Domain\Professor\Model;

use App\Domain\Common\Model\Password;
use App\Domain\Common\Model\Username;

interface ProfessorInterface
{
    /**
     * @return ProfessorId
     */
    public function professorId(): ProfessorId;

    /**
     * @return Username
     */
    public function username(): Username;

    /**
     * @return Password
     */
    public function password(): Password;

    /**
     * @return ProfessorRole
     */
    public function role(): ProfessorRole;
}
