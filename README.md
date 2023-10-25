##How To Instal And Run This Project:
Requirements:
- localserver(such as XAMPP, MAMP etc.)
- PHP(will be added on you'r PC with localserver)
- MySQL(will be added on you'r PC with localserver)
- Laravel
- Node js
- TailwindCSS
- Vue js

- Download all files from this repository to you'r work directory(I'm using XAMPP so for me it's `htdocs`) on PC via command 'git clone'
- Create a database called 'book_inventory' in your db(I used mySQL);"
- via command line or terminal go to your directory where all the files are stored and run command 'php artisan migrate' this will add tables to your db
- then run commands "php artisan db:seed --class=BookSeeder" and "php artisan db:seed --class=adminSeeder" to add some data to your tables
- To enter admin panell enter admin's login - root and password - 7355608

Now You can use all the features of this project
