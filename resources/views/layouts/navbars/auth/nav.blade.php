<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    {{ rtrim(str_replace('superadmin', '', str_replace('-', ' ', Request::path())), '/') }}
                </li>
            </ol>
            <!-- <h6 class="font-weight-bolder mb-0 text-capitalize">{{ str_replace('-', ' ', Request::path()) }}</h6> -->
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <ul class="navbar-nav justify-content-end">

                <li class="nav-item d-flex align-items-center position-relative">
                    <span class="dropdown-toggle" onclick="toggleDropdown()">
                        <i class="fa fa-user-circle" style="font-size: 24px;"></i>
                    </span>
                    <div class="dropdown-menu" id="dropdownMenu">
                        <a href="{{ url('/user-profile') }}" class="dropdown-item">Profile</a>
                        <form action="{{ url('/logout') }}" method="GET" style="display: inline;">
                            @csrf
                            <button type="submit" class="dropdown-item" style="background: none; border: none; padding: 12px 16px; color: black; text-decoration: none;">Sign Out</button>
                        </form>
                    </div>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<script>
    function toggleDropdown() {
        var dropdownMenu = document.getElementById("dropdownMenu");
        dropdownMenu.classList.toggle("show");
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropdown-toggle')) {
            var dropdowns = document.getElementsByClassName("dropdown-menu");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>

<style>
    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background-color: #fff;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        min-width: 160px;
        z-index: 1;
        border-radius: 5px;
    }

    .dropdown-item {
        padding: 12px 16px;
        color: #000;
        text-decoration: none;
        display: block;
    }

    .dropdown-item:hover {
        background-color: #ddd;
    }

    .dropdown-toggle {
        font-size: 24px;
        cursor: pointer;
    }

    .show {
        display: block;
    }
</style>


