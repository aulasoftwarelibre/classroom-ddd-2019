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

namespace App\Infrastructure\Command;

use App\Application\Professor\Command\AddProfessor;
use App\Domain\Common\Model\Password;
use App\Domain\Common\Model\Username;
use App\Domain\Professor\Model\ProfessorRole;
use App\Domain\Professor\Repository\Professors;
use AulaSoftwareLibre\DDD\BaseBundle\MessageBus\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

class ProfessorAddCommand extends Command
{
    protected static $defaultName = 'app:professor:add';
    /**
     * @var CommandBus
     */
    private $commandBus;
    /**
     * @var Professors
     */
    private $professors;

    public function __construct(CommandBus $commandBus, Professors $professors)
    {
        parent::__construct();

        $this->commandBus = $commandBus;
        $this->professors = $professors;
    }

    protected function configure()
    {
        $this
            ->setDescription('Create a new professor')
            ->addArgument('username', InputArgument::REQUIRED, 'Professor username')
            ->addArgument('password', InputArgument::OPTIONAL, 'Professor password')
            ->addOption('assistant', 'a', InputOption::VALUE_NONE, 'Configure as an assistant professor.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        $assistant = $input->getOption('assistant');

        while (empty($password)) {
            $password = $this->askForPassword($io);

            if (empty($password)) {
                $io->error('Password can not be empty.');
            }
        }

        $professorRole = $assistant ? ProfessorRole::professorAssistant() : ProfessorRole::professorCoordinator();

        $this->commandBus->dispatch(
            AddProfessor::with(
                $this->professors->nextIdentity(),
                Username::fromString($username),
                Password::fromString($password),
                $professorRole
            )
        );

        $io->success('Professor was added.');
    }

    private function askForPassword(SymfonyStyle $io)
    {
        $question = new Question('Password:');
        $question->setHidden(true);
        $question->setHiddenFallback(false);

        return $io->askQuestion($question);
    }
}
