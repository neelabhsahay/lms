<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Container wrapper -->
  <div class="container-fluid">
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
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Navbar brand -->
      <a class="navbar-brand mt-2 mt-lg-0" href="#">
        <img
          src="http://localhost/lms/web/asserts/img/logo.svg"
          height="30"
          alt=""
          loading="lazy"
        />
      </a>
      <!-- Left links -->

    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-right">
      <!-- Avatar -->
      <a
        class="dropdown-toggle d-flex align-items-center hidden-arrow"
        href="#"
        id="navbarDropdownMenuLink"
        role="button"
        data-mdb-toggle="dropdown"
        aria-expanded="false"
      >
        <img
          src="http://localhost/lms/web/asserts/img/user.jpg"
          class="rounded-circle"
          height="40"
          alt=""
          loading="lazy"
        />
      </a>
      <ul class="dropdown-menu dropdown-menu-end pull-right "
        aria-labelledby="navbarDropdownMenuLink" data-toggle="dropdown"
      >
        <li>
          <a class="dropdown-item" href="#" onclick="showMyInfoDetail()">My profile</a>
        </li>
        <li>
          <a class="dropdown-item" href="#">Settings</a>
        </li>
        <li>
          <a class="dropdown-item" href="#" onclick="showLoginPage()">Logout</a>
        </li>
      </ul>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->