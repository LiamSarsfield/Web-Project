###################
Project details
###################
Midwest Electronics is a CRM web applicaiton built for our 3rd Year Group Project.
Customers and staff members have seperate login portals.
Customers can purchase products from a store and staff members can update customers on their order status.

This was a group project made in 3rd year
It takes advantage of CodeIgniter's MVC OOP approach as it includes an intricate CRUD setup of many different entities and different types of relationships.

**************************
Primary contributions I made
**************************

I am most proud of how I implemented the CRUD setup. I implemented a generic "Functions" controller (\application\controllers\Functions.php) that is used for the majority of the CRUD setup through the setup.
It recursively finds the database relationships belonging to a specific entity and manipulates the data in inside the "Generic_model" model ("\application\models\Generic_model.php").
For a complete list of what files I have created, please see the file "Functions made by people" in the docs folder.

*******************
Server Requirements
*******************

PHP version 7.0 or newer is recommended.
MySQL/Percona 5.6 is recommended

************
Installation & docs
************

Please see the document Installation Instructions inside the "docs" folder.
We have an ERD Diagram inside in our "db_init" folder as well.
