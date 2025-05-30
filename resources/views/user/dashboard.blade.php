@extends('layouts.admin_dashboard')

@section('content')
<div class="wrapper">
  <nav id="sidebar" class="sidebar d-flex flex-column collapsed">
    <div class="d-flex justify-content-between align-items-center text-white px-3 py-2 border-bottom">
      <span class="nav-label fw-bold">Dashboard</span>
      <button id="toggleSidebar" class="btn btn-sm btn-outline-light"><i class="fas fa-bars"></i></button>
    </div>

    <ul class="nav flex-column mt-2" id="sidebarMenu">
      <!-- Dynamic menu will be inserted here -->
    </ul>

    <div class="mt-auto text-white px-3 py-2">
      <form method="POST" action="{{ route('logout') }}" class="logout-form">
        @csrf
        <button class="btn btn-link text-white d-block mt-2 logout-btn p-0" data-bs-toggle="tooltip" title="Logout" type="submit">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-label">Logout</span>
        </button>
      </form>
    </div>
  </nav>

  <div class="content">
    <div class="topbar d-flex justify-content-between align-items-center px-4 py-2 border-bottom bg-white shadow-sm">
      <img src="{{ asset('uploads/pics/logo2.png') }}" alt="logo" height="40">
      
      <div class="d-flex align-items-center gap-3">
        {{-- Notification bell (placeholder for future real-time alerts) --}}
        <div class="position-relative">
          <i class="fas fa-bell text-secondary" style="font-size: 20px;"></i>
          {{-- Example unread badge --}}
          {{-- <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span> --}}
        </div>

        <button id="toggleTheme" class="btn btn-sm btn-secondary">Dark Mode</button>
      </div>
    </div>

    {{-- Alerts --}}
    <div class="container mt-3">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @if(session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          {{ session('info') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif
    </div>

    <iframe id="contentFrame" src="{{ route('user.finance.index') }}" class="w-100 border-0" style="height: calc(100vh - 110px);"></iframe>
  </div>
</div>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
  const sidebar = document.getElementById("sidebar");
  const toggleBtn = document.getElementById("toggleSidebar");
  const iframe = document.getElementById("contentFrame");
  const toggleTheme = document.getElementById("toggleTheme");
  const menu = document.getElementById("sidebarMenu");

  toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("collapsed");
    enableTooltips();
  });

  if (localStorage.getItem("theme") === "dark") {
    document.body.classList.add("dark-mode");
  }

  toggleTheme.addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");
    localStorage.setItem("theme", document.body.classList.contains("dark-mode") ? "dark" : "light");
  });

  function selectItem(element, url) {
    iframe.src = url;
    document.querySelectorAll(".nav-link").forEach(link => link.classList.remove("active"));
    element.classList.add("active");
  }

  function enableTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
  }

  function createDropdown(title, icon, items) {
    const menuId = title.replace(/\s+/g, '') + "Menu";
    const li = document.createElement('li');

    li.innerHTML = `
      <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#${menuId}" role="button">
        <div>
          <span class="nav-icon" data-bs-toggle="tooltip" title="${title}"><i class="${icon}"></i></span>
          <span class="nav-label">${title}</span>
        </div>
        <i class="fas fa-chevron-down nav-label"></i>
      </a>
      <ul class="collapse submenu list-unstyled" id="${menuId}">
        ${items.map(item =>
          item.children ?
            `<li data-bs-toggle="tooltip" title="${title}" >
              <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#${item.label.replace(/\s+/g, '')}SubMenu" role="button">
                <div>${item.label}</div><i class="fas fa-angle-down"></i>
              </a>
              <ul class="collapse nested-submenu list-unstyled" id="${item.label.replace(/\s+/g, '')}SubMenu">
                ${item.children.map(sub => `<li><a onclick="selectItem(this, '${sub.url}')" class="nav-link">${sub.label}</a></li>`).join('')}
              </ul>
            </li>` :
            `<li><a onclick="selectItem(this, '${item.url}')" class="nav-link">${item.label}</a></li>`
        ).join('')}
      </ul>
    `;

    setTimeout(() => {
      const trigger = li.querySelector(`[href="#${menuId}"]`);
      const targetMenu = li.querySelector(`#${menuId}`);
      if (trigger && targetMenu) {
        trigger.addEventListener('click', () => {
          const allMenus = document.querySelectorAll('#sidebarMenu .submenu.collapse');
          allMenus.forEach(menu => {
            if (menu.id !== menuId) {
              const instance = bootstrap.Collapse.getInstance(menu) || new bootstrap.Collapse(menu, { toggle: false });
              instance.hide();
            }
          });
        });
      }
    }, 0);

    return li;
  }

  // Sidebar Menu
  menu.appendChild(createDropdown('Profile', 'fas fa-user', [
    { label: 'View Profile', url: '/profile/view' },
    { label: 'Edit Profile', url: '/profile/edit' }
  ]));

  menu.appendChild(createDropdown('Transactions', 'fas fa-briefcase', [
    { label: 'Approved', url: '/loading_count_down' },
    { label: 'Pending', url: '/transactions/pending' },
    { label: 'Rejected', url: '/transactions/rejected' },
    {
      label: 'Analytics',
      children: [
        { label: 'Monthly', url: '/transactions/analytics/monthly' },
        { label: 'Yearly', url: '/transactions/analytics/yearly' }
      ]
    }
  ]));

  menu.appendChild(createDropdown('Finance', 'fas fa-coins', [
    { label: 'Overview', url: '/user/finance/' },
    { label: 'Payments', url: '/user/finance/payments/create' },
    { label: 'Invoices', url: '/user/finance/invoices/create' },
    { label: 'Expenses', url: '/user/finance/expenses/create' },
    { label: 'Budget', url: '/user/finance/budgets/create' },
    { label: 'Reports', url: '/user/finance/reports/' }
  ]));

  menu.appendChild(createDropdown('Subscriptions', 'fas fa-box-open', [
  { label: 'All Subscriptions', url: '/admin/subscriptions' },
  { label: 'Pending Approvals', url: '/admin/subscriptions/pending' },
  { label: 'Approved', url: '/admin/subscriptions/approved' },
  { label: 'Rejected', url: '/admin/subscriptions/rejected' }
]));


  enableTooltips();
</script>
@endsection
