The project contains two files 'pharmacies.html' and 'pharmacyapi.php'.
pharmacies.html is used as an interface, written using html and javascript, 
to get input(latitude and longitude values) from the user and call the 
api'pharmacyapi.php' and show the output as returned by the api.

The API is written using PHP script. The parameter (Latitude and Longitude values)
can be passed through GET request. 
Using the pharmacies.csv file data and "Haversine" formula, the application
calculates the location to the nearest pharmacy.
The application return the JSON data containing the name and location 
of the nearest pharmacy as well the distance to it in miles.

To run the application, you need apache server that runs php script. If you are using
XAMPP put the both project files as well as the pharmacies.csv file in the same folder
inside htdocs folder.Then, you can access the project using any web browser using link:
localhost/foldername/pharmacies.html in your computer.
As in this case, if you put the extracted folder inside htdocs then the link is
localhost/challenge/pharmacies.html

