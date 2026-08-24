# W-PHP CRUD Helper

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version Required](https://img.shields.io/badge/php-%3E%3D%208.0-8892bf.svg)](https://php.net)
[![Run Tests](https://github.com/webkolog/php-crud-helper/actions/workflows/tests.yml/badge.svg)](https://github.com/webkolog/php-crud-helper/actions/workflows/tests.yml)

**Version:** 1.0.0

**Created Date:** 2025-03-14

**Last Updated:** 2025-03-14

**Created By:** Ali Candan ([@webkolog](https://github.com/webkolog))

**Website:** [http://webkolog.net](http://webkolog.net)

**Copyright:** (c) 2025 Ali Candan

**License:** MIT License ([http://mit-license.org](http://mit-license.org))

---

**W-PHP CRUD Helper** is a lightweight, clean, and modern object-oriented PHP helper class designed to simplify database operations. Powered by **PDO**, it automates the creation of standard SQL queries (`INSERT`, `SELECT`, `UPDATE`, `DELETE`) through array mappings, reducing boilerplate code while maintaining security against SQL injection attacks using strict prepared statements.

## Features

* 🚀 **PHP 8+ Ready:** Utilizes modern PHP features like arrow functions for cleaner and faster execution.
* 🔒 **Secure by Default:** Full integration with PDO prepared statements automatically neutralizes SQL injection risks.
* 🗄️ **Zero Boilerplate CRUD:** Perform database inserts, reads, updates, and deletes with simple array mappings instead of writing raw SQL.
* 🌐 **UTF-8 Support:** Pre-configured with `utf8mb4` encoding to support advanced characters and emojis out-of-the-box.
* 🛠️ **Strict Error Handling:** Enforces `PDO::ERRMODE_EXCEPTION` to catch and debug database faults instantaneously.

## Installation & Setup

Simply include or require the `php-crud-helper.php` file into your PHP project.

```php
require_once 'path/to/php-crud-helper.php';

// Initialize the CRUD class
$db = new CRUD('localhost', 'your_database_name', 'your_username', 'your_password');

```

---

## Usage Overview

### 1. Create (Insert)

Inserts a new row into the specified table using a key-value array where keys match the database columns.

```php
$data = [
    'username' => 'johndoe',
    'email' => 'john@example.com',
    'status' => 1
];

$result = $db->create('users',$data);
// Returns true on success, false on failure

```

### 2. Read (Select)

Fetches records from a table. You can retrieve all records or pass conditions to filter the results.

```php
// Fetch all records
$allUsers =$db->read('users');

// Fetch with conditions (Translates to: WHERE status = 1 AND role = 'admin')
$conditions = [     'status' => 1,     'role' => 'admin' ];$activeAdmins = $db->read('users',$conditions);

```

### 3. Update

Updates existing records dynamically based on the set data and conditions provided.

```php
$updateData = [
    'email' => 'newjohn@example.com',
    'status' => 2
];

$conditions = [
    'id' => 5
];

$result =$db->update('users', $updateData,$conditions);

```

### 4. Delete

Deletes records from a table matching the specific criteria.

```php
$conditions = [
    'status' => 0
];

$result = $db->delete('users',$conditions);

```

---

## Contributing

Contributions are welcome! If you find bugs, security issues, or want to suggest new capabilities (like pagination or custom raw queries), feel free to open an issue or submit a pull request.

## Support

For questions, troubleshooting, or general inquiries regarding W-PHP CRUD Helper, please visit the GitHub issues page or contact the author via [webkolog@gmail.com](https://www.google.com/search?q=mailto%3Awebkolog%40gmail.com) or [http://webkolog.net](http://webkolog.net).

## License

This project is open-source software licensed under the [MIT license](http://mit-license.org/).
