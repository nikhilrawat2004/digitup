function loco(){
    gsap.registerPlugin(ScrollTrigger);
  
  // Using Locomotive Scroll from Locomotive https://github.com/locomotivemtl/locomotive-scroll
  
  const locoScroll = new LocomotiveScroll({
  el: document.querySelector("#big"),
  smooth: true
  });
  // each time Locomotive Scroll updates, tell ScrollTrigger to update too (sync positioning)
  locoScroll.on("scroll", ScrollTrigger.update);
  
  // tell ScrollTrigger to use these proxy methods for the "#big" element since Locomotive Scroll is hijacking things
  ScrollTrigger.scrollerProxy("#big", {
  scrollTop(value) {
    return arguments.length ? locoScroll.scrollTo(value, 0, 0) : locoScroll.scroll.instance.scroll.y;
  }, // we don't have to define a scrollLeft because we're only scrolling vertically.
  getBoundingClientRect() {
    return {top: 0, left: 0, width: window.innerWidth, height: window.innerHeight};
  },
  // LocomotiveScroll handles things completely differently on mobile devices - it doesn't even transform the container at all! So to get the correct behavior and avoid jitters, we should pin things with position: fixed on mobile. We sense it by checking to see if there's a transform applied to the container (the LocomotiveScroll-controlled element).
  pinType: document.querySelector("#big").style.transform ? "transform" : "fixed"
  });
  
  
  // each time the window updates, we should refresh ScrollTrigger and then update LocomotiveScroll. 
  ScrollTrigger.addEventListener("refresh", () => locoScroll.update());
  
  // after everything is set up, refresh() ScrollTrigger and update LocomotiveScroll because padding may have been added for pinning, etc.
  ScrollTrigger.refresh();
  
  }

  // loco();
  
 /*
  Menu Toggle
 */
  let subMenu = document.getElementById("subMenu");
  function toggleMenu(){
    subMenu.classList.toggle("open-menu");
  }
  /*
    Typing effect on heading
  */
  const typedTextSpan = document.querySelector(".typed-text");
  const cursorSpan = document.querySelector(".cursor");
  
  const textArray = ["Taste", "Fun", "Happiness", "Life"];
  const typingDelay = 200;
  const erasingDelay = 100;
  const newTextDelay = 2000; // Delay between current and next text
  let textArrayIndex = 0;
  let charIndex = 0;
  
  function type() {
    if (charIndex < textArray[textArrayIndex].length) {
      if(!cursorSpan.classList.contains("typing")) cursorSpan.classList.add("typing");
      typedTextSpan.textContent += textArray[textArrayIndex].charAt(charIndex);
      charIndex++;
      setTimeout(type, typingDelay);
    } 
    else {
      cursorSpan.classList.remove("typing");
        setTimeout(erase, newTextDelay);
    }
  }
  
  function erase() {
      if (charIndex > 0) {
      if(!cursorSpan.classList.contains("typing")) cursorSpan.classList.add("typing");
      typedTextSpan.textContent = textArray[textArrayIndex].substring(0, charIndex-1);
      charIndex--;
      setTimeout(erase, erasingDelay);
    } 
    else {
      cursorSpan.classList.remove("typing");
      textArrayIndex++;
      if(textArrayIndex>=textArray.length) textArrayIndex=0;
      setTimeout(type, typingDelay + 1100);
    }
  }
  
  document.addEventListener("DOMContentLoaded", function() { // On DOM Load initiate the effect
    if(textArray.length) setTimeout(type, newTextDelay + 250);
  });
  
// Initialize your map here (e.g., Google Maps initialization code)

    // Function to handle search and geocoding
    function searchAndPlaceMarker() {
      var userInput = document.getElementById('searchInput').value;

      // Use a geocoding service to get the coordinates for the user input

      // Place a marker on the map at the obtained coordinates
    }

  /*
    add event on element
   */
  
  const addEventOnElement = function (element, type, listener) {
    if (element.length > 1) {
      for (let i = 0; i < element.length; i++) {
        element[i].addEventListener(type, listener);
      }
    } else {
      element.addEventListener(type, listener);
    }
  }
  
  
  
  
  
  /*
    add active class on header & back to top button
   */
  
  const header = document.querySelector("[data-header]");
  const backTopBtn = document.querySelector("[data-back-top-btn]");
  
  window.addEventListener("scroll", function () {
    if (window.scrollY >= 0) {
      header.classList.add("active");
      backTopBtn.classList.add("active");
    } else {
      header.classList.remove("active");
      backTopBtn.classList.remove("active");
    }
  });
  
  
  /*
    hero tab button
   */
  
  const tabBtns = document.querySelectorAll("[data-tab-btn]");
  
  let lastClickedTabBtn = tabBtns[0];
  
  const changeTab = function () {
    lastClickedTabBtn.classList.remove("active");
    this.classList.add("active");
    lastClickedTabBtn = this;
  }
  addEventOnElement(tabBtns, "click", changeTab);
 

  /*
  Add to cart
  */

  
  
  //gsap animations
  
  // gsap.from(".hero-form-wrapper",{
  //   y:50,
  //   duration:1,
  //   stagger: 0.4,
  //   scrollTrigger:{
  //     trigger:".hero-form-wrapper",
  //     scroller:"#main",
  //     //markers:true,
  //     start:"top 60%",
  //     end:"top 58%",
  //     scrub:3,
  //   }
  // });
  
  // gsap.from(".services-list",{
  //   y:50,
  //   duration:1,
  //   stagger: 0.1,
  //   scrollTrigger:{
  //     trigger:".services-list",
  //     scroller:"#main",
  //     scrub:3,
  //     //markers:true,
  //     start:"top 60%",
  //     end:"top 58%",
  //   }
  // });
  
  // gsap.from(".dish-list li, .dish-list",{
  //   y:50,
  //   duration:1,
  //   stagger: 0.4,
  //   scrollTrigger:{
  //     trigger:".dish-list li",
  //     scroller:"#main",
  //     //markers:true,
  //     start:"top 60%",
  //     end:"top 58%",
  //     scrub: 3,
  //   }
  // });
  
  // gsap.from(".newsletter",{
  //   y:50,
  //   duration:1,
  //   stagger: 0.4,
  //   scrollTrigger:{
  //     trigger:".newsletter",
  //     scroller:"#main",
  //     //markers:true,
  //     start:"top 60%",
  //     end:"top 58%",
  //     scrub:3,
  //   }
  // });