## Steps To install
 - ```composer install```
 - ```docker-compose up```
 - Now you can check http://localhost

### Testing
 - ```vendor/bin/phpunit```

### Second Assessment
We can use a query like this:
```
SELECT 
b.country,b.state,
(SELECT avg(l.value) FROM loan as l where l.is_active = 1 and l.branch_id = b.id) AS average 
FROM branch as b
```
However it might not be a good approach because of nested select queries and their long time consuming performance. A good alternative would be to take all records in one query by joining two tables and then use a php functionality (such as avg() in laravel or any function in any other platform or language) to get the average. This way we have only one query, and we can save a lot of time