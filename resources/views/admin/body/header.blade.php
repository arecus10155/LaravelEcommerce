<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
            </div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative search-bar-box">
                    <input type="text" class="form-control search-control" placeholder="Type to search..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                    <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
                </div>
            </div>
            <div class="top-menu ms-auto">

            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if(Auth::user()->profile_photo_path != null)
                    <img src="/storage/{{Auth::user()->profile_photo_path}}" alt="Admin" class="user-img" alt="user avatar">
                    @else
                    <img src="{{asset('backend/assets/images/avatars/mystery.jpg')}}" alt="Admin" class="user-img" alt="user avatar">
                    @endif

                    <div class="user-info ps-3">
                        <p class="user-name mb-0">{{Auth::user()->name}}</p>

                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{route('user.profile')}}"><i class="bx bx-user"></i><span>Profile</span></a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route("add.admin") }}"><i class="bx bx-cog"></i><span>Add New Admin</span></a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route("admin.list")}}"><i class='bx bx-home-circle'></i><span>Admin List</span></a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route("admin.custList")}}"><i class='bx bx-home-circle'></i><span>Customer List</span></a>
                    </li>

                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item" href="{{route('admin.logout')}}"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>