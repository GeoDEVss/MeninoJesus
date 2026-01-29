document.addEventListener('DOMContentLoaded', () => {
  const cards = document.querySelectorAll('.artigo-card');

  cards.forEach(card => {
    card.addEventListener('mouseenter', () => {
      card.style.transform = 'translateY(-6px)';
      card.style.boxShadow = '0 18px 40px rgba(0,0,0,0.18)';
    });

    card.addEventListener('mouseleave', () => {
      card.style.transform = 'translateY(0)';
      card.style.boxShadow = '0 12px 30px rgba(0,0,0,0.12)';
    });
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const sections = document.querySelectorAll('.fade-in-section');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if(entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target); // para não animar novamente
      }
    });
  }, {
    threshold: 0.1 // 10% da seção visível
  });

  sections.forEach(section => {
    observer.observe(section);
  });
});

