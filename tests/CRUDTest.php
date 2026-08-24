<?php

use PHPUnit\Framework\TestCase;

class CRUDTest extends TestCase {
    private CRUD $crud;

    protected function setUp(): void {
        // A connection to SQLite or MySQL can be established in the test environment.
        // MySQL can be tested as the MySQL service will be started up via GitHub Actions.
        $this->crud = new CRUD(
            getenv('DB_HOST') ?: '127.0.0.1',
            getenv('DB_NAME') ?: 'test_db',
            getenv('DB_USER') ?: 'root',
            getenv('DB_PASS') ?: 'root'
        );

        // Create/reset table
        $pdo = new PDO(
            "mysql:host=" . (getenv('DB_HOST') ?: '127.0.0.1') . ";dbname=" . (getenv('DB_NAME') ?: 'test_db'),
            getenv('DB_USER') ?: 'root',
            getenv('DB_PASS') ?: 'root'
        );
        $pdo->exec("DROP TABLE IF EXISTS users");
        $pdo->exec("CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50),
            email VARCHAR(100),
            status INT
        )");
    }

    public function testCreate() {
        $data = ['username' => 'johndoe', 'email' => 'john@example.com', 'status' => 1];
        $result = $this->crud->create('users', $data);
        $this->assertTrue($result);
    }

    public function testRead() {
        $this->crud->create('users', ['username' => 'johndoe', 'email' => 'john@example.com', 'status' => 1]);
        $rows = $this->crud->read('users', ['username' => 'johndoe']);
        
        $this->assertCount(1, $rows);
        $this->assertEquals('john@example.com', $rows[0]['email']);
    }

    public function testUpdate() {
        $this->crud->create('users', ['username' => 'johndoe', 'email' => 'john@example.com', 'status' => 1]);
        $result = $this->crud->update('users', ['status' => 2], ['username' => 'johndoe']);
        
        $this->assertTrue($result);
        $rows = $this->crud->read('users', ['username' => 'johndoe']);
        $this->assertEquals(2, $rows[0]['status']);
    }

    public function testDelete() {
        $this->crud->create('users', ['username' => 'johndoe', 'email' => 'john@example.com', 'status' => 1]);
        $result = $this->crud->delete('users', ['username' => 'johndoe']);
        
        $this->assertTrue($result);
        $rows = $this->crud->read('users', ['username' => 'johndoe']);
        $this->assertCount(0, $rows);
    }
}
