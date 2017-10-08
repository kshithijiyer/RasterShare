# ![logo](https://github.com/kshithijiyer/RasterShare/blob/master/resources/images/logo.png)
RasterShare is an open-source web content management System which is used by the photographers to host their website and blogs. It is a purpose-built, lightweight web content management system. Rastershare is built completely using PHP, HTML, CSS, and Jquery. The main feature of RaterShare is ease of use, hassle-free management of photography blogs and websites. 

## System Requirements
1. Fedora 26 or higher or equivalent
*****
2. Xampp 7.16.0 or higher
****
or
****
2. PHP 7.1.6 or higher
3. Mairadb 10.1.24 or higher
4. phpMyAdmin 4.7.4 or higher
5. Apache 2.4.27 or higher


## Installation
1. After installing a suitable version of XAMPP on your system which satisfies the specified hardware requirements. Create a new MySQL user and create a databases and grant all access the newuser.
2. Download RasterShare by runnning the below given command:
```
git clone https://github.com/kshithijiyer/RasterShare.git
```
3. Unzip the zip file in your document root folder.
4. Now in the db_connection.php file change the parameter as per the ones configured as shown below:
```
#The host name of the database.
$host="localhost";
#The username of the database.
$username="uname";
#The password of the database.
$password="secret ";
#The database name.
$db_name="rastershare";
#The prefix to be added in front of the table.
$table_prefix="rs_";
#The salt to be added to the password.
$nacl="love the way you lie";
#The default username for admin.
$default_admin="rasteradmin";
```
5. Now call the install.php script by opening the URL ```/RasterShare/setup/install.php``` in your browser. And note the password for the admin.
6. To populate the tables created in the database. Run the ```cam_add.php``` and ```phones_add.php``` by going to their corresponding URL through the browser. You can add more
entries by adding more names to cams.txt and phones.txt.
7. Now delete the setup folder by executing the following commands:
```
rm –rf *
cd ..
rmdir setup/
```
8. Set the permissions for userdp and images folder by executing the following command:
```
Chmod 777 userdp
Chmod 777 images
```
9. Now open the URL ```hostname/RasterShare/``` to see if everything is working properly or not.

## Usage 
Users can be of 2 types in any given RasterShare i.e there are only 2 user roles in a RasterShare System:
1. Admin
2. User
> For more details please refer to the user manual.

## Theme building 
Themes can be designed on top of anchors in RasterShare. An Anchor is a specialized PHP script which is used as an API to talk to the database. At a minimum level each theme should have:
1. Index.php
2. Theme.css

RasterShare has the following anchors:
1. Anchor_image - This is used to retrieve one image from the database.
2. Anchor_image_all - This is used to retrieve all the images of a particular user.
3. Anchor_usermeta - This is used to retrieve metadata about the user form usermeta table.
4. Anchor_postdata -This is used to retrieve all the data in a post.

> Each anchor has a predefined set of a variables which holds the data for that anchor which are set when some designated functions are called.

For more details please refer to the techincal manual.

## Built with
1. [Geany](https://www.geany.org/Main/HomePage)
2. [Sublime text](https://www.sublimetext.com/)
3. [Chromium](https://www.chromium.org/Home) (For testing:p)

## Author
[Kshithij Iyer](https://www.linkedin.com/in/kshithij-iyer/)

## Licence 
RasterShare is built and distributed under Apache License 2.0.
