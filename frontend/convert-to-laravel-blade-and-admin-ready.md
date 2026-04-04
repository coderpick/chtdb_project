# Conversion Plan: Static HTML to Laravel Blade + Admin Panel Ready

## Context

The project currently has:

- A static HTML frontend (`index.html`, 266KB) with embedded CSS and separate `style.css`
- A complete Laravel 13 backend with **API-only** architecture using Sanctum tokens
- A fully functional **admin panel** with web routes and Blade views (auth, dashboard, CRUD for courses, centers, testimonials, gallery, students)
- All database models, migrations, and seeders already in place

**Goal:** Convert the static HTML into Laravel Blade templates with server-side rendering (no API calls), and create a complete student frontend with authentication and dashboard. The admin panel is already ready and should remain unchanged.

---

## What Exists

### Backend (laravel-backend/)

- **Models**: User, StudentProfile, Training, Career, Project, Skill, SocialLink, PortfolioSetting, Course, TrainingCenter, Batch, Testimonial, Gallery, Setting
- **Admin Web Controllers & Views**: Fully working admin panel at `/admin` routes
- **API Controllers**: For student data (but we won't use them for frontend)
- **Routes**:
  - `web.php` - admin panel only
  - `api.php` - all student API endpoints
- **Database**: SQLite with seeders for courses, centers, skills, admin, sample student

### Frontend Assets

- `index.html` - complete single-page website (Bhojpuri/ Bengali content)
- `style.css` - 2150 lines of custom CSS
- `js/` - empty (inline scripts in HTML)
- `img/` - hero images, background images, and `gallary/` folder with 10 images

---

## What Needs to Be Built

### 1. Student Web Authentication (New)

**Problem**: Currently only API authentication exists (Sanctum tokens). Need session-based web auth.

**Solution**: Create new web controllers for student authentication:

- `StudentAuthController` (in `app/Http/Controllers/Auth/` for web, separate from API AuthController)
  - `showLoginForm()` - return view `auth.login`
  - `login(Request $request)` - validate, Auth::attempt via 'web' guard, redirect to dashboard
  - `showRegisterForm()` - return view `auth.register`
  - `register(RegisterRequest)` - create user with role='student', create empty related records, login, redirect to dashboard
  - `logout(Request $request)` - Auth::logout, invalidate session, redirect to home
- Use Laravel's built-in `Auth` facade with `web` guard
- Middleware: `guest:student` for login/register pages, `auth` for dashboard (but check role)

### 2. Home/Landing Page (Convert index.html)

**Convert** `index.html` into `resources/views/home.blade.php` with:

**Layout**: Use a new master layout `resources/views/layouts/app.blade.php` that includes:

- Navbar (partial `partials/navbar.blade.php`) - dynamic: show login/register or user dropdown
- Footer (partial `partials/footer.blade.php`)
- CSS: Integrate `style.css` into `public/` or use Vite
- JS: Keep inline scripts OR create `resources/js/home.js`

**Dynamic Data** (replace hardcoded):

- Courses section: `@foreach($courses as $course)` - use Course model, show icon/color from DB
- Testimonials: `@foreach($testimonials as $testimonial)` - only approved, maybe featured first
- Gallery: `@foreach($galleryItems as $item)` - active items
- Training Centers: `@foreach($centers as $center)` - Rangamati, Khagrachhari, Bandarban
- Stats: `$stats` from Setting model or hard-coded (could be from DB)
- Hero stats numbers: could be from database counts (students, courses, centers, placement %)

**Assets**:

- Move `img/` folder to `public/` or `storage/app/public/` and create symlink
- Update image references: `<img src="{{ asset('img/hero_image.jpg') }}" alt="...">`
- Enqueue Bootstrap/Bootstrap Icons/Google Fonts/Animate.css as in original (CDN is fine)
- Keep `marquee` and `particles` - they use pure HTML/CSS/JS (inline)

### 3. Student Dashboard (New)

**Create**: `StudentDashboardController` with `index()` method

**View**: `resources/views/student/dashboard.blade.php`

**Layout**: Use `resources/views/layouts/student.blade.php` (sidebar + content area)

**Data needed** (from `Auth::user()` eager loaded):

- Profile: name, email, phone, district, photo
- Training: course, batch, center, status, grade
- Career: job_title, company, job_type, started_year, salary_range, is_working
- Projects: collection with title, description, technologies, link, github, image
- Skills: array of skill names
- SocialLinks: LinkedIn, GitHub, Facebook, website
- PortfolioSettings: slug, theme, tagline, is_visible

**Dashboard UI**:
Use Bootstrap cards with sidebar navigation (tabs) to show/edit:

- Overview (summary of all data)
- Profile (edit form)
- Training (edit form - select course, batch, center)
- Career (edit form)
- Projects (list with edit/delete buttons, add new button)
- Skills (multi-select or tags input)
- Social Links (form with fields for each platform)
- Portfolio Settings (edit slug, tagline, theme, visibility)

**Forms**: POST/PUT to routes like:

- `/dashboard/profile` (update)
- `/dashboard/training` (update)
- `/dashboard/career` (update)
- `/dashboard/projects` (store)
- `/dashboard/projects/{id}` (update, destroy)
- `/dashboard/skills` (store, destroy)
- `/dashboard/socials` (update)
- `/dashboard/portfolio` (update)

### 4. Student Profile Editing (in Dashboard)

**Form fields**:

- Name, email (readonly after registration?), phone, district (dropdown), address, bio
- Photo upload (store in `storage/app/public/profile-photos`, use `Storage::url()`)
- Update `StudentProfile` model

### 5. Training Edit Form

**Fields** (in Training model):

- Course_id (dropdown from Course::all())
- Batch_id (dropdown filtered by course? or all)
- Training center_id (dropdown from TrainingCenter::all())
- Status (dropdown: ongoing, completed, certified)
- Grade (text or number)
- Started date, completed date

### 6. Career Edit Form

**Fields** (in Career model):

- Job title, company, job type (dropdown: job, freelance, entrepreneur)
- Is currently working (checkbox)
- Started year, end year (if not working)
- Salary range (dropdown)
- Description

### 7. Projects CRUD (in Dashboard)

**Model**: Project (belongs to user)
**Fields**: title, description, technologies (comma-separated or JSON), project_url, github_url, image (upload), order, is_featured
**Create simple CRUD** with modal or separate page

### 8. Skills Management

**Model**: Skill (pivot `skill_user`)
**Approach**: Simple tag system

- Show current skills as pills with delete button
- Input field to add new skill (autocomplete from suggested skills)
- Save to pivot table

### 9. Social Links

**Model**: SocialLink (belongs to user, one row per user)
**Fields**: linkedin, github, facebook, twitter, website, phone

- Single form to update all fields

### 10. Portfolio Settings

**Model**: PortfolioSetting (belongs to user)
**Fields**:

- slug (unique, for public URL `/portfolio/{slug}`)
- theme (color picker or presets)
- tagline (text)
- is_visible (checkbox)
- Show preview of public portfolio

### 11. Public Portfolio Page

**Route**: `GET /portfolio/{slug}`
**Controller**: `PublicPortfolioController@show($slug)`
**Logic**: Find user by portfolio_setting.slug, check is_visible, load user's public data (profile, training, career, projects, skills, socials)
**View**: `public/portfolio/show.blade.php` - a clean, minimal design showcasing the student's work

### 12. Routes to Add (in `routes/web.php`)

```php
// Student Authentication (Web)
Route::prefix('student')->name('student.')->group(function () {
    Route::middleware('guest:student')->group(function () {
        Route::get('login', [StudentAuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [StudentAuthController::class, 'login']);
        Route::get('register', [StudentAuthController::class, 'showRegisterForm'])->name('register');
        Route::post('register', [StudentAuthController::class, 'register']);
    });
    Route::middleware('auth')->group(function () {
        Route::post('logout', [StudentAuthController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::get('profile', [StudentProfileController::class, 'edit'])->name('profile.edit');
            Route::put('profile', [StudentProfileController::class, 'update'])->name('profile.update');
            Route::post('profile/photo', [StudentProfileController::class, 'uploadPhoto'])->name('profile.photo');

            // Training
            Route::get('training', [StudentTrainingController::class, 'edit'])->name('training.edit');
            Route::put('training', [StudentTrainingController::class, 'update'])->name('training.update');

            // Career
            Route::get('career', [StudentCareerController::class, 'edit'])->name('career.edit');
            Route::put('career', [StudentCareerController::class, 'update'])->name('career.update');

            // Projects
            Route::resource('projects', StudentProjectController::class);

            // Skills
            Route::get('skills', [StudentSkillController::class, 'edit'])->name('skills.edit');
            Route::post('skills', [StudentSkillController::class, 'store'])->name('skills.store');
            Route::delete('skills/{skillName}', [StudentSkillController::class, 'destroy'])->name('skills.destroy');

            // Social Links
            Route::get('socials', [StudentSocialController::class, 'edit'])->name('socials.edit');
            Route::put('socials', [StudentSocialController::class, 'update'])->name('socials.update');

            // Portfolio Settings
            Route::get('portfolio', [StudentPortfolioController::class, 'edit'])->name('portfolio.edit');
            Route::put('portfolio', [StudentPortfolioController::class, 'update'])->name('portfolio.update');
        });
    });
});

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/courses', [HomeController::class, 'courses'])->name('courses'); // maybe redundant
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::resource('portfolio', PublicPortfolioController::class)->only(['show'])->names('portfolio.public');
```

### 13. CSS & Assets Integration

- Copy `style.css` into `public/css/` OR use Vite: put in `resources/css/app.css`
- If using Vite, add `@vite(['resources/css/app.css', 'resources/js/app.js'])` in layouts
- Keep Bootstrap/Bootstrap Icons from CDN as original (simpler) OR install via npm
- Move `img/` directory to `public/img/`
- Create `storage/app/public/profile-photos` and symlink: `php artisan storage:link`

### 14. Database Considerations

- Current DB uses SQLite at `database/database.sqlite`
- Ensure file exists and is writable
- Run migrations and seeders:
  ```
  php artisan migrate
  php artisan db:seed
  ```
- Seeders already exist: CourseSeeder, CenterSeeder, SkillSeeder, AdminUserSeeder

---

## Implementation Order (Phases)

### Phase 1: Setup & Basic Structure

1. Move `style.css` to `public/css/style.css` (keep original filename)
2. Keep `img/` folder at `public/img/` (already there, just ensure it's in Laravel's public path)
3. Rename existing `index.html` to something like `index-backup.html` for reference
4. Create `resources/views/layouts/app.blade.php` master layout
5. Create `resources/views/partials/navbar.blade.php` with exact navbar from index.html (copy <nav> section) but make auth-aware
6. Create `resources/views/partials/footer.blade.php` (copy footer from index.html)
7. Ensure route for home exists: `Route::get('/', [HomeController::class, 'index'])->name('home');`

### Phase 2: Home/Landing Page

1. Create `HomeController@index()`:
   ```php
   $courses = Course::where('is_active', true)->orderBy('order')->get();
   $testimonials = Testimonial::where('is_approved', true)->orderBy('created_at', 'desc')->take(6)->get();
   $galleryItems = Gallery::where('is_active', true)->orderBy('sort_order')->take(8)->get();
   $centers = TrainingCenter::where('is_active', true)->get();
   $stats = [
       'students' => User::where('role', 'student')->count(),
       'courses' => $courses->count(),
       'centers' => $centers->count(),
       'testimonials' => $testimonials->count(),
   ];
   return view('home', compact('courses', 'testimonials', 'galleryItems', 'centers', 'stats'));
   ```
2. Convert `index.html` to `home.blade.php`:
   - Replace static course data with loop
   - Replace testimonials with loop + minicard component
   - Replace gallery images with dynamic
   - Replace centers with loop
   - Use `asset()` for images
   - Add `@stack('styles')` in head if needed
   - Keep JS inline or move to `home.js`
   - Preserve all animations (marquee, particles, counters)
   - Ensure navbar links to `#about`, `#courses`, etc. (anchor links on same page)

### Phase 3: Student Authentication (Web)

1. Create `StudentAuthController` (web, not API)
2. Add routes (see above) with `guest:student` and `auth` middleware
3. Create `resources/views/auth/login.blade.php` (simple form with email/password)
4. Create `resources/views/auth/register.blade.php` (name, email, password, confirm password)
5. Use Bootstrap forms, match design language of index.html
6. In controller, after login: redirect to `route('student.dashboard')`
7. After logout: redirect to `route('home')`
8. Add middleware to check role: create `IsStudent` middleware or use closure: `->middleware(function ($request, $next) { if (auth()->user()->role !== 'student') abort(403); return $next($request); })`

### Phase 4: Student Dashboard Layout

1. Create `resources/views/layouts/student.blade.php`:
   - Sidebar with navigation (Profile, Training, Career, Projects, Skills, Social, Portfolio)
   - Header with user name, logout button
   - Main content area `@yield('content')`
   - Use Bootstrap grid: sidebar (col-md-3) + main (col-md-9)
2. Add CSS for sidebar active states, transitions
3. Create a simple welcome section in dashboard index showing summary cards

### Phase 5: Dashboard Controllers & Views (All Student Modules)

For each module:

1. **ProfileController**:
   - `edit()`: return user's profile
   - `update()`: validate, update `StudentProfile`, redirect back with success
   - `uploadPhoto()`: validate image, store in `profile-photos`, update profile, return JSON for AJAX or redirect
   - View: `student/profile/edit.blade.php` with form: name (readonly?), email (readonly?), phone, district (select: Rangamati, Khagrachhari, Bandarban), address, bio, photo upload preview

2. **TrainingController**:
   - `edit()`: load user->training with course, batch, center; pass all courses, batches, centers
   - `update()`: validate, update training record
   - View: selects for course, batch (maybe dynamic with JS), center, status, dates, grade

3. **CareerController**:
   - `edit()`, `update()`: simple form with fields from Career model
   - Fields: job_title, company, job_type (radio: job/freelance/entrepreneur), is_working (checkbox), start_year, end_year, salary_range (select: 10k-20k, etc), description

4. **ProjectController** (Resource):
   - `index()`: list user's projects (in dashboard layout)
   - `create()`, `store()`: form + save (with image upload)
   - `edit()`, `update()`: edit existing
   - `destroy()`: delete
   - Use modal or separate pages
   - Fields: title, description, technologies (text input, comma-separated), project_url, github_url, image upload, is_featured, order

5. **SkillController**:
   - `edit()`: show current skills (from $user->skills) and a list of suggested skills (from Skill model where not already user's)
   - `store()`: add skill to user (attach)
   - `destroy($skillName)`: detach skill
   - View: pills for current skills with × button, plus input with autocomplete

6. **SocialController**:
   - `edit()`, `update()`: one form with fields for linkedin, github, facebook, twitter, website, phone
   - Update `SocialLink` model (create if not exists)

7. **PortfolioController**:
   - `edit()`, `update()`: fields: slug (unique check), tagline, theme (color presets), is_visible
   - On update, ensure slug uniqueness (use similar logic as API controller)

### Phase 6: Public Portfolio Page

1. `PublicPortfolioController@show($slug)`:
   - Find user by `PortfolioSetting.where('slug', $slug)->first()?->user`
   - If not found or not visible, 404
   - Load user's profile, training (with course, center), career, projects (active/featured), skills, socials
   - Return view `public/portfolio/show.blade.php` (minimal, clean, portfolio-focused design)
2. Routes: `Route::get('/portfolio/{slug}', [PublicPortfolioController::class, 'show'])->name('portfolio.public.show');`

### Phase 7: Polish & Integration

1. **Navbar Updates**:
   - When student logged in: show dropdown with Dashboard, Profile, Portfolio URL, Logout
   - When guest: show Login, Register buttons
   - Use `Auth::check()` and `Auth::user()->role`
2. **Flash Messages**: Add session flash on all updates (success/error)
3. **Error Handling**: Validate all forms, show errors in Blade (old input)
4. **Image Uploads**:
   - Profile photos: store in `storage/app/public/profile-photos`
   - Project images: store in `storage/app/public/project-images`
   - Use `Storage::disk('public')->url('path/to/file')`
5. **CSS Integration**:
   - Move `style.css` to `public/css/style.css` (keep original filename)
   - Keep Bootstrap/Bootstrap Icons from CDN as in original
   - Keep Google Fonts (Noto Sans Bengali) as CDN
6. **Dashboard Layout**: Use separate pages (not tabs) with sidebar navigation
   - Each module gets its own route/view (profile/edit, training/edit, projects/\*, etc.)
   - Student layout with fixed sidebar and scrollable content area
7. **Responsive Design**: Ensure dashboard works on mobile (Bootstrap helps)
8. **Dark Mode**: Not required, but original has dark mode CSS - can ignore or keep

### Phase 8: Testing

1. Start server: `php artisan serve`
2. Test student registration (web)
3. Test student login/logout
4. Test each dashboard module (CRUD operations)
5. Test public portfolio page (view as logged-out)
6. Verify admin panel still works at `/admin`
7. Check image uploads work
8. Test validation errors
9. Test slug uniqueness for portfolio

---

## Technical Decisions

- **No API for frontend**: Use server-side rendering with Blade, direct model queries in controllers
- **Authentication**: Session-based (Laravel's `web` guard) for student frontend; keep admin as-is (already session-based)
- **Middleware**:
  - Student routes: `auth` + role check (custom middleware `IsStudent` or closure)
  - Admin routes: already `auth` + `admin` middleware
- **Authorization**: Simple role check; admin middleware already checks `auth()->user()->isAdmin()` (assume exists)
- **File Uploads**: Use Laravel's Storage facade, store in `storage/app/public/`, accessible via `/storage/` symlink
- **CSS Framework**: Continue using Bootstrap 5 (already in use) and custom `style.css`
- **Icons**: Bootstrap Icons (CDN or npm)
- **Fonts**: Google Fonts (Noto Sans Bengali) as in original
- **JavaScript**: Minimal; mostly inline for interactions (navbar, marquee, particles). Dashboard forms use normal POST.

---

## Files to Create

### Controllers (8+)

- `app/Http/Controllers/Auth/StudentAuthController.php`
- `app/Http/Controllers/HomeController.php`
- `app/Http/Controllers/Student/StudentDashboardController.php`
- `app/Http/Controllers/Student/StudentProfileController.php`
- `app/Http/Controllers/Student/StudentTrainingController.php`
- `app/Http/Controllers/Student/StudentCareerController.php`
- `app/Http/Controllers/Student/StudentProjectController.php`
- `app/Http/Controllers/Student/StudentSkillController.php`
- `app/Http/Controllers/Student/StudentSocialController.php`
- `app/Http/Controllers/Student/StudentPortfolioController.php`
- `app/Http/Controllers/PublicPortfolioController.php`

### Views (15+)

- `resources/views/layouts/app.blade.php`
- `resources/views/layouts/student.blade.php`
- `resources/views/partials/navbar.blade.php`
- `resources/views/partials/footer.blade.php`
- `resources/views/home.blade.php`
- `resources/views/auth/login.blade.php`
- `resources/views/auth/register.blade.php`
- `resources/views/student/dashboard.blade.php`
- `resources/views/student/profile/edit.blade.php`
- `resources/views/student/training/edit.blade.php`
- `resources/views/student/career/edit.blade.php`
- `resources/views/student/projects/index.blade.php`
- `resources/views/student/projects/create.blade.php`
- `resources/views/student/projects/edit.blade.php`
- `resources/views/student/skills/edit.blade.php`
- `resources/views/student/socials/edit.blade.php`
- `resources/views/student/portfolio/edit.blade.php`
- `resources/views/public/portfolio/show.blade.php`

### Routes (modify)

- `routes/web.php` - add student routes and public routes

### Middleware (optional)

- `app/Http/Middleware/IsStudent.php` (or use closure in routes)

### Assets

- Move `style.css` → `public/css/style.css` OR `resources/css/app.css`
- Move `img/` → `public/img/`
- Create `public/js/home.js` if extracting inline JS

---

## Verification Checklist

After implementation:

- [ ] Home page loads with dynamic courses, testimonials, gallery, centers, stats
- [ ] Images (hero, gallery, backgrounds) display correctly
- [ ] Student registration works (form, validation, account creation)
- [ ] Student login works (session created, redirect to dashboard)
- [ ] Dashboard loads with user data (profile, training, career, projects, skills, socials, portfolio)
- [ ] Profile edit form saves (including photo upload)
- [ ] Training edit saves (course/batch/center selection)
- [ ] Career edit saves
- [ ] Projects: create, edit, delete works
- [ ] Skills: add and remove works
- [ ] Socials: update works
- [ ] Portfolio settings: update slug and visibility works
- [ ] Public portfolio page accessible at `/portfolio/{slug}` shows correct data
- [ ] Logout clears session and redirects to home
- [ ] Navbar shows correct menu based on auth state
- [ ] Admin panel still accessible at `/admin` and works
- [ ] All responsive breakpoints work (mobile, tablet, desktop)
- [ ] No 404s for assets (CSS, JS, images)

---

## Risks & Mitigations

| Risk                                      | Mitigation                                                                                                                 |
| ----------------------------------------- | -------------------------------------------------------------------------------------------------------------------------- |
| Auth conflicts between web and API guards | Use separate guards: 'web' for sessions, 'sanctum' for API. StudentAuthController will explicitly use `Auth::guard('web')` |
| Role-based access bypass                  | Add middleware to check role for all student routes                                                                        |
| Image uploads fail (permissions)          | Ensure `storage/app/public/` and `public/storage/` symlink exists and are writable                                         |
| Large number of views to create           | Use consistent base layout and partials to avoid duplication                                                               |
| CSS conflicts (original CSS global)       | Scope CSS where possible, or keep as-is since it's a full-page site                                                        |
| Performance (N+1 queries)                 | Use eager loading in controllers: `$user->load(['profile', 'training.course', ...])`                                       |
| Public portfolio visibility               | Check `is_visible` flag before showing                                                                                     |

---

## Notes

- Admin panel is **already ready**, no changes needed
- API system exists but we are **not using it** for frontend (server-side rendering only)
- Database is ready with all tables and relationships
- Seeders provide sample data: 8 courses, 3 centers, skills, admin, sample student
- The frontend is in Bengali (Bangla) - maintain all text from index.html

---

This plan transforms the static HTML into a fully functional, database-driven Laravel application with student self-service portal and ready admin panel.
