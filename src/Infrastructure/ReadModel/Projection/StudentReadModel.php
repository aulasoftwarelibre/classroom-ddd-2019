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

namespace App\Infrastructure\ReadModel\Projection;

use App\Domain\Student\Event\StudentWasAdded;
use App\Domain\Student\Event\StudentWasRemoved;
use App\Infrastructure\Entity\StudentView;
use App\Infrastructure\ReadModel\Repository\StudentViews;
use AulaSoftwareLibre\DDD\BaseBundle\Domain\ApplyMethodDispatcherTrait;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\EventHandlerInterface;
use AulaSoftwareLibre\DDD\BaseBundle\Prooph\EventStore\Projection\AbstractDoctrineReadModel;
use Doctrine\Common\Persistence\ManagerRegistry;

class StudentReadModel extends AbstractDoctrineReadModel implements EventHandlerInterface
{
    use ApplyMethodDispatcherTrait {
        applyMessage as public __invoke;
    }

    /**
     * @var StudentViews
     */
    private $studentViews;

    public function __construct(
        ManagerRegistry $registry,
        StudentViews $studentViews
    ) {
        parent::__construct($registry, StudentView::class);

        $this->studentViews = $studentViews;
    }

    public function applyStudentWasAdded(StudentWasAdded $event): void
    {
        throw new \RuntimeException('Not implemented yet.');
    }

    public function applyStudentWasRemoved(StudentWasRemoved $event): void
    {
        throw new \RuntimeException('Not implemented yet.');
    }
}
