# Element Collection for the Comproso Framework
This is a collection of standard item types (elements) for the comproso framework. It contains the following types:
* Question: (labeled) HTML form elements, including the tags `<input>`, `<select>` and `<textarea>`
* Explanation: HTML code/text/headline element

## Requirements
* comproso/testing: 0.1+ (included in comproso/framework)

## Installation
1. Use CLI (or add to your composer.json): `composer require comproso/testing`
2. Run `composer update`

## Configuration
1. Add `Comproso\Elements\ElementCollection\ComprosoElementCollectionServiceProvider::class` to your `bootstrap/app.php` (laravel/lumen) or `config/app.php`(laravel/laravel).
2. Run `composer update`
3. Run `php artisan vendor:publish`

## License
Copyright (C) 2016 Thiemo Kunze <hallo (at) wangaz (dot) com>

This program is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.

## Notice & Disclaimer
Using instruments or tests for behavioral assessment is subject to urgently ethical and legal restrictions. You have to respect the laws of your jurisdiction as well as ethical directives. For further information see [comproso/framework](https://github.com/comproso/framework) or [comproso.org](https://comproso.org/ethic).