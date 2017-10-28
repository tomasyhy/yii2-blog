Blog based on Yii 2 framework
===============================

Application is a simple blog website based on [Yii2 Advanced Project Template](http://www.yiiframework.com/download/)

Functionality:
------------------

#### Admin section
1. Create\Edit\Hide\Show\Delete posts.
2. Create\Edit\Delete tags.
3. Hide\Show\Delete comments.

#### Frontend
1. Searching posts by tags.
2. View post.
3. Adding comments.
4. Sending notifications about comments to page admin.
4. Contact form.

#### Console
1. Creating account for admin.

Requirements
-------------------
1. PHP > 5.6
2. Composer

Screenshots
-------------------
![main-page](https://user-images.githubusercontent.com/18007049/32132488-097026e6-bbc5-11e7-85cf-a8851c116a02.jpg)
![post-update](https://user-images.githubusercontent.com/18007049/32132490-09b3e002-bbc5-11e7-9eb0-7bcca89814a3.jpg)
![post-content](https://user-images.githubusercontent.com/18007049/32132489-09926d96-bbc5-11e7-984d-329f67d854ca.jpg)
![admin-panel-posts-list](https://user-images.githubusercontent.com/18007049/32132483-f7939b7e-bbc4-11e7-91ec-ef1112729561.jpg)

Installation
-------------------

### 1. Application
1. Clone or download repository to any folder on your web server.
2. Inside root folder run the application initialization command.

    ```
    php init --env=Production --overwrite=All
    ```
3. Inside root folder install required composer dependencies.

    ```
    composer update
    ```
    
### 2. Database
1. Log to your database and create database.

    ```
    CREATE SCHEMA `database_name`;
    ```
    
2. Run following migrations inside root folder using terminal:

    ```
    php yii migrate
    php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
    ```
    
### 3. Configuration
  
1. Set your database connection by adjust settings under `components['db']` key in your `common/config/main-local.php` file.

2. Set mailer configuration in `components['mailer']` key in your `frontend/config/main-local.php` file. Example:

    ```
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@frontend/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'admin@admin.com',
                'password' => 'password',
                'port' => '587',
                'encryption' => 'tls',
            ],
            'useFileTransport' => false,
        ],
    ]
    ```
    
3. Create admin account.

    ```
    php yii user/create <email> <user_name> <password>
    ```
    
### 4. Setup web server
1. Add following host configuration to your apache host file and adjust `Directory`, `DocumentRoot` and `ServerName`
    ```
    <VirtualHost *:80>
        ServerName blog.com
        DocumentRoot /path-to/root/folder/blog
        <Directory /path-to/root/folder/blog>
            Options Indexes FollowSymLinks
            AllowOverride All
            DirectoryIndex index.php
            Order allow,deny
            Allow from all
        </Directory>
    </VirtualHost>
    ```
    
5. Change the hosts file to point the domain to your server.

   - for Windows: `c:\Windows\System32\Drivers\etc\hosts`
   - for Linux: `/etc/hosts`

   Add the following line:

   ```
   127.0.0.1   blog
   ```
   
### 5. Run application:

1. Noww you can run blog site using following urls:
   
   - for frontend:
   
   ```
   http://blog
   ```
   
   - admin section
   
   ```
   http://blog/admin
   ```
   
If you have any problems visit [Yii2 Documentation](https://github.com/yiisoft/yii2-app-advanced/blob/master/docs/guide/README.md) or contact with me.
