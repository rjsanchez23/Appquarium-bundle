<?php namespace AppquariumBundle\Services\Admin;

use AppquariumBundle\Aquarium\Library\CipherInterface,
    AppquariumBundle\Aquarium\Repository\EntityRepositoryInterface,
    AppquariumBundle\Aquarium\ValueObjects\Email;

class AdminService {

    private $entityManager;
    private $cipher;

    public function __construct(EntityRepositoryInterface $entityManager, CipherInterface $cipher)
    {
        $this->entityManager = $entityManager;
        $this->cipher = $cipher;
    }

    public function delete(Email $email)
    {
        $user = $this->findByEmail( (string) $email);
        $this->entityManager->remove($user);
    }

    public function update(array $userData)
    {
        $user = $this->findByEmail($userData['email']);

        $user->setEmail($userData['email']);
        $user->setUsername($userData['username']);
        $user->setSurname($userData['surname']);
        $user->setName($userData['name']);
        $user->setLocked($userData['status']);

        $this->entityManager->save($user);
    }

    public function getAllUsers()
    {
        return $this->entityManager->repository("AppquariumBundle:User")->findAll();
    }

    public function getAllParameters()
    {
        return $this->entityManager->repository("AppquariumBundle:AquariumParam")->findBy([ "defaultParam" => 1 ]);
    }

    public function getAllUsersSubscribedToNewsletter()
    {
        $users = $this->getAllUsers();
        $subscribers = array_filter($users, function($user){
            return $user->isNewsletterSubscription();
        });
        return $subscribers;
    }

    public function findByEmail($email)
    {
        $userRepository = $this->entityManager->repository("AppquariumBundle:User");
        $email = $this->cipher->encrypt($email);
        $user = $userRepository->findOneBy([ 'email' => $email ] );

        if (!$user)
        {
            throw new \InvalidArgumentException('No se ha encontrado el usuario con el email: '. $email);
        }

        return $user;
    }
} 