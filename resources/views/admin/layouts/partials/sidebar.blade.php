  <nav class="sidebar" id="adminSidebar">
      <div class="sidebar-inner">
          <!-- Brand -->
          <div class="sidebar-brand">
              <i class="bi bi-mortarboard-fill"></i>
              <span class="brand-text">CHTDB Admin</span>
          </div>

          <!-- Nav -->
          <ul class="nav flex-column flex-grow-1">
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                      href="{{ route('admin.dashboard') }}" data-label="Dashboard">
                      <i class="bi bi-speedometer2"></i>
                      <span class="link-text">Dashboard</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.centers*') ? 'active' : '' }}"
                      href="{{ route('admin.centers.index') }}" data-label="Centers">
                      <i class="bi bi-geo-alt"></i>
                      <span class="link-text">Centers</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.courses*') ? 'active' : '' }}"
                      href="{{ route('admin.courses.index') }}" data-label="Courses">
                      <i class="bi bi-book"></i>
                      <span class="link-text">Courses</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.batch*') ? 'active' : '' }}"
                      href="{{ route('admin.batch.index') }}" data-label="Batches">
                      <i class="bi bi-card-checklist"></i>
                      <span class="link-text">Batches</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a href="{{ route('admin.success-stories.index') }}"
                      class="nav-link {{ request()->routeIs('admin.success-stories.*') ? 'active' : '' }}"
                      data-label="Success Stories">
                      <i class="bi bi-chat-quote-fill nav-icon"></i>
                      <span class="link-text">Success Stories</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.gallery*') ? 'active' : '' }}"
                      href="{{ route('admin.gallery.index') }}" data-label="Gallery">
                      <i class="bi bi-images"></i>
                      <span class="link-text">Gallery</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.students*') ? 'active' : '' }}"
                      href="{{ route('admin.students.index') }}" data-label="Students">
                      <i class="bi bi-people"></i>
                      <span class="link-text">Students</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}"
                      href="{{ route('admin.settings.index') }}" data-label="Settings">
                      <i class="bi bi-gear-fill"></i>
                      <span class="link-text">Site Settings</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.messages*') ? 'active' : '' }}"
                      href="{{ route('admin.messages.index') }}" data-label="Messages">
                      <i class="bi bi-envelope-fill"></i>
                      <span class="link-text">Messages</span>
                      @php
                          $unreadMessages = \App\Models\ContactMessage::where('status', 'new')->count();
                      @endphp
                      @if ($unreadMessages > 0)
                          <span class="badge bg-danger rounded-pill ms-auto unread-badge">{{ $unreadMessages }}</span>
                      @endif
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.student-records*') ? 'active' : '' }}"
                      href="{{ route('admin.student_record') }}" data-label="Student Records">
                      <i class="bi bi-database"></i>
                      <span class="link-text">Student Records</span>
                  </a>
              </li>


              {{-- <li class="nav-item">
                  <a class="nav-link {{ request()->routeIs('admin.student-records*') ? 'active' : '' }}"
                      href="{{ route('admin.student-records.import.form') }}" data-label="Student Records Import">
                      <i class="bi bi-file-earmark-spreadsheet"></i>
                      <span class="link-text">Student Import</span>
                  </a>
              </li> --}}

              <!-- Logout at bottom -->
              <li class="nav-item mt-auto pt-3">
                  <form action="{{ route('admin.logout') }}" method="POST">
                      @csrf
                      <button type="submit" class="btn-logout" data-label="Logout">
                          <i class="bi bi-box-arrow-left"></i>
                          <span class="link-text">Logout</span>
                      </button>
                  </form>
              </li>
          </ul>
      </div>
  </nav>
