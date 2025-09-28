import './bootstrap';
import * as bootstrap from 'bootstrap';


window.bootstrap = bootstrap;

// Rendre Bootstrap disponible globalement
window.bootstrap = bootstrap;

// Script pour le changement de langue
document.addEventListener('DOMContentLoaded', function() {
  const languageSwitchers = document.querySelectorAll('.language-switcher a');
  
  languageSwitchers.forEach(link => {
    link.addEventListener('click', function(e) {
      // L'action sera gérée par le lien directement via Laravel
    });
  });

  // Initialisation des tooltips Bootstrap
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
  
  // Initialisation des popovers Bootstrap
  const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
  const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
});





document.addEventListener('DOMContentLoaded', function() {
  // Handle navigation to specific sections
  document.querySelectorAll('a[href*="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
          // Check if the link is to the current page
          if (window.location.pathname === this.getAttribute('href').split('#')[0]) {
              e.preventDefault();
              
              const targetId = this.getAttribute('href').split('#')[1];
              const targetElement = document.getElementById(targetId);
              
              if (targetElement) {
                  targetElement.scrollIntoView({ 
                      behavior: 'smooth',
                      block: 'start'
                  });
              }
          }
      });
  });
});