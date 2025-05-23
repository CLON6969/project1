@extends('layouts.standard')

@section('content')

<div class="home-title">
    <button>Premium <i class="fas fa-volleyball-ball"></i></button>
    
    <p>Foundational tools for establishing a professional online presence, responsive, mobile-friendly website</p>
   
</div>



<div class="plan-container">

    <div class="plan-header-container"> 

        <div class="plan-header"> 
            <img src="{{ asset('uploads/pics/logo2.png') }}" alt="logo"> 
            
            <div class="plan-header-tittle">
                <p>Premium Plan</p> 
            </div> 
        </div>


        <div class="maintenance-container">
            <p class="maintenance">100% Maintenance Fee (Annual)</p>
        </div>
        
   </div>

    <div class="premium-header">
       

        <h1>ZMW 50,000</h1>
        <p class="free-hosting">Free Hosting</p>
        <div class="choice">Choose Plan</div>
    </div>
    
    





    <div class="features">
        <ul>
            <li>Customizable Website</li>
            <li>Admission System</li>
            <li>Student Record System</li>
            <li>HR System</li>
            <li>Payroll System</li>
            <li>Hostel Management System</li>
            <li>Exam Management System</li>
            <li>Library Management System</li>
            <li>Timetable Management System</li>
            <li>Communication System</li>
            <li>Reports and Analytics</li>
            <li>Faculty Management System</li>
            <li>Continuous Assessment Management System</li>
        </ul>
    </div>
    

    
    <div class="addtional-section">
    <h4 class="additional-benefits">Additional Benefits</h4>

    <ul>
        <li>• Hosting: Free 200GB storage with automated backups.</li>
        <li>• Customization: Fully customizable theme design to match institutional branding.</li>
        <li>• Support: Dedicated account manager, priority support, and 24/7 technical support (10% of the initial contract price per month).</li>
        <li>• Maintenance Fee (Annual): 12% of the initial cost (from the second year).</li>
    </ul>

</div>

    



    <div class="core-section">
            <h4 class="additional-benefits">CORE</h4>
        <ul>
            <li><strong>User-Friendly Design:</strong> A responsive, mobile-friendly website.</li>
            <li><strong>Personalization:</strong> Customizable features.</li>
            <li><strong>Advanced Security:</strong> Data protection with global standards.</li>
            <li><strong>Scalability:</strong> Modular architecture.</li>
            <li><strong>Data-Driven Insights:</strong> Robust analytics.</li>
        </ul>
    </div>


    <div class="compere">
        <a href="compere">
            <button>compere</button>
        </a>
    </div>
</div>

@endsection