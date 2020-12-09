Created by Guandi Wang 
email: gw1035@nyu.edu

This website is designed as a online shopping website.
The database is made up of five major components: user, address, inventory, product, and orders. 
The ER diagram is also uploaded in this repository, named ER_diagram.png.

User:
A user is someone who accesses the website. Information of user id (primary key), user name, user 
password, balance (used for shopping), and a foreign key address id is stored in user_info database. 
Note that user name is unique for each user. Password is encrypted with sha1() function of php before 
inserting into the database. Users can interact with their account through sign up, login, logout and 
add balance.
Inventory:
An inventory is a place stores products. An inventory consists of inventory id (primary key), inventory
name, size of inventory, and address id. An inventory can be created through create inventory link. 
Storage of each inventory is displayed in inventory page.
Address:
An address consists of address id (primary key), country, state, city, address line1, and address line2. 
A user can have an address, an inventory, which will be introduced in the following, can also have an 
address. User can set up or reset their address through set address page. Inventory can set their address 
when the inventory is created. When a new address is created, the address id will be assigned to user or 
inventory as foreign key in database.
Product:
A product is something to be sold. It consits of product id (primary key), product name, description, 
unit price, and unit. A new product can be created in an inventory page through add product link. In 
add product link, amount of the product in that inventory is received from input. Since product and 
inventory has an many-to-many relation, the product id. inventory id and the amount is inserted into 
stored_in database. 
Orders:
When a user makes a purchase, an order is created. An order consists of order id (primary key), user_id 
(primary key), product_id(primary key), amount of product, date created (year, month, and day). Orders 
of a user is displayed in my order page if a user is logged in.

Instruction:
(1) Clone the repository and modify mysql_info.php with information about your mysql server.
(Instruction 1 is Very important, otherwise accessing mysql would not be successful)
(2) Set up mysql database with queries in sql_queries.txt, the queries would create the tables needed for 
the website. The queries would also create an inventory called Ministorage, products Apple and Orange.
(3) Then start your server and go to sign_up.php or login.php in your browswer to start your shopping experience.

To fully explore the website, follow the following instruction:
(1)	Sign up through sign_up.php. Try input wrong repeating password, you would see an error is caught. Don’t worry
about crashing, all errors would be caught.
(2)	After signing up, you will be automatically logged in and find yourself in the inventory page. You will see your
balance is set to $1000 by default.
(3)	Click on your user name on inventory page to get to person info page. Here you can modify your address and 
your balance. Missing a field other than address_line2 would cause error.
(4)	Try purchase an item. Filling a non-number for amount would catch an error and come back. Insufficient balance 
or storage would catch an error.
(5)	After purchasing, check My orders to see the purchase just made.
(6)	Try adding a new product, you can choose either creating a new product or add an existing order.
(7)	Try creating a new inventory, remember to fill in required field except address line2. After creation, you can 
add product in your new inventory. Navigate between inventories through the bar below inventory page.
(8)	Modify your product storage by clicking on the Remaining number of each product in an inventory.
(9)	Try log out and log in again.


PS:
You have to log into an account in order to do anything else. To get an account, click sign up or go to 
sign_up.php for a new account.
This is the first website I have ever designed and implemented. The whole website cost about 20 hours of 
designing and development, so far. More follow up applications will be updated on the website. Wait and see!
