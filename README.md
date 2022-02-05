# klevu_assignment
A Shopify app written in plain PHP with no framework

<p>This is a very basic stripped down Shopify app that was designed to be as plug and play as possible. It does require a database setup with one table in it and uses MySQL to work with the database. The table structures are as follows:</p>

<table>
  <th colspan="6">client_stores</th>
  <tr>
    <th>Column Name</th>
    <th>Type</th>
    <th>NULL</th>
    <th>Key</th>	
    <th>Default</th>
    <th>Extra</th>
  </tr>
  <tr>
    <td>store_id</td>
    <td>int(11)</td>
    <td>NO</td>
    <td>PRI</td>	
    <td>NULL</td>
    <td>auto_increment</td>
  </tr>
  <tr>
    <td>client_id</td>
    <td>int(11)</td>
    <td>NO</td>
    <td></td>	
    <td>NULL</td>
    <td></td>
  </tr>
  <tr>
    <td>store_name</td>
    <td>varchar(255)</td>
    <td>NO</td>
    <td></td>	
    <td>NULL</td>
    <td></td>
  </tr>
  <tr>
    <td>token</td>
    <td>varchar(255)</td>
    <td>NO</td>
    <td></td>	
    <td>NULL</td>
    <td></td>
  </tr>
  <tr>
    <td>hmac</td>
    <td>varchar(255)</td>
    <td>YES</td>
    <td></td>	
    <td>NULL</td>
    <td></td>
  </tr>
  <tr>
    <td>nonce</td>
    <td>varchar(255)</td>
    <td>YES</td>
    <td></td>	
    <td>NULL</td>
    <td></td>
  </tr>
  <tr>
    <td>url</td>
    <td>varchar(255)</td>
    <td>NO</td>
    <td></td>	
    <td>NULL</td>
    <td></td>
  </tr>
  <tr>
    <td>last_activity</td>
    <td>datetime</td>
    <td>NO</td>
    <td></td>	
    <td>CURRENT_TIMESTAMP</td>
    <td></td>
  </tr>
  <tr>
    <td>active</td>
    <td>tinyint(4)</td>
    <td>NO</td>
    <td></td>	
    <td>1</td>
    <td></td>
  </tr>
</table>

This app will handle the Oauth handshake sent from Shopify as well as the added security of handling the app page view itself. 

This app will also be setup to be scaled in a way the would allow you to make it an external app (not embedded) and be able to have one client handle/work on multiple stores so that it can more easily be used by an agency. It also includes a column in `client_stores` named `active` that can be used to deactivate a store on the back end.


## Setup

### Create the app in Shopify
1. In your partners account (go ahead and create one if you don't have one), under `Apps` click on `Create app` in the top right.
2. Choose public (this is always a better option, in my opinion, because it has greater security measures and if you decide to make the app for another store, you only need the one instance)
3. Name your app
4. Set the `App URL` to point to `oauth.php`. This will be where your app is hosted. (ie: `https://your-app-location.com/oauth.php`)
5. Set the `Allowed redirection URL(s)` to include `postoauth.php` and `index.php`. It should look something like this:
  ```
  https://your-app-location.com/postoauth.php
  https://your-app-location.com/index.php
  ```
6. Click `Create app` in the top right

### Add your app Key and Secret Key to `config.php`
The next screen after clicking `Create app` should display these keys for you. Inside `config.php` set `$api_key` to the API key, and then set `$shared_secret` to the API secret key

### Set your app permissions in `config.php`
Modify the `$scopes` array to contain all permissions your app will need

### Connect your database in `config.php`
Create a database containing two tables with the given structure above. Be sure to create/add a user to this database. The permissions this user needs to have are at minimum `SELECT`, `UPDATE` and `INSERT`.

Inside `config.php` do the following:

1. Set `$servername` to your server name. If your database is on the same server this app is hosted it will likely need to be set to `localhost`. Other wise if it is hosted elsewhere it should be set to the IP address of the server hosting the database.
2. Set `$username` to the database's user account name
3. Set `$password` to the user account's password
4. Set `$dbname` to the name of the database

### Upload your app to your server
The final step here is to upload all of the files for the app to your server. Once that is done your app should be ready to be installed on a development store. This is found under `More actions` when viewing your app inside of Shopify Partners.
