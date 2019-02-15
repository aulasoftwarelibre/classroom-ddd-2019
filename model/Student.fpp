namespace App\Domain\Student\Model {
    data StudentId = StudentId deriving (Uuid);
    data StudentCardNumber = String deriving (FromString, ToString, Equals) where
        | empty($value) => "Student card number can not be empty.";
}

namespace App\Domain\Student\Event {
    data StudentWasAdded = StudentWasAdded {
        \App\Domain\Student\Model\StudentId $studentId,
        \App\Domain\Student\Model\StudentCardNumber $cardNumber,
        \App\Domain\Common\Model\Person $person,
    } deriving (AggregateChanged);

    data StudentWasRemoved = StudentWasRemoved {
        \App\Domain\Student\Model\StudentId $studentId
    } deriving (AggregateChanged);
}

namespace App\Domain\Student\Exception {
    data StudentIdAlreadyRegisteredException = StudentIdAlreadyRegisteredException deriving(Exception) with
        | withStudentId { string $studentId } => 'StudentId `{{ $studentId }}` already taken.';
    data StudentIdDoesNotExistsException = StudentIdDoesNotExistsException deriving(Exception) with
        | withStudentId { string $studentId } => 'StudentId `{{ $studentId }}` does not exists.';
    data StudentCardNumberAlreadyRegisteredException = StudentCardNumberAlreadyRegisteredException deriving(Exception) with
        | withStudentCardNumber { string $studentCardNumber } => 'StudentCardNumber `{{ $studentCardNumber }}` already taken.';
}

namespace App\Application\Student\Command {
    data AddStudent = AddStudent {
        \App\Domain\Student\Model\StudentId $studentId,
        \App\Domain\Student\Model\StudentCardNumber $cardNumber,
        \App\Domain\Common\Model\Person $person,
    } deriving (Command);

    data RemoveStudent = RemoveStudent {
        \App\Domain\Student\Model\StudentId $studentId,
    } deriving (Command);
}

namespace App\Application\Student\Query {
    data GetStudentById = GetStudentById {
        \App\Domain\Student\Model\StudentId $studentId,
    } deriving (Query);

    data GetAllStudents = GetAllStudents {
    } deriving (Query);
}
