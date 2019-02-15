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

namespace App\Tests\Behat\Context\Domain;

use App\Application\Professor\Command\AddProfessor;
use App\Domain\Common\Model\Password;
use App\Domain\Common\Model\Username;
use App\Domain\Professor\Event\ProfessorWasAdded;
use App\Domain\Professor\Model\ProfessorRole;
use App\Domain\Professor\Repository\Professors;
use AulaSoftwareLibre\DDD\TestsBundle\Service\Prooph\Plugin\EventsRecorder;
use Behat\Behat\Context\Context;
use Symfony\Component\Messenger\MessageBusInterface;
use Webmozart\Assert\Assert;

class ProfessorContext implements Context
{
    /**
     * @var MessageBusInterface
     */
    private $commandBus;
    /**
     * @var EventsRecorder
     */
    private $eventsRecorder;
    /**
     * @var Professors
     */
    private $professors;

    public function __construct(
        MessageBusInterface $commandBus,
        EventsRecorder $eventsRecorder,
        Professors $professors
    ) {
        $this->commandBus = $commandBus;
        $this->eventsRecorder = $eventsRecorder;
        $this->professors = $professors;
    }

    /**
     * @When /^I register a (coordinator|assistant) professor with username "([^"]*)" and password "([^"]*)"$/
     */
    public function iRegisterACoordinatorProfessorWithUsernameAndPassword(string $type, string $username, string $password): void
    {
        $role = 'coordinator' === $type ? ProfessorRole::professorCoordinator() : ProfessorRole::ProfessorAssistant();

        $this->commandBus->dispatch(
            AddProfessor::with(
                $this->professors->nextIdentity(),
                Username::fromString($username),
                Password::fromString($password),
                $role
            )
        );
    }

    /**
     * @Then /^the (coordinator|assistant) professor "([^"]*)" should be available$/
     */
    public function theCoordinatorProfessorShouldBeAvailable(string $type, string $username): void
    {
        /** @var ProfessorWasAdded $event */
        $event = $this->eventsRecorder->getLastMessage()->event();
        $role = 'coordinator' === $type ? ProfessorRole::professorCoordinator() : ProfessorRole::ProfessorAssistant();

        Assert::isInstanceOf($event, ProfessorWasAdded::class, sprintf(
            'Event has to be of class %s, but %s given',
            ProfessorWasAdded::class,
            \get_class($event)
        ));

        Assert::true($event->username()->equals(Username::fromString($username)));
        Assert::true($event->role()->equals($role));
    }
}
