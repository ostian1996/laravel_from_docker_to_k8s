    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item sidebar-category">
          <p>MENUS</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">
            <i class="mdi mdi-view-quilt menu-icon"></i>
            <span class="menu-title">Tableau de bord</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/forms/basic_elements.html">
            <i class="mdi mdi-view-headline menu-icon"></i>
            <span class="menu-title">Form elements</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pages/charts/chartjs.html">
            <i class="mdi mdi-chart-pie menu-icon"></i>
            <span class="menu-title">Charts</span>
          </a>
        </li> 
        <li class="nav-item sidebar-category">
          <p>Paramètres app</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="mdi mdi-account-multiple-plus menu-icon"></i>
            <span class="menu-title">Rôles & Utilisateurs</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> 
                    <a class="nav-link" href="{{ route('roles.index') }}">
                        Rôles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        Utilisateurs
                    </a>
                </li>
            </ul>
          </div>
        </li>

      </ul>
    </nav>