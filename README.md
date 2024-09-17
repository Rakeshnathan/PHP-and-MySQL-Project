# PHP and MySQL Project
 Project 1 using CRUD for a Personalized Movie Database 
# 
For implementing CRUD logic four files are created. 
movie-view:To view the movie table display all your added movies will be shown. 
movie-add:For adding movie datas which are movie id (auto incremented ), movie name , Genre , year , Rating and Date / Time when it has been added. 
movie-edit:To edit the movie datas.
movie-delete:To delete the movie record.

Layout File has three php files.

Header.php for header having nav bar content and side bar icon along with Login.php and Register.php to login and register.
When an user logins USERNAME will be displayed on top left corner where login and register nav bar will be changed to username only when an authenticated user logs in.

Footer.php containing all footer details
Specifying links and social media accounts.

Menu.php which is the dashboard menu.
having details like Movie (where movie-add,edit,del,view can be seen movie datas ) and login ,regsiter ,main-admin menu.
# 
Dashboard.php file is admin page where admin can select movie option to view it mainly menu.php can be used.

Unauth-user folder has Temp-glance.php which is used as HOME page when unauthorized user accesses the dashboard.php file 
Suppose when in localhost url you can directly access pages by putting movie-view or dashboard.php and can access it so prevent unauth user from using it they will be directed To the HOME page 
User can register and then login to access it after being authenitcated.

Admin can login and access the dashboard.php and new user can register.

ADMINS / USERS Can only see what movies they have added and CRUD can be done such That user_id is used where different USERS / user_id can add what and see only their movies...  

# 
New task/features to be added :
In dashborad need to put Total Movie Count along with types like Action movie ---> name , year ,count.
---Added dashboard entries.--

Super admin role 
NEED TO ADD MAIN ADMIN WHERE HE CAN SEE ALL USERS MOVIEs THAT ARE LISTED AND HAS MAIN CONTROL OVER IT. 

