Folder config
--------------
1. There are two php files in this folder "Constants.php" and "DB.php".
2. "Constants.php" is used to declare some global costants which are used throughout the whole project.
3. "DB.php" is used to establish the connection with the database.

Folder Objects
---------------
1. There are three files in this folder "Admin.php", "User.php" and "Utility.php".
2. "Admin.php" is used to querry the database. Admin can performe the insertion, deletion of feedback and user.
3. "User.php" contains the queries which a user can perform.
4. "Utility.php" is used to fetch data with the help of Foursquare api.

Folder rest_calls
-----------------
There are three subfolders in this folder -
  1. Folder "Admin" - All the calls from Admin will be first handled by this folder and after that it will send the request to files in the object folder.
  2. Folder "Public" - All the calls from the home page will be first handled by this folder.
  3. Folder "User" -  All the calls from the user will be first handled by this folder and then it will send the request to object folder files.

 Folder views
 ------------
 All the display related files like html files, css files, js files, image files, font files, etc. It includes files like home page, user dashboard, admin dashboard, about, feedback, gallery, login etc.

