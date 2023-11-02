<?php

namespace Tests\Unit;

use DB;
use MongoDB\Laravel\Connection;
use Tests\TestCase;

class DBConnectionTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testConnection()
    {
        $connection = DB::connection();
        $this->assertInstanceOf(Connection::class, $connection);
    }

}
