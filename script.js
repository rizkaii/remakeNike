// script.js

// Select the navbar
const navbar = document.getElementById("navbar");

// Event listener for scroll to toggle sticky class
window.addEventListener("scroll", () => {
  if (window.scrollY > 50) {
    navbar.classList.add("sticky");
  } else {
    navbar.classList.remove("sticky");
  }
});

document.addEventListener('scroll', function() {
  const sections = document.querySelectorAll('.section, .stat, .product, .futureDesc, .title-figure, .text-two, .text-under-title, .testimonial-box1, .testimonial-box2, .testimonial-box3, .name1, .name2, .name3, .image-philip');
  const screenPosition = window.innerHeight / 1.2;

  sections.forEach(section => {
      const sectionPosition = section.getBoundingClientRect().top;

      if (sectionPosition < screenPosition) {
          section.classList.add('visible');
      }
  });
});


// Smooth scroll for anchor links
document.querySelectorAll('nav ul li a').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    e.preventDefault();

    const targetId = this.getAttribute('href').substring(1);
    const targetSection = document.getElementById(targetId);

    // Calculate offset top for smooth scrolling
    const offsetTop = targetSection.offsetTop - navbar.offsetHeight;

    // Animate scroll to target section
    window.scrollTo({
      top: offsetTop,
      behavior: 'smooth'
    });
  });
});

document.getElementById('mobile-menu').addEventListener('click', function() {
  const navLinks = document.querySelector('.nav-links');
  const toggle = document.getElementById('mobile-menu');

  navLinks.classList.toggle('active');
  toggle.classList.toggle('active');
});

/* Close menu when a link is clicked */
document.querySelectorAll('.nav-links a').forEach(link => {
  link.addEventListener('click', function() {
      const navLinks = document.querySelector('.nav-links');
      const toggle = document.getElementById('mobile-menu');

      navLinks.classList.remove('active');
      toggle.classList.remove('active');
  });
});


let currentIndex = 0;

function nextTestimonial() {
  const testimonials = document.querySelectorAll('.testimonial');
  testimonials[currentIndex].classList.remove('active');
  
  currentIndex = (currentIndex + 1) % testimonials.length; // Cycle through testimonials
  
  testimonials[currentIndex].classList.add('active');
}


function animateCount(element) {
  let percentage = 0;
  const target = parseInt(element.getAttribute("data-target")); // Mengambil nilai target dari data-target

  const interval = setInterval(() => {
      percentage++;
      element.textContent = `${percentage}%`;

      if (percentage >= target) { // Menghentikan animasi saat mencapai target
          clearInterval(interval);
      }
  }, 30); // Sesuaikan kecepatan animasi dengan mengubah waktu interval
}

// Memilih semua elemen persentase
const percentageElements = document.querySelectorAll("#percentage1, #percentage2, #percentage3");

// Menggunakan Intersection Observer
const observer = new IntersectionObserver((entries, observer) => {
  entries.forEach((entry) => {
      if (entry.isIntersecting) {
          animateCount(entry.target);
          observer.unobserve(entry.target); // Berhenti memantau setelah animasi dimulai
      }
  });
}, { threshold: 0.5 }); // Mulai animasi ketika 50% elemen terlihat di layar

// Memantau setiap elemen persentase
percentageElements.forEach((element) => {
  observer.observe(element);
});
