<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\Mapping\MappingException;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

abstract class DoctrineBaseRepository
{
    protected ObjectRepository $objectRepository;

    public function __construct(private ManagerRegistry $managerRegistry, protected Connection $connection)
    {
        $this->objectRepository = $this->getEntityManager()->getRepository($this->entityClass());
    }

    protected function getEntityManager(): EntityManager|ObjectManager
    {
        $entityManager = $this->managerRegistry->getManager();

        if ($entityManager->isOpen()) {
            return $entityManager;
        }

        return $this->managerRegistry->resetManager();
    }

    abstract protected static function entityClass(): string;

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    protected function saveEntity(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    protected function removeEntity(object $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws ORMException
     */
    protected function persistEntity(object $entity): void
    {
        $this->getEntityManager()->persist($entity);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     * @throws MappingException
     */
    protected function flushData(): void
    {
        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
    }
}
