@extends('layouts.admin_dashboard')

@section('content')


 <div class="wrapper">
  <nav id="sidebar" class="sidebar d-flex flex-column">
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
    <div class="topbar">
       <img src="{{ asset('uploads/pics/logo2.png') }}" alt="logo">
      <button id="toggleTheme" class="btn btn-sm btn-secondary">Toggle Dark Mode</button>
    </div>
    <iframe id="contentFrame" src="{{ route('payments.create') }}"></iframe>
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

  toggleTheme.addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");
  });

  function selectItem(element, url) {
    iframe.src = url;
    document.querySelectorAll(".nav-link").forEach(link => link.classList.remove("active"));
    element.classList.add("active");
  }

  function enableTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
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
    return li;
  }

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
  { label: 'payments', url: '/user/finance/payments/create' },
  { label: 'Invoices', url: '/user/finance/invoices/create' },
  { label: 'Expenses', url: '/user/finance/expenses/create' },
  { label: 'Budget', url: '/user/finance/budgets/create' },
  { label: 'Reports', url: '/user/finance/reports/' }
]));







  enableTooltips();
</script>

@endsection
