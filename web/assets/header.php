<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Toggle button -->
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
    </button>
    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <img
          src="http://localhost/lms/web/assets/img/logo.svg"
          height="30"
          alt=""
          loading="lazy"
        />
      </a>
      <!-- Left links -->
    </div>
    <!-- Right elements -->
    <div class="d-flex align-items-right">
      <!-- Avatar -->
      <li class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle"
          href="#"
          id="navbarDropdownMenuLink"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          <img
            src="http://localhost/lms/web/assets/img/user.jpg"
            class="rounded-circle"
            height="40"
            alt=""
            loading="lazy"
          />
        </a>
        <div class="dropdown-menu align-items-left" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#" onclick="showMyInfoDetail()">My profile</a>
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#" onclick="showLoginPage()">Logout</a>
        </div>
      </li>
    </div>
    <!-- Right elements -->
</nav>
<!-- Navbar -->