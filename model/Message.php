<?php

class Message
{
    use ValidateTrait;

    private PDO $pdo;
    private int $text_length = 500;

    public function __construct()
    {
        $this->pdo = PDOConnect::getInstance()->connect();
    }

    public function addMessage(string $name, string $email, string $message): bool
    {
        // Здесь не делаю экранирований, т.к. в данном решении используется PDO и происходит подстановка данных ввода через плейсхолдеры
        if ($this->validateStringLength($message, $this->text_length) && $this->validateEmail($email)) {
            $statement = $this->pdo->prepare('INSERT INTO `kotofoto` (`name`, `email`, `message`) VALUES (:name, :email, :message)');
            $statement->execute([
                'name' => $name,
                'email' => $email,
                'message' => $message,
            ]);

            return (bool)$this->pdo->lastInsertId();
        }

        return false;
    }
}
