<?php
/*
PHP CRUD Helper
=====================
File: php-crud-helper.php
Author: Ali Candan [Webkolog] <webkolog@gmail.com> 
Homepage: http://webkolog.net
GitHub Repo: https://github.com/webkolog/php-crud-helper
Last Modified: 2025-03-14
Created Date: 2025-03-14
Compatibility: PHP 8+
Requirements: PDO
@version 1.0

Copyright (C) 2015 Ali Candan
Licensed under the MIT license http://mit-license.org

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

class CRUD {
    private $pdo;

    public function __construct($host, $dbname, $username, $password) {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        try {
            $this->pdo = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function create($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(array_values($data));
    }

    public function read($table, $conditions = []) {
        $sql = "SELECT * FROM $table";
        
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', array_map(fn($col) => "$col = ?", array_keys($conditions)));
        }
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_values($conditions));
        return $stmt->fetchAll();
    }

    public function update($table, $data, $conditions) {
        $setPart = implode(', ', array_map(fn($col) => "$col = ?", array_keys($data)));
        $wherePart = implode(' AND ', array_map(fn($col) => "$col = ?", array_keys($conditions)));
        $sql = "UPDATE $table SET $setPart WHERE $wherePart";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(array_merge(array_values($data), array_values($conditions)));
    }

    public function delete($table, $conditions) {
        $wherePart = implode(' AND ', array_map(fn($col) => "$col = ?", array_keys($conditions)));
        $sql = "DELETE FROM $table WHERE $wherePart";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(array_values($conditions));
    }
}

?>