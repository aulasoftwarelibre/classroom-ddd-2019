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
 * @ORM\Entity(repositoryClass="App\Infrastructure\Repository\GroupViewsRepository")
 */
class GroupView
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
    private $name;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $count;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $leader;

    public static function add(string $groupId, string $name): self
    {
        $group = new self();

        $group->id = $groupId;
        $group->name = $name;
        $group->count = 0;

        return $group;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    public function increment(): void
    {
        ++$this->count;
    }

    public function decrement(): void
    {
        --$this->count;
    }

    public function getLeader(): ?string
    {
        return $this->leader;
    }

    public function setLeader(?string $leader): self
    {
        $this->leader = $leader;

        return $this;
    }
}
