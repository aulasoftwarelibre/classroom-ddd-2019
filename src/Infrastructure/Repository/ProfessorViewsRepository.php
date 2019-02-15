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

namespace App\Infrastructure\Repository;

use App\Domain\Professor\Exception\ProfessorIdDoesNotExistsException;
use App\Infrastructure\Entity\ProfessorView;
use App\Infrastructure\ReadModel\Repository\ProfessorViews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProfessorView|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfessorView|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfessorView[]    findAll()
 * @method ProfessorView[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class ProfessorViewsRepository extends ServiceEntityRepository implements ProfessorViews
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProfessorView::class);
    }

    public function add(ProfessorView $professorView): void
    {
        $this->_em->persist($professorView);
        $this->_em->flush();
    }

    public function get(string $professorId): ProfessorView
    {
        $professorView = $this->ofId($professorId);

        if (!$professorView instanceof ProfessorView) {
            throw ProfessorIdDoesNotExistsException::withProfessorId($professorId);
        }

        return $professorView;
    }

    public function ofId(string $professorId): ?ProfessorView
    {
        return $this->find($professorId);
    }

    public function ofUsername(string $username): ?ProfessorView
    {
        return $this->findOneBy(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->findAll();
    }
}
