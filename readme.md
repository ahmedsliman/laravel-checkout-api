# laravel-checkout-api

A RESTful e-commerce API for products and reviews, built with **Laravel 5.7** and **Passport (OAuth2)**.

> **Status:** an early project from 2018, kept as-is. Next up is a rebuild on current Laravel that adds a checkout endpoint (see [Roadmap](#roadmap)).

## What it shows

- **API Resources:** responses are shaped separately from the database models. The API exposes `description` while the column is `details`, and computed fields come from the resource, not the table.
- **Computed fields:** discounted `totalPrice` and the average `rating` from reviews are calculated on read.
- **Linked resources:** every product links to its reviews (`href.reviews`), so clients follow links instead of building URLs.
- **Nested routes:** reviews live under their product, at `/api/products/{product}/reviews`.
- **Ownership checks:** only the user who owns a product can update or delete it.
- **JSON errors:** a custom exception handler returns clean JSON for unknown routes and missing records, instead of HTML error pages.
- **OAuth2:** write endpoints are protected with Laravel Passport (`auth:api`).

## Endpoints

| Method | Path | Auth | Description |
|---|---|---|---|
| GET | `/api/products` | – | Paginated product list (20 per page) |
| GET | `/api/products/{id}` | – | Product details with price, rating and review link |
| POST | `/api/products` | ✓ | Create a product (validated) |
| PUT | `/api/products/{id}` | ✓ owner | Update a product |
| DELETE | `/api/products/{id}` | ✓ owner | Delete a product |
| GET | `/api/products/{id}/reviews` | – | Reviews for a product |

## Example response

`GET /api/products/1` (sample data, shape taken from `ProductResource`)

```json
{
  "data": {
    "name": "Wireless Keyboard",
    "description": "Compact Bluetooth keyboard",
    "price": 80,
    "stock": 12,
    "discount": 25,
    "totalPrice": 60,
    "rating": 4.33,
    "href": {
      "reviews": "http://localhost:8000/api/products/1/reviews"
    }
  }
}
```

## Project layout

```
app/Http/Controllers/   ProductController, ReviewController
app/Http/Resources/     ProductResource, ProductCollection, ReviewResource
app/Http/Requests/      ProductRequest (validation)
app/Exceptions/         JSON error handling, ownership exception
database/               migrations, factories, seeders
```

## Roadmap

- Rebuild on current Laravel with Sanctum, policies and money stored as integer cents
- **Checkout endpoint:** an `Idempotency-Key` header, stock reserved inside a database transaction with row locks so it can't oversell, and order states
- Finish the review write endpoints, plus feature tests and CI

## License

MIT
