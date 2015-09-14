ByteLand
========

With ByteLand App and the Api you can do reservations, create customers and restaurants.


API Doc
===============

Customer:
_________

view a customer: GET to /customer/{id}
required: {id} of customer

create: Post to /customer
required params: name

edit: PUT to /customer/{id}
required: {id} of customer and param what you want to edit (just name)

delete: DELETE to /customer/{id}
required: {id} of customer

Restaurant:
___________

view a restaurant: GET to /restaurant/{id}
required: {id} of restaurant

create: POST to /restaurant
required params: name, maxPeople

edit: PUT to /restaurant/{id}
required: {id} of restaurant and params what you want to edit (name, maxPeople)

delete: DELETE to /restaurant/{id}
required: {id} of restaurant

Reservation
_________

view a Reservation: GET to /reservation/{id}
required: {id} of reservation

create: POST to /reservation
required params : restaurantId, customerId and date (date of reservation, datetime format)

edit: PUT to /reservation/{id}
required: {id} of reservation and params what you want to edit (just date you can edit)

delete: DELETE to /reservation{id}
required: {id} of reservation to delete








