# Frontend Integration Guide

## Overview

Your current frontend (`index.html`) uses `localStorage` to store student data. This guide explains how to replace localStorage with API calls to the Laravel backend.

## Backend Status

✅ **Laravel 13 API is fully built and ready**

- Location: `/laravel-backend`
- Server: `php artisan serve` → http://localhost:8000
- API Base URL: http://localhost:8000/api
- Database: SQLite (./database/database.sqlite) - already seeded with test data
- Sanctum authentication configured
- CORS enabled for localhost:8000 and localhost:3000

### Test Accounts

**Admin:**
- Email: `admin@chtdb.gov.bd`
- Password: `Admin@123456`

**Sample Student:**
- Email: `student@example.com`
- Password: `password123`

---

## Integration Steps

### Step 1: Update API Base URL in Frontend

In `index.html`, find the JavaScript section and add:

```javascript
const API_BASE_URL = 'http://localhost:8000/api';
let authToken = localStorage.getItem('cht_token') || '';
```

### Step 2: Create API Helper Functions

Replace the localStorage-based functions with API calls. Here are the key changes:

#### Current (localStorage):
```javascript
function handleLogin(e) {
    e.preventDefault();
    const email = document.getElementById('loginEmail').value.trim();
    const pass = document.getElementById('loginPassword').value;
    const stored = JSON.parse(localStorage.getItem('chtUser'));
    if (stored && stored.email === email && stored.password === pass) {
        currentUser = stored;
        // ... load from localStorage
    }
}
```

