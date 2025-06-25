


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - Kumoyo Technologies</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #0c0e1a;
      --accent: #00f7ff;
      --bg: #0a1a41;
      --card: #111827;
      --text: #d1d5db;
      --muted: #64748b;
      --glass: rgba(255, 255, 255, 0.05);
      --overlay: rgba(0, 10, 40, 0.364);
      --white: #ffffff;
    }
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Orbitron', sans-serif;
      background-color: var(--bg);
      color: var(--text);
      line-height: 1.6;
    }
    section.hero {
      position: relative;
      height: 100vh;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      text-align: center;
      color: var(--accent);
      overflow: hidden;
    }
    section.hero::before {
      content: "";
      position: absolute;
      inset: 0;
      background: var(--overlay);
      z-index: 1;
    }
    section.hero img.bg {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      object-fit: cover;
      opacity: 1;
      z-index: 0;
    }
    .hero .content {
      position: relative;
      z-index: 2;
      padding: 0 20px;
    }
    .hero h1 {
      font-size: 4rem;
      font-weight: 800;
      text-shadow: 0 0 10px var(--accent);
    }
    .hero p {
      max-width: 700px;
      margin: 1rem auto 0;
      font-size: 1.2rem;
      color: var(--text);
    }


    section.section_1 {
      position: relative;
      height: 130vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
         background:linear-gradient(rgba(3, 13, 53, 0.767),rgb(255, 255, 255));
      color: var(--card
      );
      overflow: hidden;
    }


        section.section_2 {
      position: relative;
      height: 130vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      background: var(--primary);
      color: var(--white);
      overflow: hidden;
    }

    section.section_2 img.bg {
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      object-fit: cover;
      opacity: 1;
      z-index: 0;
    }
    .section_2 .content {
      position: relative;
      z-index: 2;
      padding: 0 20px;
    }



    .section {
      max-width: 1200px;
      margin: auto;
      padding: 4rem 2rem;
    }
    .card {
      background: var(--card);
      border-radius: 1rem;
      padding: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 0 15px rgba(0, 247, 255, 0.05);
    }
    .card h2 {
      font-size: 2rem;
      color: var(--accent);
      margin-bottom: 1rem;
    }
    .card p {
      color: var(--text);
      font-size: 1rem;
    }
    .team h2 {
      font-size: 2.2rem;
      margin-bottom: 1rem;
      color: var(--accent);
      text-shadow: 0 0 10px rgba(0, 247, 255, 0.3);
      text-align: center;
    }
    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
      gap: 2.5rem;
      margin-top: 2.5rem;
    }
    .team-member {
      background: var(--glass);
      border: 1px solid rgba(0, 247, 255, 0.15);
      backdrop-filter: blur(8px);
      border-radius: 20px;
      padding: 2rem 1.5rem;
      text-align: center;
      box-shadow: 0 15px 30px rgba(0, 247, 255, 0.07);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .team-member:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 25px 50px rgba(0, 247, 255, 0.2);
    }
    .team-member img {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 1rem;
      border: 3px solid var(--accent);
    }
    .team-member h4 {
      margin: 0.5rem 0 0.25rem;
      font-size: 1.3rem;
    }
    .team-member p {
      color: var(--muted);
      font-size: 0.9rem;
    }
    footer {
      background: #020b23;
      color: #8ca0c3;
      text-align: center;
      padding: 2rem 1rem;
      font-size: 0.875rem;
    }
  </style>
</head>
<body>
  <section class="hero">
    <img src="{{ asset('uploads/pics/33.jpg') }}" class="bg" alt="logo">
    <div class="content">
      <h1>Kumoyo Technologies</h1>
      <p>We don't just build systems; we unlock potential, fuel progress, and shape the future.</p>
    </div>
  </section>

  <section class="section_1">
    <div class="content">
      <h1>The Future with systems</h1>
      <p>We’re building a world powered by systems, running on computers .Explore the most recent impact of our products, people and supply chain.</p>
      

    </div>
  </section>

    <section class="section_2">
      <img src="{{ asset('uploads/pics/224.jpg') }}" class="bg" alt="logo">
      <div class="content">
        <h1>The Future with systems</h1>
      </div>
  </section>


  <section class="section_2">
      <div class="content">
        <h1>The Future with systems</h1>
      </div>
  </section>

  <div class="section">
    <div class="card">
      <h2>About Us</h2>
      <p>Kumoyo Technologies, a Zambian-registered business located in the heart of Zambia's Western Province, is dedicated to empowering organizations across diverse sectors with cutting-edge web solutions. Specializing in customized, web-based systems that drive efficiency, connectivity, and growth, Kumoyo Technologies serves as a trusted partner for clients seeking to transcend boundaries and redefine standards.</p>
      <p style="margin-top: 1rem;">Our focus on innovation and client-centric solutions makes us a key player in fostering success and transformation for institutions worldwide. At Kumoyo Technologies, we don’t just build systems; we unlock potential, fuel progress, and shape the future.</p>
    </div>

    <div class="card">
      <h2>Our Mission</h2>
      <p>Empower organizations across diverse sectors with cutting-edge web and mobile systems that enhance <strong style="color: var(--accent);">efficiency</strong>, <strong style="color: var(--accent);">connectivity</strong>, and <strong style="color: var(--accent);">growth</strong>.</p>
    </div>

    <div class="card">
      <h2>Our Vision</h2>
      <p>Trusted partner for organizations globally, driving their success through transformative web and mobile solutions.</p>
    </div>

    <div class="card">
      <h2>Our Motto</h2>
      <p><em>To be a global leader in tech innovation.</em></p>
    </div>

    <div class="card" style="position: relative; overflow: hidden;">
      <img src="uploads/pics/33.jpg" alt="Digital transformation" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.08; border-radius: 1rem;" />
      <div style="position: relative; z-index: 1;">
        <h2>Origins & Future</h2>
        <p>Established in April 2024, Kumoyo Technologies is rapidly emerging as a leading provider of educational platforms through its EduCenter system. From customized web-based systems to digital transformation strategies, we help businesses and institutions enhance efficiency, connectivity, and growth. Our commitment to innovation and client-centric solutions positions us as a trusted partner for those seeking to redefine standards and unlock new opportunities.</p>
      </div>
    </div>

    <section class="team">
      <h2>Our Innovators</h2>
      <div class="team-grid">
        <div class="team-member">
          <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="CEO" />
          <h4>Jordan Lee</h4>
          <p>Chief Executive Officer</p>
        </div>
        <div class="team-member">
          <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="CTO" />
          <h4>Samantha Diaz</h4>
          <p>Chief Technology Officer</p>
        </div>
        <div class="team-member">
          <img src="https://randomuser.me/api/portraits/men/44.jpg" alt="UX Lead" />
          <h4>Isaac Chen</h4>
          <p>Lead UX Designer</p>
        </div>
        <div class="team-member">
          <img src="https://randomuser.me/api/portraits/women/72.jpg" alt="Product Manager" />
          <h4>Lara Smith</h4>
          <p>Product Manager</p>
        </div>
      </div>
    </section>
  </div>

  <footer>
    &copy; 2025 Kumoyo Technologies. All rights reserved.
  </footer>
</body>
</html>
