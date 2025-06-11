# Laravel Coding Test – Event Booking API

## 🧩 Objective
Build a simple REST API in Laravel for managing events and bookings.

---

## 📋 Requirements
- Need to install docker.

### Models

#### Event
- `id`
- `title`
- `description`
- `start_time` (datetime)
- `end_time` (datetime)

#### Booking
- `id`
- `event_id` (foreign key)
- `name`
- `email`
- `seats_reserved` (integer)

---

### API Endpoints

#### Events
- `GET /api/events` – List all events  
- `POST /api/events` – Create a new event  
- `GET /api/events/{id}` – View a specific event  
- `PUT /api/events/{id}` – Update an event  
- `DELETE /api/events/{id}` – Delete an event  

#### Bookings
- `POST /api/events/{id}/bookings` – Create a booking for an event  
  - Validate that `seats_reserved` is a positive integer  
  - **Bonus**: Validate that the booking does not exceed a total seat limit (e.g., 100 seats)

---

## ✅ Expected Features
- Use of **Eloquent** models and migrations  
- Use of **Form Request** validation  
- Use of **API Resources** for response formatting  
- At least **two tests** (unit or feature)  
- Clean, **RESTful** code structure
---

### Local Setup
1. Copy `.env.example` to `.env` and configure your DB
2. Copy `./vendor/bin/sail up` build sail image and serve app
3. Run `./vendor/bin/sail php artisan key:generate`
4. Run `./vendor/bin/sail up php artisan optimize:clear`
5. Run migrations: `./vendor/bin/sail php artisan migrate`
---
## Application will run on 
http://localhost

## Pest for unit and feature testing
- Run `./vendor/bin/pest`