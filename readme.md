# laravel-checkout-api

A REST API for products and reviews, built with Laravel 5.7 and Passport (OAuth2).

> Built in 2018. Next step: rebuild on current Laravel and add a checkout endpoint.

## Features

- Product CRUD. Only a product's owner can update or delete it.
- Reviews nested under products: `/api/products/{id}/reviews`
- Discounted price and average rating calculated on read
- JSON error responses instead of HTML error pages
- OAuth2 login with Laravel Passport

## Endpoints

| Method | Path | Auth |
|---|---|---|
| GET | `/api/products` | – |
| GET | `/api/products/{id}` | – |
| POST | `/api/products` | ✓ |
| PUT / DELETE | `/api/products/{id}` | owner |
| GET | `/api/products/{id}/reviews` | – |

## Example

`GET /api/products/1` (sample data)

```json
{
  "data": {
    "name": "Wireless Keyboard",
    "price": 80,
    "discount": 25,
    "totalPrice": 60,
    "rating": 4.33,
    "href": { "reviews": "/api/products/1/reviews" }
  }
}
```

## License

MIT
