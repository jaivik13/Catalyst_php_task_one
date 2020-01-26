-u – MySQL username
-p – MySQL password
-h – MySQL host

1.] Create Database use Command 
Command >>> php user_upload.php -u [yourusername] -p [yourpassword] -h [yourhost] 
===> This command use for creating database 'user' in MySQL.

2.] Create Table
Command >>> php user_upload.php --create_table -u [yourusername] -p [yourpassword] -h [yourhost]  
===> This command use for creating 'users' table in MySQL.

3.] File
Command >>> php user_upload.php --file users.csv
===> This command use for file view.

4.] Dryrun
Command >>> php user_upload.php --dry_run --file users.csv 
===> Using this command user can see CSV file contain without insert data in to database.

5.] Insert Users CSV file in to dabase
Command >>> php user_upload.php --insert=users.csv -u [yourusername] -p [yourpassword] -h [yourhost]  
===> This command use for insert users.csv file data in to database.

6.]HELP
Command >>> php user_upload.php --help=hp
===> Using this command user get above list of directives with details.




Task 2

command 

php foobar.php