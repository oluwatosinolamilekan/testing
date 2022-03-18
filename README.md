
## Installation

 - After Pulling, Composer Install
 - Run copy .env.example to .env
 - create a database and add the details to env
 - Run php artisan migrate --seed
 - Run php artisan action:run

##Actions
* Delivery
* Rideshare
* Rent

##Action table
* action_type
* time
* user_id

##Action Type Table
* type(name)
* point

#Booster
* Delivery
* Rideshare
* Rent

#Booster Table
* action_type
* time_frame
* point
* expiry_day (Null)

#Users Table
* id
* name
* email

#Steps
* get id of a user
* get all actions of the user with the user_id
* loop through each action, and get action type and calculate total point.
* get deliver actions from action(step 2) and sort by time.
    

  
