<?php
declare(strict_types=1);

namespace App\Tests\Environment;

use PDO;
use PHPUnit\Framework\TestCase;

class PostgresTest extends TestCase
{
    public function test_connect_to_postgresql_with_pdo()
    {
        $db_host = $_ENV['POSTGRES_HOST'];
        $db_name = $_ENV['POSTGRES_DB'];
        $db_user = $_ENV['POSTGRES_USER'];
        $db_password = $_ENV['POSTGRES_PASSWORD'];

        $pdo = new PDO(
            "pgsql:host=" . $db_host . ";dbname=" . $db_name . ";",
            $db_user,
            $db_password
        );
        $this->assertInstanceOf(PDO::class, $pdo);
    }

}
