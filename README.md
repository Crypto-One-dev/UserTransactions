# Klink Test

Create a Full stack application using PHP Laravel as a framework.

## Backend:

-   Upload the following CSV and store it in any Database you want to use.
-   Create a database schema with all indexes added.
-   Create a REST API for the following functionalities.

    -   List transactions of users according to the wallet address entered.
    -   Upload CSV of transactions and store it in the database.

-   Show the total amount for the records of the wallet address.

## Frontend:

Create two separate routes.

-   For uploading transaction CSV.
-   Search by wallet address and list it in a grid with the total amount.

<br>

# Method

Create db named : transactions in MySQL

Run migrate to create DB schema

    php artisan migrate

Run project using below command

    php artisan serve

Server running on [http://127.0.0.1:8000]
