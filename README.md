# About USMS@Mobile & USMS@WEB application :
Hello everyone, This application was created at the very end of 2019 as part of the Master training. The idea is to manage our faculty 
[polydisciplinary of beni mellal](http://www.fpbm.ma/new/). We had a large functionalities to implement and we tried our best 
to implement the maximum in a shot time enough talking if you're interested in trying it lets dive into the guide.

***Note :***	Please remember that you need to setup mobile side and web side to test the app, You can click on Master-ISI-Projects above then
choose usms-web for web side, I recommend you to setup web side first.
***PS :***	You have to install composer because it's a laravel application.

To setup the app you can follow those steps :

 - Download the project or clone it using : `git clone https://github.com/Master-ISI-Projects/usms-web.git`
 - Navigate to `usms-web/web/` and run `composer install`
 - Create a database named usmsweb, Our db config `DB_DATABASE=usmsweb DB_USERNAME=root DB_PASSWORD= `
 - Import the database `usms-web/database/usmsweb.sql`
 - Navigate to `usms-web/web/` and run `php artisan serve --host=your_ip_adress --port=8000`
 - Now you can access to web APP & run the mobile app and start navigating
 
 ***Note :***	Make sure you're connected from same INTERNET source for example if you're using WIFI and testing the app
using your physical phone both computer & phone must use same wifi etc.

## Contributors


<table>
  <tbody>
    <tr>
      <td align="center">
        <a href="https://github.com/mouadziani">
          <img width="150" height="150" src="https://github.com/mouadziani.png?v=3&s=150">
          </br>
          Mouad ZIANI
        </a>
      </td>
      <td align="center">
        <a href="https://github.com/ELATTARIYassine">
          <img width="150" height="150" src="https://github.com/ELATTARIYassine.png?v=3&s=150">
          </br>
          Yassine ELATTARI
        </a>
      </td>
      <td align="center">
        <a href="https://github.com/TahaOmarNAJAH">
          <img width="150" height="150" src="https://github.com/TahaOmarNAJAH.png?v=3&s=150">
          </br>
          Taha Omar NAJAH
        </a>
      </td>
      <td align="center">
        <a href="https://github.com/kadd0ury">
          <img width="150" height="150" src="https://github.com/kadd0ury.png?v=3&s=150">
          </br>
          Kamal KADDOURY
        </a>
      </td>
    </tr>
  <tbody>
</table>


# Screenshots :

<img src="https://github.com/Master-ISI-Projects/usms-web/blob/master/screenShots/admin_auth.jpg" />
<img src="https://github.com/Master-ISI-Projects/usms-web/blob/master/screenShots/dashboard.jpg" />
<img src="https://github.com/Master-ISI-Projects/usms-web/blob/master/screenShots/department.jpg" />

***More :*** For more images check this folder inside the repo: [ScreenShots](https://github.com/Master-ISI-Projects/usms-web/tree/master/screenShots) also you can check [mobile application](https://github.com/Master-ISI-Projects/usms-mobile)
