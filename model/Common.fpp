namespace App\Domain\Common\Model {
    data Username = String deriving (FromString, ToString, Equals) where
        | empty($value) => "Username can not be empty.";
    data Password = String deriving (FromString, ToString, Equals) where
        | empty($value) => "Password can not be empty.";

    data FirstName = String deriving (FromString, ToString, Equals) where
        | empty($value) => "First name can not be empty.";
    data LastName = String deriving (FromString, ToString, Equals) where
        | empty($value) => "Last name can not be empty.";
    data Age = Int deriving(FromScalar, ToScalar, Equals);

    data Person = Person {
        FirstName $firstName,
        LastName $lastName,
        Age $age
    } deriving (FromArray, ToArray);
}
