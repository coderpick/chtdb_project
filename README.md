# CHTDB ICT Skill Development Scheme - Laravel 13 Backend API

A comprehensive Laravel 13 RESTful API backend for the ICT Skill Development Scheme website. This API provides authentication, student profile management, training records, career tracking, portfolio building, and public content delivery for three hill districts: Rangamati, Khagrachhari, and Bandarban.

## Features

- **Authentication**: User registration, login, logout using Laravel Sanctum
- **Student Profiles**: Personal information, district, photo upload
- **Training Management**: Courses, batches, training centers, certificates, grades
- **Career Tracking**: Employment status, income, projects, business info
- **Portfolio System**: Custom slug, themes, public visibility
- **Project Management**: Create, update, delete student projects
- **Skills Management**: Add/remove skills, suggested skills
- **Social Links**: LinkedIn, GitHub, website, Facebook
- **Public API**: Courses, centers, testimonials, gallery, stats
- **Admin Ready**: Role-based access control (student/admin)

## Requirements

- PHP 8.3 or higher
- Composer 2.x
- Database: SQLite (dev) / MySQL 8.0+ / PostgreSQL
- Node.js & npm (optional, for frontend build)

## Quick Start

### 1. Installation

```bash
cd laravel-backend
composer install
```

### 2. Environment Configuration

Copy `.env.example` to `.env`:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

### 3. Database Setup

For **SQLite** (default, easiest for development):

```bash
touch database/database.sqlite
```

For **MySQL**:

Edit `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chtdb_ict
DB_USERNAME=root
DB_PASSWORD=
```

Create database:
```bash
mysql -u root -p -e "CREATE DATABASE chtdb_ict CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 4. Run Migrations and Seeders

```bash
php artisan migrate
php artisan db:seed
```

This will:
- Create all 14 tables
- Seed 8 courses (Web Dev, Graphic Design, Mobile App, Digital Marketing, etc.)
- Create 3 training centers (Rangamati, Khagrachhari, Bandarban)
- Create an admin user: `admin@chtdb.gov.bd` / `Admin@123456`
- Create a sample student: `student@example.com` / `password123`

### 5. Storage Link

```bash
php artisan storage:link
```

### 6. Start Development Server

```bash
php artisan serve
```

The API will be available at: **http://localhost:8000/api**

## API Documentation

### Base URL
```
http://localhost:8000/api
```

### Authentication Endpoints

#### Register
```http
POST /api/v1/auth/register
Content-Type: application/json

{
  "name": "Your Name",
  "email": "user@example.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "success": true,
  "message": "Registration successful",
  "data": {
    "user": { ... },
    "token": "1|abc123..."
  }
}
```

#### Login
```http
POST /api/v1/auth/login
Content-Type: application/json

