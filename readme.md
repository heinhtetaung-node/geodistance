# Project installation

## By Using Docker
- docker-compose up -d
- bash start.sh -d

can run in localhost:8080 or MachineIP:8080

can run automatic testing by running this command but it is already done in start.sh
- docker-compose exec app vendor/bin/phpunit


## Without Docker
- bash start.sh
- php artisan serve --port=8080

can run in localhost:8080

can run automatic testing by running this command but it is already done in start.sh
- vendor/bin/phpunit


## Manual Testing

#### Place Order
http://localhost:8080/api/orders
POST METHOD
```
Request
{
    "origin": ["38.896281", "-77.021328"],
    "destination": ["40.731159", "-74.015994"]
}
```
```
Response
{
    "id": 1,
    "distance": 365345,
    "status": "UNASSIGNED"
}
```
Api is powered by https://www.mapbox.com/

38.896281, -77.021328 is WashingtonDC Latitude and Longitude

40.731159", -74.015994 is Newyork Latitude and Longitude

The distance between WashingtonDC and Newyork is 227 mile (365345 meter = 227 mile) according to the following google map link.
https://www.google.com/maps/dir/New+York,+USA/Washington,+District+of+Columbia,+USA/@39.478161,-77.5658528,7z/data=!4m14!4m13!1m5!1m1!1s0x89c24fa5d33f083b:0xc80b8f06e177fe62!2m2!1d-74.0059728!2d40.7127753!1m5!1m1!1s0x89b7c6de5af6e45b:0xc2524522d4885d2a!2m2!1d-77.0368707!2d38.9071923!3e0



### Take order
http://localhost:8080/api/orders/1
PATCH METHOD
```
Request
{
    "status" : "TAKEN"
}
```
```
Response
{
    "status": "SUCCESS"
}
```

### Order list
GET METHOD

http://localhost:8080/api/orders?page=1&limit=2
```
Response
[
    {
        "id": 2,
        "distance": 461527,
        "status": "UNASSIGNED"
    },
    {
        "id": 1,
        "distance": 365345,
        "status": "TAKEN"
    }
]
```
