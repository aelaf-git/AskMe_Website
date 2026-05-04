# AskMe Website

A travel and tourism website built with PHP that allows users to explore destinations, packages, blogs, and travel guides.

## Features

- Destination listings and details
- Travel packages
- Blog posts
- Testimonials
- Event listings
- User authentication (login/register)
- Newsletter subscription
- Contact form
- Traffic tracking

## Requirements

- PHP 7.4+
- MySQL/MariaDB
- Apache/Nginx web server

## Setup

1. Clone the repository
2. Import `database.sql` into your MySQL database
3. Configure database connection in `includes/db.php`
4. Set up your web server to point to the project directory
5. Access the site via your local server

## Project Structure

```
├── api/              # API endpoints (login, register, newsletter)
├── assets/           # Images, JS, CSS libraries
├── includes/         # Reusable PHP components (navbar, footer, DB connection)
├── pages/            # Individual page views
├── index.php         # Main entry point
└── database.sql      # Database schema
```

## License

MIT
