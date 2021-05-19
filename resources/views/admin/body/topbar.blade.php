<header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
      <!-- Sidebar toggle button -->
      <button id="sidebar-toggler" class="sidebar-toggle">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <!-- search form -->
      <div class="search-form d-none d-lg-inline-block">
        <div class="input-group">
          <button type="button" name="search" id="search-btn" class="btn btn-flat">
            <i class="mdi mdi-magnify"></i>
          </button>
          <input type="text" name="query" id="search-input" class="form-control" placeholder="Type your question here..."
            autofocus autocomplete="off" />
        </div>
        <div id="search-results-container">
          <ul id="search-results"></ul>
        </div>
      </div>

      <div class="navbar-right ">
        <ul class="nav navbar-nav">
          <!-- Github Link Button -->
          <li class="github-link mr-3">
            <a class="btn btn-outline-secondary btn-sm" href="https://github.com/hammadshahir" target="_blank">
              <span class="d-none d-md-inline-block mr-2">GitHub</span>
              <i class="mdi mdi-github-circle"></i>
            </a>

          </li>

          <!-- User Account -->
          <li class="dropdown user-menu">
            <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <img src="{{ Auth::user()->profile_photo_url }}" class="user-image" alt="User Image" />
              <span class="d-none d-lg-inline-block">Hallo {{ Auth::user()->name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <!-- User image -->
              <li class="dropdown-header">
                <img src="{{ Auth::user()->profile_photo_url }}" class="img-circle" alt="User Image" />
                <div class="d-inline-block">
                  {{ Auth::user()->name }} <small class="pt-1">{{ Auth::user()->email }}</small>
                </div>
              </li>

              <li>
                <a href="#">
                  <i class="mdi mdi-account"></i> My Profile
                </a>
              </li>
              <li>
                <a href="{{ route('messages') }}">
                  <i class="mdi mdi-email"></i> Messages
                </a>
              </li>
              <li>
                <a href="{{ route('change.password') }}"> <i class="mdi mdi-settings"></i> Change Password </a>
              </li>

              <li class="dropdown-footer">
                <a href="{{ route('user.logout') }}"> <i class="mdi mdi-logout"></i> Log Out </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>


  </header>
