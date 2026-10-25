<?php
require_once dirname(__DIR__, 2) . '/config/database.php';

class BaseModel
{
    protected PDO $pdo;

    // Constructor Injection: Database diterima dari luar
    public function __construct(Database $database)
    {
        $this->pdo = $database->getConnection();
    }
}