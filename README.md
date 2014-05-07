DB-Management-Final - CST433
============================

Test database search queries for a sample apartment complex based off amenities/price/layout

Setup
=====
To install:
* Clone the repo into your localhost folder
* Initialize the Selenium DB (test data included, but can add more apartments)
```sh
cd DB-Management-Final/static/sql
mysql -u root -p
source init_user.sql;
source init_build.sql;
exit
```

Tables Used
====
* apartment
* building
* tenant
* payment
* landlord

Tables Not used
====
* maintenance

Testing & Queries
======
* Search query on apartment
* Insert query on apartment / Search new insert ID and display
* Insert query on payment / Search new insert ID and display
* For testing insert on payment, only valid names:
```sh
Brandon Sleater
Joseph Stratton
Sarah Silverman
```
