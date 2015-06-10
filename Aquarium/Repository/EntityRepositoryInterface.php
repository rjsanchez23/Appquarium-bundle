<?php


namespace AppquariumBundle\Aquarium\Repository;


interface EntityRepositoryInterface {

        public function repository($repository);
        public function save($entity);
        public function remove($entity);

}