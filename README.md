## 1. User type-based authentication system using laravel default auth

	. Authentication system is developed by using laravel/ui bootstrap auth with roles and permission.
    
	. There are two type of roles (Admin and Manager). 1 is for admin and 2 is for manager.
    
	. Created seeder file for role, admin and manager.
    
	. If a user Register in the system, by defult his role is 2(which is manager).
    
	. Admin have all the access (create, view, edit, delete) of the system and Manager only have (category view and product view) access. 
    
## 2. User can login with email or phone number.

## 3. All crud operation perform with resource route and ajax.


## 4. Seeder data for login
	 Admin
		email: admin@email.com
		phone: 123456789101
		password: 123456S
 
	 Manager
		email: manager@email.com
		phone: 123456789102
		password: 123456 
        
## 5. Project Assesment
	 PHP Version: 7.4
	 Laravel : 8.*


### Steps:

->open your server's root directory.
->open terminal or gitbash. clone the project.
```
git clone https://github.com/r-rakib18/product-management-system.git

```
-> move to project folder.
```
cd product-management-system
```
->install composer for vendor files. (e.g: composer install)
```
composer install
```
->follow commands below:
```
cp .env.example .env
```
```
php artisan key:generate
```
-> create database on your local machine name projectAssisment. (if necessary , change db credentionals from .env file. default: user=root and password='')
```
php artisan migrate
```
```
php artisan db:seed
```
