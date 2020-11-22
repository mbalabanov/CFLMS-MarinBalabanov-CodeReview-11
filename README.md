# CFLMS CodeReview 11 MarinBalabanov

## Project description: “Adopt a Pet”

__Please find a video of the project here: https://youtu.be/Ig9F8vZOXuY__

This is a pet database with a web frontend in Bootstrap, JQuery, PHP and MySQL. All pets have a photo and live at a specific location. They also a description, age and belong to a breed.

All animals show their name, an image, a description and a location. A location should hold information about the city, ZIP-code, address. Senior animals (older than 8 years old) have their age emphasized.

The pet list page has a __live search__ allowing users to  filter/search through the pets (this feature uses AJAX).


## User Types
By default, there are three kinds of users:
- __User:__ Can access the list of pets and search/filter through it. This type of user _cannot_ create new pet entries, add new locations and create new users or change existing ones. 
- __admin:__ Can access the list of pets and search/filter through it and can create new pet entries as well as add new locations or change existing ones. This type of user _cannot_ create new users or change existing users.
- __superadmin:__ This type of user has unrestricted rights. They can access the list of pets and search/filter through it, can create new pet entries, add new locations or change existing ones and they can create new users or change existing users.

The database export provided in this repository has three predefined users. Please find their login credentials below:
- For a __standard user__ please use username __test1@test.com__ and __tatata__ as the password.
- For an __admin user__ please use __admin@admin.com__ and __tatata__ as password.
- For __superadmin__ please use __superadmin@admin.com__ and __tatata__ as password.
