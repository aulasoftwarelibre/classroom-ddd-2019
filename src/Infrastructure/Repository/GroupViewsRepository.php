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

use App\Domain\Group\Exception\GroupIdDoesNotExistsException;
use App\Infrastructure\Entity\GroupView;
use App\Infrastructure\ReadModel\Repository\GroupViews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GroupView|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupView|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupView[]    findAll()
 * @method GroupView[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupViewsRepository extends ServiceEntityRepository implements GroupViews
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GroupView::class);
    }

    public function add(GroupView $groupView): void
    {
        $this->_em->persist($groupView);
        $this->_em->flush();
    }

    public function get(string $groupId): GroupView
    {
        $groupView = $this->ofId($groupId);

        if (!$groupView instanceof GroupView) {
            throw GroupIdDoesNotExistsException::withGroupId($groupId);
        }

        return $groupView;
    }

    public function ofId(string $groupId): ?GroupView
    {
        return $this->find($groupId);
    }

    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->findAll();
    }

    public function remove(string $groupId): void
    {
        $group = $this->get($groupId);

        $this->_em->remove($group);
        $this->_em->flush();
    }

    public function save(): void
    {
        $this->_em->flush();
    }
}
