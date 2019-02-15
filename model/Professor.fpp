namespace App\Domain\Professor\Model {
    data ProfessorId = ProfessorId deriving (Uuid);
    data ProfessorRole = ProfessorCoordinator | ProfessorAssistant deriving (Enum);
}

namespace App\Domain\Professor\Event {
    data ProfessorWasAdded = ProfessorWasAdded {
        \App\Domain\Professor\Model\ProfessorId $professorId,
        \App\Domain\Common\Model\Username $username,
        \App\Domain\Common\Model\Password $password,
        \App\Domain\Professor\Model\ProfessorRole $role,
    } deriving (AggregateChanged);
}

namespace App\Domain\Professor\Exception {
    data ProfessorIdAlreadyRegisteredException = ProfessorIdAlreadyRegisteredException deriving(Exception) with
        | withProfessorId { string $professorId } => 'ProfessorId `{{ $professorId }}` already taken.';
    data ProfessorIdDoesNotExistsException = ProfessorIdDoesNotExistsException deriving(Exception) with
        | withProfessorId { string $professorId } => 'ProfessorId `{{ $professorId }}` does not exists.';
    data ProfessorUsernameAlreadyRegisteredException = ProfessorUsernameAlreadyRegisteredException deriving(Exception) with
        | withUsername { string $username } => 'Professor username `{{ $username }}` already taken.';
}

namespace App\Application\Professor\Command {
    data AddProfessor = AddProfessor {
        \App\Domain\Professor\Model\ProfessorId $professorId,
        \App\Domain\Common\Model\Username $username,
        \App\Domain\Common\Model\Password $password,
        \App\Domain\Professor\Model\ProfessorRole $role,
    } deriving (Command);
}

namespace App\Application\Professor\Query {
    data GetProfessorById = GetProfessorById {
        \App\Domain\Professor\Model\ProfessorId $professorId,
    } deriving (Query);

    data GetProfessorByUsername = GetProfessorByUsername {
        \App\Domain\Common\Model\Username $username,
    } deriving (Query);

    data GetAllProfessors = GetAllProfessors {
    } deriving (Query);
}
