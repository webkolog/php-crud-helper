## php-crud-helper

### Description
php-crud-helper is a simple class that enables fast `CRUD` (Create, Read, Update, Delete) operations with MySQL using `PHP 8+` and `PDO`.

### Installation
```php
require 'CRUD.php';
$crud = new CRUD('localhost', 'database_name', 'username', 'password');
```

### Usage

#### Insert Data
```php
$data = ['name' => 'Ali', 'surname' => 'Mantar'];
$crud->create('users', $data);
```

#### Read Data
```php
$users = $crud->read('users', ['name' => 'Ali']);
print_r($users);
```

#### Update Data
```php
$crud->update('users', ['surname' => 'Candan'], ['name' => 'Ali']);
Delete Data
$crud->delete('users', ['name' => 'Ali']);
```

## Warnings
Be sure to take SQL Injection precautions when using this class.

## License
This php-crud-helper class is open-source software licensed under the [MIT license](https://mit-license.org/).
```
MIT License

Copyright (c) 2015 Ali Candan

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

## Contributing
Contributions are welcome! If you find any bugs or have suggestions for improvements, please `feel free to open an issue or submit a pull request on the GitHub repository.`

## Support
For any questions or support regarding the php-crud-helper, you can refer to the project's GitHub repository or contact the author.



