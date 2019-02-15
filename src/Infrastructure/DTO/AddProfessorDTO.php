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

namespace App\Infrastructure\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class AddProfessorDTO
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min="5", max="128")
     */
    private $username;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min="5", max="128")
     */
    private $password;

    /**
     * @var bool
     */
    private $isAssistant;

    public function __construct()
    {
        $this->isAssistant = true;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @param string $username
     *
     * @return AddProfessorDTO
     */
    public function setUsername(string $username): AddProfessorDTO
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    /**
     * @param string $password
     *
     * @return AddProfessorDTO
     */
    public function setPassword(string $password): AddProfessorDTO
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAssistant(): bool
    {
        return $this->isAssistant;
    }

    /**
     * @param bool $isAssistant
     *
     * @return AddProfessorDTO
     */
    public function setIsAssistant(bool $isAssistant): AddProfessorDTO
    {
        $this->isAssistant = $isAssistant;

        return $this;
    }
}
