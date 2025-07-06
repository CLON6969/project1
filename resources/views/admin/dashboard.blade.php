@extends('layouts.admin_dashboard')

@section('content')


 <div class="wrapper">
  <nav id="sidebar" class="sidebar d-flex flex-column collapsed">
    <div class="d-flex justify-content-between align-items-center text-white px-3 py-2 border-bottom">
      <span class="nav-label fw-bold">Admin</span>
      <button id="toggleSidebar" class="btn btn-sm btn-outline-light"><i class="fas fa-bars"></i></button>
    </div>
    


    <ul class="nav flex-column mt-2" id="sidebarMenu">

            
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
      <button id="toggleTheme" class="btn btn-sm btn-secondary">Dark Mode</button>
    </div>
    <iframe id="contentFrame" src="{{ route('admin.finance.reports.index') }}"></iframe>
  </div>
</div>
<script src="{{ asset('/public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
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


  

// Load saved theme preference on page load
if (localStorage.getItem("theme") === "dark") {
  document.body.classList.add("dark-mode");
}

// Toggle theme and save preference
toggleTheme.addEventListener("click", () => {
  document.body.classList.toggle("dark-mode");

  // Save to localStorage
  if (document.body.classList.contains("dark-mode")) {
    localStorage.setItem("theme", "dark");
  } else {
    localStorage.setItem("theme", "light");
  }
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

function renderItems(items) {
  return items.map(item => {
    if (item.children) {
      const submenuId = item.label.replace(/\s+/g, '') + "SubMenu";
      return `
        <li>
          <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#${submenuId}" role="button">
            <div>${item.label}</div><i class="fas fa-angle-down"></i>
          </a>
          <ul class="collapse nested-submenu list-unstyled ps-3" id="${submenuId}">
            ${renderItems(item.children)}
          </ul>
        </li>
      `;
    } else {
      return `<li><a onclick="selectItem(this, '${item.url}')" class="nav-link">${item.label}</a></li>`;
    }
  }).join('');
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
      ${renderItems(items)}
    </ul>
  `;

  // Collapse logic
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




  



  

  menu.appendChild(createDropdown('Finance', 'fas fa-coins', [
  { label: 'Overview', url: 'finance/reports' },
  { label: 'payments', url: 'finance/payments' },
  { label: 'Invoices', url: 'finance/invoices' },
  { label: 'Expenses', url: 'finance/expenses' },
  { label: 'Budget', url: 'finance/budgets' },
  { label: 'Reports', url: 'finance/reports' },

      {
      label: 'Analytics',
      children: [
        { label: 'Monthly', url: '/page_loading' },
        { label: 'Yearly', url: '/page_loading' }
      ]
    }

]));


  menu.appendChild(createDropdown('Subscriptions', 'fas fa-box-open', [
  { label: 'All Subscriptions', url: 'subscriptions' },
  { label: 'Pending', url: 'subscriptions/pending' },
  { label: 'Approved', url: 'subscriptions/approved' },
  { label: 'Rejected', url: 'subscriptions/rejected' }
]));

menu.appendChild(createDropdown('Account Management', 'fas fa-users-cog', [
  { label: 'Add Staff', url: 'register/staff' },
  { label: 'Add Admin', url: 'register/admin' }
]));



menu.appendChild(createDropdown('Web', 'fas fa-globe', [  {
    label: 'General',
    children: [
      {
        label: 'Footer tittle',
        children: [
          { label: 'Edit', url: 'web/general/footer/titles' }
        ]
      },

      {
        label: 'footer Items',
        children: [
          { label: 'Edit', url: 'web/general/footer/items' }
        ]
      },

      {
        label: 'Socials ',
        children: [
          { label: 'Edit', url: 'web/general/socials' }
        ]
      },

      {
        label: 'logo ',
        children: [
          { label: 'Edit', url: 'web/general/logo' }
        ]
      },
      {
        label: 'partners',
        children: [
          { label: 'Edit', url: 'web/general/partners/' }
        ]
      },
            {
        label: 'Term & privacy',
        children: [
          { label: 'Edit', url: 'web/legal/' }
        ]
      },

                  {
        label: 'users',
        children: [
          { label: 'Edit', url: 'web/users/' }
        ]
      },

      
       {
        label: 'Company Statements',
        children: [
          { label: 'Edit', url: 'web/homepage/statements' }
        ]
      }
    ]
  },



  {
    label: 'Landing-page',
    children: [
      {
        label: 'Homepage Content',
        children: [
          { label: 'Edit', url: 'web/homepage/content/edit' }
        ]
      },

      {
        label: 'Homepage bottom',
        children: [
          { label: 'Edit', url: 'web/homepage/table' }
        ]
      },

     
    ]
  },

{
  label: 'Personal Solutions Page',
  
  children: [

    {
      label: 'Main Content',
      children: [
        { label: 'Edit Content', url: 'web/solution/personal/edit' }
      ]
    },
    {
      label: 'Personal Solutions',
      children: [
        { label: 'View All', url: 'web/solution/personal/table' }
      ]
    }
  ]
},



{
  label: 'Industrial Solutions Page',
  children: [
    {
      label: 'Main Content',
      children: [
        { label: 'Edit Content', url: 'web/solution/industrial/edit' }
      ]
    },
    {
      label: 'Industrial Solution',
      children: [
        { label: 'View All', url: 'web/solution/industrial/table' }
      ]
    }
  ]
},


      {
    label: 'Services-page',
    children: [
      {
        label: 'Services Content',
        children: [
          { label: 'Edit', url: 'web/services/edit' }
        ]
      },

      {
        label: 'services table',
        children: [
          { label: 'Edit', url: 'web/services/table' }
        ]
      },

    ]
  },

        {
    label: 'more-page',
    children: [
      {
        label: 'More Content',
        children: [
          { label: 'Edit', url: 'web/more/edit' }
        ]
      },

      {
        label: 'More table',
        children: [
          { label: 'Edit', url: 'web/more/table' }
        ]
      },

    ]
  },

  
        {
    label: 'Events-page',
    children: [
      {
        label: 'Events Content',
        children: [
          { label: 'Edit', url: 'web/event/edit' }
        ]
      },

      {
        label: 'services table',
        children: [
          { label: 'Edit', url: 'web/event/table' }
        ]
      },

    ]
  },

        {
    label: 'pricing-page',
    children: [
      {
        label: 'pricing Content',
        children: [
          { label: 'Edit', url: 'web/pricing/edit' }
        ]
      },

      {
        label: 'pricing table',
        children: [
          { label: 'Edit', url: 'web/package' }
        ]
      },

    ]
  },

        {
    label: 'About-page',
    children: [
      {
        label: 'About Content',
        children: [
          { label: 'Edit', url: 'web/about/edit' }
        ]
      },

      {
        label: 'About table',
        children: [
          { label: 'Edit', url: 'web/about/table' }
        ]
      },

    ]
  }




]));





  enableTooltips();
</script>

@endsection
    