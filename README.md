# setup 

First clone this repository

```
git clone git@github.com:Ericson-WebDeveloper/ClickApp.git
```

# api

First open new terminal and type cd api to access api directory and run this command to install the dependencies, and setup your .env file.

```
composer install
cp .env.example .env
```

Then create the necessary database.

```
create database pgsql with name of clicks
setup env database credentials for pgsql please check .env.example for this
```

And run the initial migrations and seeders.

```
php artisan migrate
```

to run the test unit & feature run this command

```
./vendor/bin/phpunit
```

to run api run this command

```
php artisan serve
```



# client

First open new terminal and type cd client to access client directory and run this command install the dependencies

```
npm install
```


to run client run this command
```
npm run dev
```
