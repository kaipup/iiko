<?php

/**
 * Коннектор к базе
 */
class DbManager
{
    private PDO $pdo;

    public function __construct(
        private readonly string $dsn,
        private readonly string $dbUser,
        private readonly string $dbPass,
    )
    {
        $this->pdo = $this->setConnect();
    }

    /**
     * @throws PDOException
     */
    private function setConnect(): PDO
    {
        $pdo = new PDO($this->dsn, $this->dbUser, $this->dbPass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    /**
     * Получает соединение
     *
     * @return PDO
     */
    public function getConnect(): PDO
    {
        return $this->pdo;
    }
}
