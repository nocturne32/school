# Info

This is a school project created by David Pocar.

The goal of the project was to create a REST API to manage Customers, Products and Orders.

# Installing

1. `composer install`
2. `php bin/console doctrine:database:create`
3. `php bin/console doctrine:schema:create`

# Architecture

[Architecture sketch](https://i.imgur.com/8TJSxyZ.png)

Everything relevant to this project is located in `src/` directory. 

Routes are defined in `config/routes.yaml`.

## Client 
[REST API Endpoints](#rest-api-endpoints)

Controllers work with facades and DTOs and return JSON responses.

## Business 
Facade works with Repositories and Entities. 

Returns entities as mapped DTOs. 

## Data

Data as Entities that can be persisted and retrieved with EntityManager and corresponding Repository. 

MariaDB database. 

# REST API Endpoints

## Customers
### List
`[GET] http://127.0.0.1:8000/api/customers`
```json5
//response
{
    "code": 200,
    "message": "Customer list",
    "data": [
        {
            "id": 1,
            "email": "lukas@test.tt",
            "firstname": "Lukáš",
            "lastname": "Buďějovický"
        },
        {
            "id": 2,
            "email": "matej@test.tt",
            "firstname": "Matěj",
            "lastname": "Dobrovický"
        }
    ]
}
```
### Create
`[POST] http://127.0.0.1:8000/api/customers`  
```json5
//request
{
    "email": "test@test.tt",
    "firstname": "FirstnameTest",
    "lastname": "LastnameTest"
}
```
```json5
//response
{
    "code": 200,
    "message": "Customer with email test@test.tt created"
}
```
### Detail
`[GET] http://127.0.0.1:8000/api/customers/1`
```json5
//response
{
    "code": 200,
    "message": "Customer detail",
    "data": {
        "id": 1,
        "email": "lukas@test.tt",
        "firstname": "Lukáš",
        "lastname": "Buďějovický"
    }
}
```

### Update
`[PUT] http://127.0.0.1:8000/api/customers/1`
```json5
//request
{
    "email": "test@test.tt",
    "firstname": "FirstnameTest",
    "lastname": "LastnameTest"
}
```
```json5
//response
{
    "code": 200,
    "message": "Customer with id 1 updated"
}
```
### Delete
`[DELETE] http://127.0.0.1:8000/api/customers/1`
```json5
//response
{
    "code": 200,
    "message": "Customer with id 1 deleted"
}
```
### Customer order list
`[GET] http://127.0.0.1:8000/api/customers/1/orders`
```json5
//response
{
    "code": 201,
    "message": "Customer's orders",
    "data": {
        "customer": {
            "id": 1,
            "email": "test@mail.cz",
            "firstname": "Lukáš",
            "lastname": "Buďějovický"
        },
        "orders": [
            {
                "id": 1,
                "products": [
                    {
                        "id": 1,
                        "code": "book_1",
                        "name": "Book 1",
                        "price": 10.0,
                        "description": "Desc"
                    },
                    {
                        "id": 2,
                        "code": "book_2",
                        "name": "Book 2",
                        "price": 20.0,
                        "description": "Desc"
                    }
                ],
                "ordered_at": "2021-04-03T12:54:59+02:00",
                "total_price": 30.0
            }
        ]
    }
}
```
## Products
### List
`[GET] http://127.0.0.1:8000/api/products` 
```json5
//response
{
    "code": 200,
    "message": "Product list",
    "data": [
        {
            "id": 1,
            "code": "book_1",
            "name": "Book 1",
            "price": 10.0,
            "description": "Desc"
        },
        {
            "id": 2,
            "code": "book_2",
            "name": "Book 2",
            "price": 20.0,
            "description": "Desc"
        }
    ]
}
```

### Create
`[POST] http://127.0.0.1:8000/api/products` 
```json5
//request
{
    "code": "beer_1",
    "name": "Beer 1",
    "price": 2.1,
    "description": "Desc"
}
```
```json5
//response
{
    "code": 201,
    "message": "Product with id 3 created"
}
```

### Detail
`[GET] http://127.0.0.1:8000/api/products/1`
```json5
//response
{
    "code": 200,
    "message": "Product detail",
    "data": {
        "id": 1,
        "code": "book_1",
        "name": "Book 1",
        "price": 10.0,
        "description": "Desc"
    }
}
```
### Update
`[PUT] http://127.0.0.1:8000/api/products/1`
```json5
//request
{
    "code": "beer_1",
    "name": "Beer 1 - update",
    "price": 12,
    "description": "Desc"
}
```
```json5
//response
{
    "code": 201,
    "message": "Product with id 1 updated"
}
```
### Delete
`[DELETE] http://127.0.0.1:8000/api/products/1`
```json5
//response
{
    "code": 200,
    "message": "Product with id 1 deleted"
}
```

## Orders
### List
`[GET] http://127.0.0.1:8000/api/orders`
```json5
//response
{
    "code": 200,
    "message": "Order list",
    "data": [
        {
            "id": 1,
            "customer": {
                "id": 1,
                "email": "test@mail.cz",
                "firstname": "Lukáš",
                "lastname": "Buďějovický"
            },
            "products": [
                {
                    "id": 1,
                    "code": "book_1",
                    "name": "Book 1",
                    "price": 10.0,
                    "description": "Desc"
                },
                {
                    "id": 2,
                    "code": "book_2",
                    "name": "Book 2",
                    "price": 20.0,
                    "description": "Desc"
                }
            ],
            "ordered_at": "2021-04-03T11:20:42+02:00",
            "total_price": 30.0
        }
    ]
}
```

### Create
`[POST] http://127.0.0.1:8000/api/orders`
```json5
//request
{
    "customer": 1,
    "products": [
        1,
        2
    ]
}
```
```json5
//response
{
    "code": 201,
    "message": "Order with id 1 created"
}
```
### Detail
`[GET] http://127.0.0.1:8000/api/orders/1`
```json5
//response
{
    "code": 200,
    "message": "Order list",
    "data": {
        "id": 1,
        "customer": {
            "id": 1,
            "email": "test@mail.cz",
            "firstname": "Lukáš",
            "lastname": "Buďějovický"
        },
        "products": [
            {
                "id": 1,
                "code": "book_1",
                "name": "Book 1",
                "price": 10.0,
                "description": "Desc"
            },
            {
                "id": 2,
                "code": "book_2",
                "name": "Book 2",
                "price": 20.0,
                "description": "Desc"
            }
        ],
        "ordered_at": "2021-04-03T11:20:42+02:00",
        "total_price": 30.0
    }
}
```
### Update
`[PUT] http://127.0.0.1:8000/api/orders/1`
```json5
//request
{
    "customer": 1,
    "products": [
        3
    ]
}
```
```json5
//response
{
    "code": 201,
    "message": "Order with id 1 updated"
}
```
### Delete
`[DELETE] http://127.0.0.1:8000/api/orders/1`
```json5
//response
{
    "code": 200,
    "message": "Order with id 1 deleted"
}
```
