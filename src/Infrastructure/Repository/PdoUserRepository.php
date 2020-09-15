<?php

namespace Login\App\Infrastructure\Repository;


use Login\App\Domain\Model\User;
use Login\App\Domain\Repository\UserRepository;
use Login\App\Infrastructure\Persistence\DatabaseCreator;
use PDO;
use PDOStatement;

class PdoUserRepository implements UserRepository
{

    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseCreator::getConnection();
    }

    public function allUsers(): array
    {
        $sql = "SELECT * FROM user_login";
        $stmt = $this->pdo->query($sql);

        return $this->treatUserList($stmt);
    }

    private function treatUserList(PDOStatement $stmt): array
    {
        $userDataList = $stmt->fetchAll();
        $userList = [];

        foreach ($userDataList as $row) {
            $userData = new User();
            $userData->setId($row['user_id']);
            $userData->setEmail($row['email_user']);
            $userData->setPassword($row['password_user']);
            $userData->setActive($row['active_user']);
            array_push($userList, $userData);
        }
        return $userList;
    }


    public function save(User $user): bool
    {
        $sql = "INSERT INTO user_login (email_user, password_user) VALUES (:email_user, :password_user)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email_user', $user->getEmail());
        $stmt->bindValue(':password_user', $user->getPassword());
        $stmt->execute();

        if ($stmt) {
            return true;
        }
        return false;
    }

    public function remove(User $user): void
    {
        $sql = "DELETE FROM user_login WHERE user_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $user->getId());
        $stmt->execute();
    }

    public function update(User $user): void
    {
        $sql = "UPDATE user_login SET active_user = :active_user WHERE user_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':active_user', $user->getActive());
        $stmt->bindValue(':id', $user->getId());
        $stmt->execute();
    }
}