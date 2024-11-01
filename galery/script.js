// JavaScript to shrink the navbar on scroll with gradient effect
window.addEventListener("scroll", function() {
    const navbar = document.getElementById("navbar");
    if (window.scrollY > 50) {
        navbar.classList.add("shrink");
    } else {
        navbar.classList.remove("shrink");
    }
});

document.addEventListener('scroll', function() {
    const sections = document.querySelectorAll('.product-card');
    const screenPosition = window.innerHeight / 1.2;
  
    sections.forEach(section => {
        const sectionPosition = section.getBoundingClientRect().top;
  
        if (sectionPosition < screenPosition) {
            section.classList.add('visible');
        }
    });
  });