#### New (API):
```javascript
async function handleLogin(e) {
    e.preventDefault();
    const email = document.getElementById('loginEmail').value.trim();
    const password = document.getElementById('loginPassword').value;

    try {
        const response = await fetch(`${API_BASE_URL}/v1/auth/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ email, password })
        });

        const data = await response.json();

        if (data.success) {
            // Store token
            authToken = data.data.token;
            localStorage.setItem('cht_token', authToken);

            // Store user data (optional, for quick access)
            currentUser = data.data.user;
            userProfile = data.data.profile || {};
            userTraining = data.data.training || {};
            userCareer = data.data.career || {};
            userProjects = data.data.projects || [];
            userSkills = data.data.skills || [];
            userSocials = data.data.socials || {};
            portfolioSettings = data.data.portfolio_settings || { slug: '', theme: 'green', visible: true, tagline: '' };

            // Save to localStorage as backup
            localStorage.setItem('chtUser', JSON.stringify(currentUser));
            localStorage.setItem('chtProfile', JSON.stringify(userProfile));
            localStorage.setItem('chtTraining', JSON.stringify(userTraining));
            localStorage.setItem('chtCareer', JSON.stringify(userCareer));
            localStorage.setItem('chtProjects', JSON.stringify(userProjects));
            localStorage.setItem('chtSkills', JSON.stringify(userSkills));
            localStorage.setItem('chtSocials', JSON.stringify(userSocials));
            localStorage.setItem('chtPortfolioSettings', JSON.stringify(portfolioSettings));

            bootstrap.Modal.getInstance(document.getElementById('loginModal')).hide();
            updateAuthUI(true);
            showToast('লগইন সফল!', 'স্বাগতম, ' + currentUser.name + '!');
        } else {
            alert('ইমেইল বা পাসওয়ার্ড ভুল!');
        }
    } catch (error) {
        console.error('Login error:', error);
        alert('লগইনে সমস্যা হয়েছে। আবার চেষ্টা করুন।');
    }
}
```

### Step 3: Replace All CRUD Operations

**Profile Save:**
```javascript
async function saveProfile(e) {
    e.preventDefault();
    const token = localStorage.getItem('cht_token');

    const formData = {
        name: document.getElementById('profileName').value,
        email: document.getElementById('profileEmail').value,
        phone: document.getElementById('profilePhone').value,
        district: document.getElementById('profileDistrict').value,
        upazila: document.getElementById('profileUpazila').value,
        dob: document.getElementById('profileDob').value,
        gender: document.getElementById('profileGender').value,
        nid: document.getElementById('profileNid').value,
        address: document.getElementById('profileAddress').value,
        bio: document.getElementById('profileBio').value,
    };

    try {
        const response = await fetch(`${API_BASE_URL}/v1/profile`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();
        if (data.success) {
            // Update local storage with new data
            currentUser = data.data.user;
            userProfile = data.data.profile;
            localStorage.setItem('chtUser', JSON.stringify(currentUser));
            localStorage.setItem('chtProfile', JSON.stringify(userProfile));
            updateAuthUI(true);
            loadDashboardData();
            showToast('প্রোফাইল সেভ হয়েছে!', 'আপনার প্রোফাইল তথ্য আপডেট করা হয়েছে।');
        }
    } catch (error) {
        console.error('Profile save error:', error);
    }
}
```

**Photo Upload:**
```javascript
async function uploadProfilePhoto(input) {
    const file = input.files[0];
    if (!file) return;

    const token = localStorage.getItem('cht_token');
    const formData = new FormData();
    formData.append('photo', file);

    try {
        const response = await fetch(`${API_BASE_URL}/v1/profile/photo`, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: formData
        });

        const data = await response.json();
        if (data.success) {
            userProfile.photo = data.data.profile.photo;
            localStorage.setItem('chtProfile', JSON.stringify(userProfile));
            loadDashboardData();
            showToast('ফটো আপলোড হয়েছে!', 'আপনার প্রোফাইল ফটো আপডেট করা হয়েছে।');
        }
    } catch (error) {
        console.error('Photo upload error:', error);
    }
}
```

**Training Save:**
```javascript
async function saveTraining(e) {
    e.preventDefault();
    const token = localStorage.getItem('cht_token');

    const formData = {
        course_id: document.getElementById('trainingCourse').value || null,
        batch_id: document.getElementById('trainingBatch').value || null,
        center_id: document.getElementById('trainingCenter').value || null,
        status: document.getElementById('trainingStatus').value,
        start_date: document.getElementById('trainingStartDate').value || null,
        end_date: document.getElementById('trainingEndDate').value || null,
        certificate_no: document.getElementById('trainingCertNo').value,
        grade: document.getElementById('trainingGrade').value,
        remarks: document.getElementById('trainingRemarks').value,
    };

    try {
        const response = await fetch(`${API_BASE_URL}/v1/training`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();
        if (data.success) {
            userTraining = data.data;
            localStorage.setItem('chtTraining', JSON.stringify(userTraining));
            loadDashboardData();
            showToast('প্রশিক্ষণ তথ্য সেভ হয়েছে!', '');
        }
    } catch (error) {
        console.error('Training save error:', error);
    }
}
```

**Projects CRUD:**

- **Create:** `POST /api/v1/projects` with project data
- **Read:** `GET /api/v1/projects`
- **Update:** `PUT /api/v1/projects/{id}`
- **Delete:** `DELETE /api/v1/projects/{id}`

**Skills:**

- **Get skills:** `GET /api/v1/skills`
- **Add skills:** `POST /api/v1/skills` with `{ "skills": ["skill1", "skill2"] }`
- **Remove skill:** `DELETE /api/v1/skills/{skillName}`
- **Get suggested:** `GET /api/v1/skills/suggested`

**Social Links:**
```javascript
// Update all at once
PUT /api/v1/socials
{
  "linkedin": "https://linkedin.com/...",
  "github": "https://github.com/...",
  "website": "https://...",
  "facebook": "https://facebook.com/..."
}
```

**Portfolio Settings:**
```javascript
// Get settings
GET /api/v1/portfolio

// Update settings
PUT /api/v1/portfolio
{
  "slug": "unique-username",
  "theme": "green",
  "is_visible": true,
  "tagline": "My tagline"
}

// Check slug availability
GET /api/v1/portfolio/check-slug?slug=desired-username
```

**Career:**
```javascript
GET /api/v1/career
PUT /api/v1/career
{
  "status": "job",
  "income": 25000,
  "company": "...",
  ...
}
```

**Public Portfolio:**
The frontend currently uses localStorage to build public portfolio. Replace with:
```javascript
// When user clicks "View Public Portfolio"
fetch(`${API_BASE_URL}/public/portfolio/${portfolioSettings.slug}`)
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      const portfolio = data.data;
      // Render portfolio page with portfolio data
    }
  });
