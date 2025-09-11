document.addEventListener("DOMContentLoaded", function() {
      const revealElements = document.querySelectorAll(".scroll-reveal");
      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if(entry.isIntersecting) {
            entry.target.classList.add("active");
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.1 });
      revealElements.forEach(el => observer.observe(el));
    });

    const featureCards = document.querySelectorAll('.features .card');
  featureCards.forEach(card => {
    card.addEventListener('click', () => {
      const target = document.querySelector(card.getAttribute('data-target'));
      target.scrollIntoView({ behavior: 'smooth' });
    });
  });