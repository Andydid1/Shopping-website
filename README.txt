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
(2) Set up mysql database with queries in sql_queries.txt, the queries would create the tables needed for 
the website. The queries would also create an inventory called Ministorage, products Apple and Orange.
(3) Then start your server and go to sign_up.php or login.php in your browswer to start your shopping experience.

PS:
You have to log into an account in order to do anything else. To get an account, click sign up or go to 
sign_up.php for a new account.
This is the first website I have ever designed and implemented. The whole website cost about 20 hours of 
designing and development, so far. More follow up applications will be updated on the website. Wait and see!
