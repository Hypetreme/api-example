# api-example

API endpoint example. Get movie's info from https://www.omdbapi.com or book's info from https://openlibrary.org?

### Prerequisites

SQL database for the test user. (SQL file is provided).

### Examples

### Login

The following gives user the JWT token to use with requests
```
api-example/login?username=restapiuser&password=password666
```

### Search results

#### /getMovie?
title: 't='
year: 'y='
plot: 'plot=short/full'
```
api-example/getMovie?jwt=token_here&t=good+will+hunting
```

#### /getBook?
isbn: 'isbn='
```
api-example/getBook?jwt=token_here&isbn=9780553573404
```

## Built With

* [php-jwt](https://github.com/firebase/php-jwt) - A library to encode and decode JSON Web Tokens (JWT) in PHP

## Author

* **Janne Karppinen**
