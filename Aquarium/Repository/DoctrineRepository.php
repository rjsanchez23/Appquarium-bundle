<?php


namespace AppquariumBundle\Aquarium\Repository;


use Doctrine\ORM\EntityManager;

class DoctrineRepository implements EntityRepositoryInterface
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {

        $this->entityManager = $entityManager;
    }

    public function repository($repository)
    {
        return $this->entityManager->getRepository($repository);
    }

    public function save($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function remove($entity)
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}