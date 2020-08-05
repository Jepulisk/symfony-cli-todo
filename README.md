## Install

Clone the repository or download and unzip.

Run `composer install` in the project root folder.

Edit the .env file to set up your database and run the following commands in the project root folder.

`php bin/console doctrine:database:create`  
`php bin/console make:migration`  
`php bin/console doctrine:migrations:migrate`

## Commands

`php bin/console todo:new`  
`php bin/console todo:list`  
`php bin/console todo:done`  
`php bin/console todo:remove`  
`php bin/console todo:clear`
