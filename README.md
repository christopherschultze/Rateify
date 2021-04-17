# Rateify

This project is a submission for a database managment systems university course.

Rateify is a service that simulates a music service platform, and allows users to rate artists' songs with comments and stars.

Sources:
- landing page template (https://webresourcesdepot.com/freebie/knight/#download)


in APIs folder contains logic of all SQL query functions, their blueprints and definitions as well as handling data input and output.
Diagrams folder contains PDF version of DFD and HIPO diagrams
frontend contains graphics and other display pages this project

To run this project:
1. Download xampp at (suggested: https://www.apachefriends.org/download.html)
2. Install xampp (normally recommended default directory in C:/xampp)
3. choose any directory on computer, git clone https://github.com/Christopher-Schultze/Rateify.git
4. Copy the Rateify file and paste it in C:/xampp/htdocs
5. Run server by opening xampp control at C:/xampp/xampp-control. Once the console pops up, start Apache and MySQL
6. Start database by going to any web browser and type localhost:80/phpmyadmin
7. Create a database by importing the spotify.sql file in the repository
8. Run the project, starting the landing page by typing localhost:80/Rateify/frontend/index.php

The database found in spotify.sql is just an example database, feel free to add or remove any tuples in any tables