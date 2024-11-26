# midgard
![Score Recording](https://github.com/user-attachments/assets/814b6307-515e-43cb-b1c4-07adf6bd8d35)

## Description
Midgard was a team project for university where it involved creating a database system that allows archers to track and view their scores. The database is created using MySQL while the website uses PHP to connect the database to the website. 
In this repository, you will be able to see the final version of the database along with a website created for inserting new scores based on the inputted rounds and archers. 

The teammates involved in this project were: 
- Meesum Ali
- Jerrome Yong
- Bennett Biju Mathew
- Alexander Ozimkovsky-Klein

## Database Design
The design of the database went through multiple stages, these stages involved understanding the client's requirements, create a inital design and refining and reshaping it to the final product. With this database, the approach was to use a third normal form structure where each record that is connected to its own table. This approach ensures that a column within a record is not redundant and is consistent across the board. The Entity Relationship is shown below, where the relationship between tables are shown. 
![Entity Relationship Diagram for the Database](https://github.com/user-attachments/assets/79f60157-cf30-405f-92ac-4ddb5f269cf0)

## Project Setup
Before setting up the project, you would need:
- XAMPP with phpMyAdmin installed

Adding the Database
- Open the XAMPP Control Panel
- Start the Apache and MySQL.
- Click the 'Admin' Button of MySQL, you will be redirected to a phpMyAdmin website.
- Create a new database
- Find the import button and choose the 'database.sql' inside the 'database' folder and import it. This will create all of the tables.  

### Running the Website
- Navigate to the htdocs folder within the base XAMPP folder such as 'C:\xampp\htdocs'
- Download the project folder and then place the folder inside inside the 'htdocs' folder.
- Go inside the project folder and inside the website folder and open the 'settings.php' file. 
- Inside this file, you will have to change the details of the host, username, password and database to match your database setup.
- Once the settings were updated, the website is able to be accesed via url, an example of this is 'localhost/midgard/website/'.

## Website Photos
![Round Selection](https://github.com/user-attachments/assets/3b9e9c10-4b9c-4670-81e3-b417b971db67)
![Competition Selection](https://github.com/user-attachments/assets/081fe926-e416-4f04-b355-ce320662555a)
![Archer + Equipment Selection](https://github.com/user-attachments/assets/07da59b6-b8dc-4694-bbbd-0056d15cf157)
![Score Recording](https://github.com/user-attachments/assets/814b6307-515e-43cb-b1c4-07adf6bd8d35)
![Results](https://github.com/user-attachments/assets/108c48ed-becf-4ba5-ab47-ee809127c7d1)