{
  "email": "user@example.com",
  "password": "password123"
}
```

**Response:** Same as register

#### Logout
```http
POST /api/v1/auth/logout
Authorization: Bearer {token}
```

#### Get Current User
```http
GET /api/v1/auth/me
Authorization: Bearer {token}
```

### Student Endpoints (Authenticated)

All authenticated endpoints require header: `Authorization: Bearer {token}`

#### Profile
```
GET    /api/v1/profile          - Get profile
PUT    /api/v1/profile          - Update profile
POST   /api/v1/profile/photo    - Upload photo (multipart/form-data, field: photo)
DELETE /api/v1/profile/photo    - Delete photo
```

#### Training
```
GET    /api/v1/training              - Get training record
PUT    /api/v1/training              - Update training record
GET    /api/v1/training/courses      - List all active courses
GET    /api/v1/training/centers      - List all training centers
GET    /api/v1/training/batches      - List all batches (or /batches/{courseId})
```

#### Career
```
GET    /api/v1/career        - Get career info
PUT    /api/v1/career        - Update career info
```

#### Projects
```
GET    /api/v1/projects              - List projects
POST   /api/v1/projects              - Create project
GET    /api/v1/projects/{id}         - Get single project
PUT    /api/v1/projects/{id}         - Update project
DELETE /api/v1/projects/{id}         - Delete project
```

#### Skills
```
GET    /api/v1/skills               - Get user's skills
POST   /api/v1/skills               - Add skills { "skills": ["php", "laravel"] }
DELETE /api/v1/skills/{skillName}   - Remove skill
GET    /api/v1/skills/suggested     - Get all suggested/common skills
```

#### Social Links
```
GET    /api/v1/socials       - Get social links
PUT    /api/v1/socials       - Update social links
```

#### Portfolio
```
GET    /api/v1/portfolio/               - Get portfolio settings & data
PUT    /api/v1/portfolio/               - Update settings
GET    /api/v1/portfolio/check-slug?slug={slug} - Check slug availability
```

### Public Endpoints (No Auth)

#### Content
```
GET    /api/public/courses              - List all active courses
GET    /api/public/courses/{id|slug}    - Get single course
GET    /api/public/centers              - List all active training centers
GET    /api/public/testimonials         - List approved testimonials (filters: district, course_id, featured)
GET    /api/public/gallery              - List active gallery images
GET    /api/public/portfolio/{slug}     - Get public portfolio by slug
GET    /api/public/stats               - Get project statistics
```

## Data Models

### User
- `id`, `name`, `email`, `password`, `role` (student|admin), `created_at`, `updated_at`

### StudentProfile
- `user_id` (1:1), `phone`, `district` (rangamati|khagrachhari|bandarban), `upazila`, `dob`, `gender`, `nid`, `address`, `bio`, `photo`

### Training
- `user_id` (1:1), `course_id` (FK), `batch_id` (FK), `center_id` (FK), `status` (ongoing|completed), `start_date`, `end_date`, `certificate_no`, `grade`, `remarks`

### Career
- `user_id` (1:1), `status` (unemployed|job|freelance|entrepreneur|job_freelance), `income`, `company`, `designation`, `join_date`, `location`, `platform`, `profile_link`, `completed_projects`, `rating`, `business_name`, `business_type`, `employees`, `business_website`, `story`

### Project
- `user_id` (M:1), `name`, `type`, `description`, `link`, `github`, `technologies`

### Skill (Many-to-Many with User via pivot)
- `id`, `name` (unique)

### SocialLink
- `user_id` (1:1), `linkedin`, `github`, `website`, `facebook`

### PortfolioSetting
- `user_id` (1:1), `slug` (unique), `theme` (green|blue|purple|dark|teal), `is_visible` (boolean), `tagline`

### Course (Lookup, Admin Managed)
- `id`, `name`, `slug`, `description`, `icon` (Bootstrap icon), `color`, `duration_weeks`, `is_active`, `order`

### TrainingCenter
- `id`, `name`, `district`, `address`, `phone`, `email`, `is_active`

### Batch
- `id`, `course_id` (FK), `name`, `start_date`, `end_date`, `capacity`, `enrolled_count`, `status`

### Testimonial
- `user_id` (nullable FK), `name`, `district`, `course_id` (FK), `title`, `content`, `photo`, `job_title`, `company`, `is_featured`, `status` (pending|approved|rejected)

### Gallery
- `id`, `image_path`, `caption`, `category`, `sort_order`, `is_active`

## File Uploads

- Profile photos: `POST /api/v1/profile/photo` (multipart/form-data with `photo` field)
- Stored in: `storage/app/public/profile-photos`
- Accessible via: `storage/profile-photos/{filename}`
- Max size: 2MB, types: jpg, png, jpeg, gif

## CORS Configuration

The API is configured to accept requests from:
- `http://localhost:8000`
- `http://127.0.0.1:8000`
- `http://localhost:3000`
- `http://127.0.0.1:3000`

Edit `config/cors.php` to add production frontend domains.

## Frontend Integration

The provided frontend (`index.html`) currently uses localStorage. To integrate with this API:

1. Replace all `localStorage` calls with API requests
2. Store the auth token in localStorage (or better, use HttpOnly cookie)
3. Attach `Authorization: Bearer {token}` header to all authenticated requests
4. On app load, check for token; if exists, call `/api/v1/auth/me` to get user data
5. Handle 401 responses by redirecting to login

Example token storage:
```javascript
localStorage.setItem('cht_token', response.data.token);
```

Example API call:
```javascript
fetch('/api/v1/profile', {
  headers: {
    'Authorization': 'Bearer ' + localStorage.getItem('cht_token'),
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  }
})
```

## Admin Panel

Currently, admin features are accessible only through the API. To create admin users:

```bash
php artisan tinker
>>> App\Models\User::create(['name' => 'Admin Name', 'email' => 'admin@domain.com', 'password' => Hash::make('password'), 'role' => 'admin'])
```

