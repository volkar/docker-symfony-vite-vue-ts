<?php
declare(strict_types=1);

namespace App\Tests\Environment;

use PHPUnit\Framework\TestCase;

class PhpTest extends TestCase
{
    public function test_phpunit_execution_succeeded()
    {
        $this->assertTrue(true);
    }
}