```

### Step 4: Handle Logout

```javascript
async function logoutUser() {
    const token = localStorage.getItem('cht_token');

    try {
        await fetch(`${API_BASE_URL}/v1/auth/logout`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });
    } catch (error) {
        console.log('Logout error (ignoring):', error);
    }

    // Clear local storage
    localStorage.removeItem('cht_token');
    localStorage.removeItem('chtUser');
    localStorage.removeItem('chtProfile');
    localStorage.removeItem('chtTraining');
    localStorage.removeItem('chtCareer');
    localStorage.removeItem('chtProjects');
    localStorage.removeItem('chtSkills');
    localStorage.removeItem('chtSocials');
    localStorage.removeItem('chtPortfolioSettings');

    currentUser = null;
    userProfile = {};
    userTraining = {};
    userCareer = {};
    userProjects = [];
    userSkills = [];
    userSocials = {};
    portfolioSettings = { slug: '', theme: 'green', visible: true, tagline: '' };

    updateAuthUI(false);
    goBackToHome();
    showToast('লগআউট সফল!', 'আপনি সফলভাবে লগআউট করেছেন।');
}
```

### Step 5: Auto-login on Page Load

At the end of your JavaScript initialization:

```javascript
// Check for token on page load
document.addEventListener('DOMContentLoaded', async () => {
    const token = localStorage.getItem('cht_token');
    if (token) {
        try {
            const response = await fetch(`${API_BASE_URL}/v1/auth/me`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();
            if (data.success) {
                currentUser = data.data.user;
                userProfile = data.data.profile || {};
                userTraining = data.data.training || {};
                userCareer = data.data.career || {};
                userProjects = data.data.projects || [];
                userSkills = data.data.skills || [];
                userSocials = data.data.socials || {};
                portfolioSettings = data.data.portfolio_settings || { slug: '', theme: 'green', visible: true, tagline: '' };
                updateAuthUI(true);
            } else {
                // Invalid token, clear it
                localStorage.removeItem('cht_token');
            }
        } catch (error) {
            console.error('Auth check error:', error);
        }
    }

    // Rest of your existing initialization code...
    loadDashboardData();
});
```

---

## Key Endpoints Reference

### Authentication
- `POST /api/v1/auth/register` - Register new user
- `POST /api/v1/auth/login` - Login
- `POST /api/v1/auth/logout` - Logout (requires token)
- `GET /api/v1/auth/me` - Get current user (requires token)

### Student Data (all require token)
- `GET /api/v1/profile` - Get profile
- `PUT /api/v1/profile` - Update profile
- `POST /api/v1/profile/photo` - Upload photo
- `GET /api/v1/training` - Get training info
- `PUT /api/v1/training` - Update training
- `GET /api/v1/training/courses` - Get all courses (dropdown)
- `GET /api/v1/training/centers` - Get all centers (dropdown)
- `GET /api/v1/career` - Get career info
- `PUT /api/v1/career` - Update career
- `GET /api/v1/projects` - List projects
- `POST /api/v1/projects` - Add project
- `PUT /api/v1/projects/{id}` - Update project
- `DELETE /api/v1/projects/{id}` - Delete project
- `GET /api/v1/skills` - Get user's skills
- `POST /api/v1/skills` - Add skills (array)
- `DELETE /api/v1/skills/{name}` - Remove skill
- `GET /api/v1/skills/suggested` - Get all available skills
- `GET /api/v1/socials` - Get social links
- `PUT /api/v1/socials` - Update social links
- `GET /api/v1/portfolio` - Get portfolio settings + data
- `PUT /api/v1/portfolio` - Update settings
- `GET /api/v1/portfolio/check-slug?slug={slug}` - Check slug availability

### Public Content (no token required)
- `GET /api/public/courses` - All courses
- `GET /api/public/centers` - All centers
- `GET /api/public/testimonials` - Approved testimonials
- `GET /api/public/gallery` - Gallery images
- `GET /api/public/portfolio/{slug}` - Public portfolio
- `GET /api/public/stats` - Statistics

---

## Testing

1. Start Laravel backend:
```bash
cd laravel-backend
php artisan serve
```

2. Test health endpoint:
```bash
curl http://localhost:8000/api/health
# Should return: {"status":"ok","timestamp":"2026-04-01T..."}
```

3. Login with sample student:
```bash
curl -X POST http://localhost:8000/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"student@example.com","password":"password123"}'
```

4. Use the returned token to test authenticated endpoints.

---

## Notes

- All dates in responses are ISO 8601 format (YYYY-MM-DD)
- Profile photos are accessible via `storage/profile-photos/{filename}`
- Skills are stored as many-to-many; you can add any custom skill
- Portfolio slug must be unique across all users (use check-slug endpoint)
- All PUT/POST requests return updated resource in response
- The frontend currently uses Bengali language; API error messages are in English but data is language-agnostic

---

## Next Steps

1. Update all localStorage calls in `index.html` with the API patterns above
2. Handle token expiration (401 responses) by redirecting to login
3. Add loading indicators during API calls
4. Implement proper error handling with user-friendly Bengali messages
5. Test all features thoroughly
6. For production, update CORS settings to allow only your frontend domain
7. Change default admin password immediately

---

**Backend is ready! Start the server and begin integration.**
