I. Install XAMPP
------------------
1. Go to https://www.apachefriends.org/download.html and download the latest version of XAMPP

2. While installing, select c:\xampp\ as your installation folder

3. Ensure that you install PHP, Apache and MySQL. 

4. Run XAMPP from the windows start menu and ensure that you start Apache and MySQL from the XAMPP Control Panel by clicking on the "start" button for each of them.



II. Install Database
-------------------------

A. Create user account
-----------------------

1. Click on Admin button for MySQL in the XAMPP Control Panel

2. Click phpMyAdmin on the left pane. Then click User accounts on the right pane

3. Click "Add user account" under New on the screen.

4. Type your username (e.g. tarav) in the User name field

5. Select Local in the Host name field

6. Type your password (e.g. lab_management) in the Password field. Retype the password again under Re-type.

7. Check "Check all" for Global Priviletes

8. Click on "Go" to create a new user


B. Create Lab Management Database
-----------------------------------

1. Click "New" on the left panel tree.

2. On the right panel, click "Databases" on the menu

3. Type the database name "lab_management" under "Create database". Select utf8mb4_general_ci character set and then click on Create. A database with the name lab_management will now be visible on the left panel tree.

4. Click on lab_management in the left panel tree. Then click on "Import" in the right panel.

5. Under "File to Import:", choose the file "lab_management.sql". 

6. Scroll down and click the "Import" button. You will see the following on the left panel tree:
* Three tables will be created i.e. activity, inventory and user

7. Click the activity table on the left panel tree. You will see all the records in the table on the right panel. This means the database installation has been successful.




III. Install PHP files
-----------------------
1. Go to c:\xampp\htdocs and create a subfolder called labmanagement. 

2. Unzip the lab_management.zip and copy all its contents into c:\xampp\htdocs\labmanagement. You will have the following:

* All PHP files will be in c:\xampp\htdocs\labmanagement

* A sub-folder c:\xampp\htdocs\labmanagement\image will be created that will contain a single image school-logo.png

* A sub-folder c:\xampp\htdocs\labmanagement\css will be create that will contain a single css file called style.css


3. Open constants.php file in a notepad and do the following:
* Replace DB_USER value "tarav" to the userid you had set for the database in MySql
* Replace DB_PASS value "lab_management" to the password you had set for the database

4. Save constants.php and close the file.



IV. Using the Lab Management System:
-------------------------------------
1. Type http://localhost/labmanagement/login.php on the browser

2. Type any of the following samples to login:

Teacher Login: 
Userid: marypete
Password: gwn

Student Login:
Userid: rahulkumar
Password: gwh
