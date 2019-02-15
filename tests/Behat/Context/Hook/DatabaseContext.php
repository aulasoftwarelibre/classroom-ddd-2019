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

namespace App\Tests\Behat\Context\Hook;

use App\Tests\Behat\Repository\ProfessorViewsInMemoryRepository;
use Behat\Behat\Context\Context;

class DatabaseContext implements Context
{
    /**
     * @var ProfessorViewsInMemoryRepository
     */
    private $professors;

    public function __construct(
        ProfessorViewsInMemoryRepository $professors
    ) {
        $this->professors = $professors;
    }

    /**
     * @AfterScenario
     */
    public function reset()
    {
        $this->professors->reset();
    }
}