Future: Build an admin frontend using the same API endpoints.

## Testing

```bash
# Start server
php artisan serve

# Access health check
curl http://localhost:8000/api/health

# Register a test user
curl -X POST http://localhost:8000/api/v1/auth/register \
  -H "Content-Type: application/json" \
  -d '{"name":"Test User","email":"test@test.com","password":"password123"}'

# Login
curl -X POST http://localhost:8000/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"student@example.com","password":"password123"}'
```

## Database Seeder Accounts

After running `php artisan db:seed`:

**Admin:**
- Email: `admin@chtdb.gov.bd`
- Password: `Admin@123456`
- Role: admin

**Sample Student:**
- Email: `student@example.com`
- Password: `password123`
- Role: student
- Pre-filled profile, training, career, skills, portfolio

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/
│   │   │   └── AuthController.php
│   │   ├── Api/
│   │   │   ├── V1/
│   │   │   │   ├── ProfileController.php
│   │   │   │   ├── TrainingController.php
│   │   │   │   ├── CareerController.php
│   │   │   │   ├── ProjectController.php
│   │   │   │   ├── SkillController.php
│   │   │   │   ├── SocialController.php
│   │   │   │   └── PortfolioController.php
│   │   │   └── PublicController.php
│   │   └── ...
│   ├── Requests/
│   │   ├── Auth/
│   │   │   ├── RegisterRequest.php
│   │   │   └── LoginRequest.php
│   │   ├── ProfileRequest.php
│   │   ├── TrainingRequest.php
│   │   ├── CareerRequest.php
│   │   ├── ProjectRequest.php
│   │   └── PortfolioSettingRequest.php
│   └── Resources/ (API Transformers)
├── Models/ (Eloquent Models)
└── ...

database/
├── migrations/ (15 migration files)
└── seeders/
    ├── CourseSeeder.php
    ├── CenterSeeder.php
    ├── SkillSeeder.php
    ├── AdminUserSeeder.php
    └── DatabaseSeeder.php

routes/
├── api.php (all API routes)
└── web.php
```

## Security Notes

1. Change the default admin password in production
2. Use environment variables for sensitive configuration
3. Enable HTTPS in production
4. Set `APP_DEBUG=false` in production
5. Implement rate limiting if needed (Laravel's throttle middleware)
6. Validate and sanitize all user inputs (already handled by FormRequests)
7. File uploads: validate MIME types, limit size, rename files to random names
8. Use HTTPS for all API calls in production

## Production Deployment

1. Set `APP_ENV=production`
2. Set `APP_DEBUG=false`
3. Configure proper database (MySQL/PostgreSQL recommended)
4. Run `php artisan migrate --force`
5. Run `php artisan db:seed --force`
6. Configure web server (nginx/Apache) to point to `public/` directory
7. Set proper file permissions: `storage/` and `bootstrap/cache/` writable
8. Configure CORS to allow only your frontend domain
9. Set up SSL certificate (HTTPS)
10. Configure queue worker if using async jobs (optional)
11. Set up backups for database

## Troubleshooting

**Migration errors:**
```bash
php artisan migrate:fresh --seed
```

**Token not working:**
- Ensure Sanctum is installed and configured
- Check `config/sanctum.php` stateful domains
- Clear config cache: `php artisan config:clear`

**CORS errors:**
- Check `config/cors.php` allowed origins
- Verify middleware is applied (in `bootstrap/app.php`)
- Clear cache: `php artisan optimize:clear`

**File upload failing:**
- Ensure `storage/app/public` is writable
- Run `php artisan storage:link`
- Check `php.ini` upload_max_filesize and post_max_size

## API Response Format

All endpoints return consistent JSON:

**Success:**
```json
{
  "success": true,
  "message": "Operation successful",
  "data": { ... }
}
```

**Error:**
```json
{
  "success": false,
  "message": "Error description",
  "errors": { ... } // validation errors
}
```

## Future Enhancements

- Email verification
- Password reset
- Two-factor authentication for admins
- PDF certificate generation
- Bulk student import (CSV)
- Advanced analytics dashboard
- Multi-language API responses
- Activity logging
- API rate limiting per user
- Queue-based email notifications

## License

This project is developed for Chittagong Hill Tracts Development Board (CHTDB) in collaboration with PeopleNTech.

## Support

For issues or questions, contact the development team.

---

**Developed with Laravel 13** | **API First Design**
