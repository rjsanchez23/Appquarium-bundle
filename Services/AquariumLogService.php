<?php

namespace AppquariumBundle\Services;


use AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface;

class AquariumLogService {

    private $entityManager;

    public function __construct(EntityRepositoryInterface $entityManager)
    {

        $this->entityManager = $entityManager;

    }

    public function logs($inhabitant)
    {
        $logs = $this->entityManager->repository('AppquariumBundle:InhabitantLog')->findBy(
            array("aquariumInhabitant" => $inhabitant), array('createdAt' => 'DESC')
        );

        return $logs;
    }

    public function postDetails($postId)
    {

        $post =  $this->entityManager->repository('AppquariumBundle:InhabitantLog')->find($postId);
        return $post;
    }

    public function remove($postId)
    {

        $post = $this->postDetails($postId);
        $this->entityManager->remove($post);

    }


}