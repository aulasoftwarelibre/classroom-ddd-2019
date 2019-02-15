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

namespace App\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\Repository\StudentViewsRepository")
 */
class StudentView
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cardNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $groupName;

    public static function add(
        string $studentId,
        string $cardNumber,
        string $firstName,
        string $lastName,
        int $age
    ): self {
        $studentView = new self();

        $studentView->id = $studentId;
        $studentView->cardNumber = $cardNumber;
        $studentView->firstName = $firstName;
        $studentView->lastName = $lastName;
        $studentView->age = $age;

        return $studentView;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @return string|null
     */
    public function getGroupName(): ?string
    {
        return $this->groupName;
    }

    /**
     * @param string|null $groupName
     */
    public function setGroupName(?string $groupName): void
    {
        $this->groupName = $groupName;
    }

    public function __toString(): string
    {
        return sprintf(
            '%s %s [%s]',
            $this->firstName,
            $this->lastName,
            $this->cardNumber
        );
    }
}
