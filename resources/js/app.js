import './bootstrap';
import * as bootstrap from 'bootstrap';
import $ from 'jquery';
import { Swiper } from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';
import 'summernote/dist/summernote-bs4.min.js';

// Make Bootstrap, jQuery, Swiper, and Summernote available globally
window.bootstrap = bootstrap;
window.$ = window.jQuery = $;
window.Swiper = Swiper;

// Initialize all components when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
  // Initialize Bootstrap tooltips
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
  
  // Initialize Bootstrap popovers
  const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
  const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));

  // Initialize Bootstrap dropdowns
  const dropdownElementList = document.querySelectorAll('.dropdown-toggle');
  const dropdownList = [...dropdownElementList].map(dropdownToggleEl => new bootstrap.Dropdown(dropdownToggleEl));

  // Handle smooth scrolling for anchor links
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

  // Initialize Swiper carousels
  const swiperElements = document.querySelectorAll('.swiper');
  swiperElements.forEach(element => {
    new Swiper(element, {
      modules: [Navigation, Pagination, Autoplay],
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
  });
});