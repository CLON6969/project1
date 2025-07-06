@extends('layouts.about')

@section('content')



<section class="hero">
  <img src="{{ asset('/public/storage/uploads/pics/' . $about->background_picture) }}" class="bg" alt="background picture">


  <div class="content">
    <div class="child1">
      <h1>{{ $about->title1 }}</h1>
      <p>{{ $about->title1_content }}</p>
    </div>

<div class="child2">
  <!--  
    
  <div class="info-card">
    <div class="number" data-count="{{ $totalStaff }}">0</div>
    <div class="label">Staff</div>
  </div>


  <div class="info-card">
    <div class="number" data-count="{{ $totalInstitutions }}">0</div>
    <div class="label">Institutions</div>
  </div>

    <div class="info-card">
    <div class="number" data-count="{{ $totalUsers }}">0</div>
    <div class="label">Customers</div>
  </div>


-->




  <div class="info-card">
    <div class="number" data-count="{{ $solutions->count() }}">0</div>
    <div class="label">Solutions</div>
  </div>

  <div class="info-card">
    <div class="number" data-count="{{ $services->count() }}">0</div>
    <div class="label">Services</div>
  </div>

  <div class="info-card">
    <div class="number" data-count="{{ $packages->count() }}">0</div>
    <div class="label">Package</div>
  </div>
</div>


  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const counters = document.querySelectorAll(".number");
    const speed = 200; // Lower is faster

    counters.forEach(counter => {
      const updateCount = () => {
        const target = +counter.getAttribute("data-count");
        const count = +counter.innerText;

        const inc = Math.ceil(target / speed);

        if (count < target) {
          counter.innerText = count + inc;
          setTimeout(updateCount, 15);
        } else {
          counter.innerText = target + "+";
        }
      };

      updateCount();
    });
  });
</script>


  <section class="section_1">
    <div class="content">
      <h1>{{ $about->title2 }}</h1>
      <p>{{ $about->title2_content }}</p>

      <div class="button">
          <a href="{{$about->button1_url}}">
             <!-- #endregion --><i class="fas fa-plus mr-2"></i> {{$about->button1_name}}
          </a>
      </div>

    </div>
  </section>

    <section class="section_2">
  <img src="{{ asset('/public/storage/uploads/pics/' . $about->background_picture2) }}" class="bg" alt="background picture">
      <div class="content">
             <h1>{{ $about->title3 }}</h1>
      <p>{{ $about->title3_content }}</p>
      </div>
  </section>


<section class="section_3">
  <div class="content">
    <div class="text-block">
      <h1>{{ $about->title4 }}</h1>
      <p>{{ $about->title4_content }}</p>
    </div>

    <div class="image-container">
      <img src="" alt="picture" class="animated-image" id="main-image" />
    </div>


  


    <div class="features">


  @foreach($about_table as $table)
      <div class="feature" data-image="{{ asset('/public/storage/uploads/pics/' . $table->picture) }}">
        <h4>{{ $table->title1}}</h4>
        <p>{{ $table->title1_content}}</p>
         <small style="color: #888;">{{ $table->title1_small_text}}</small>
      </div>
  @endforeach

    </div>
  </div>
</section>




<section class="section_5">
  <div class="content">
    <div class="card-section">

  @foreach($statements as $index => $statement)
      <div class="card-block">
        <h2 class="card-title">{{ $statement->title1 }}</h2>
        <div class="card blue">
          <div class="card-overlay-text">
            {{ $statement->title1_main_content }}
          </div>
          <div class="color-overlay"></div>
          <img src="{{ asset('/public/storage/uploads/pics/' . $statement->background_picture) }}" alt="background picture">
        </div>
      </div>
  @endforeach

    </div>


  </div>
</section>




  
  <section class="section_4">
      <div class="content">
        <h1>{{$about->title5}}</h1>
              <div class="button">
          <a href="{{$about->button2_url}}">
             <!-- #endregion --><i class="fas fa-plus mr-2"></i> {{$about->button2_name}}
          </a>
      </div>
      </div>
  </section>



  <div class="section">

    <section class="team">
      <h2>{{$about->title6}}</h2>
      <div class="team-grid">
        <div class="team-member">
          <img src=" {{ asset('/public/uploads/pics/default.png') }}" alt="CEO" />
          <h4>Mbumwae.S.M</h4>
          <p>C.E.O</p>
        </div>
        <div class="team-member">
          <img src=" {{ asset('/public/uploads/pics/default.png') }}" alt="CTO" />
          <h4>Erick Maliko</h4>
          <p>Chief Technology Officer</p>
        </div>
        <div class="team-member">
          <img src=" {{ asset('/public/uploads/pics/default.png') }}" alt="UX Lead" />
          <h4>Mwami Miyanda</h4>
          <p>Lead UX Designer</p>
        </div>
      </div>
    </section>
  </div>

 <!-- this gets a team from the database[ENEBLE ONLY WHEN YOU HAVE A MINUMUM IF 3 POEPLE] -->
 <!--
  <section class="team">
  <h2>{{ $about->title6 }}</h2>
  <div class="team-grid">
    @foreach($team as $member)
      <div class="team-member">
        <img src="{{ asset('/public/storage/' . $member->profile_picture) }}" alt="{{ $member->name }}" />
        <h4>{{ $member->name }}</h4>
        <p>{{ $member->job_title }}</p>
      </div>
    @endforeach
  </div>
</section>
-->

<script>
  const features = document.querySelectorAll('.feature');
  const mainImage = document.getElementById('main-image');

  let currentIndex = 0;
  let autoSlide = true;
  let slideInterval;

  function activateFeature(index) {
    const feature = features[index];
    const image = feature.getAttribute('data-image');

    // Start fade-out
    mainImage.classList.add('fade-out');

    setTimeout(() => {
      // Change image source after fade-out
      mainImage.src = image;

      // Reapply fade-in
      mainImage.classList.remove('fade-out');
    }, 400); // Half of the transition duration

    // Update active class
    features.forEach(f => f.classList.remove('active'));
    feature.classList.add('active');
  }

  function startSlideshow() {
    slideInterval = setInterval(() => {
      if (!autoSlide) return;
      currentIndex = (currentIndex + 1) % features.length;
      activateFeature(currentIndex);
    }, 4000);
  }

  features.forEach((feature, index) => {
    feature.addEventListener('click', function () {
      autoSlide = false; // Stop auto slideshow
      activateFeature(index);
    });
  });

  // Start
  activateFeature(currentIndex);
  startSlideshow();
</script>




@endsection
