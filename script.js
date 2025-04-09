document.addEventListener("DOMContentLoaded", function () {
    // Smooth scrolling for navigation links
    document.querySelectorAll("nav ul li a").forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            let targetId = this.getAttribute("href").substring(1);
            let targetElement = document.getElementById(targetId);
            if (targetElement) {
                e.preventDefault();
                targetElement.scrollIntoView({ behavior: "smooth", block: "start" });
            }
        });
    });

    // Bootstrap Carousel Auto-slide
    let eventGallery = document.querySelector("#eventGallery");
    if (eventGallery) {
        new bootstrap.Carousel(eventGallery, { interval: 3000, pause: "hover" });
    }

    // FAQ Accordion Toggle with Smooth Transition
    document.querySelectorAll(".accordion-header").forEach(header => {
        header.addEventListener("click", function () {
            let content = this.nextElementSibling;
            content.style.transition = "max-height 0.5s ease-in-out";
            content.style.overflow = "hidden";
            content.style.maxHeight = content.style.maxHeight ? null : content.scrollHeight + "px";
        });
    });

    // Dynamic Event Loading from PHP (Using Fetch API)
    let eventList = document.getElementById("event-list");
    if (eventList) {
        fetch("events.php")
            .then(response => response.json())
            .then(data => {
                eventList.innerHTML = data.map(event =>
                    `<div class="event-item"><h4>${event.name}</h4><p>${event.date}</p></div>`
                ).join("");
            })
            .catch(error => console.error("Error fetching events:", error));
    }

    // Login Form Validation with Inline Error Display
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            let email = document.getElementById("loginEmail").value.trim();
            let password = document.getElementById("loginPassword").value.trim();
            let errorBox = document.getElementById("loginError");
            
            if (!email || !password) {
                errorBox.innerText = "Please fill in all fields!";
                e.preventDefault();
                return;
            }
            if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                errorBox.innerText = "Enter a valid email address!";
                e.preventDefault();
            }
        });
    }

    // Lightbox for Image Preview
    let galleryImages = document.querySelectorAll(".gallery-img");
    let lightbox = document.getElementById("lightbox");
    let lightboxImg = document.getElementById("lightbox-img");
    let closeBtn = document.querySelector(".close-btn");

    if (lightbox && lightboxImg && closeBtn) {
        galleryImages.forEach(img => {
            img.addEventListener("click", function () {
                lightbox.style.display = "flex";
                lightboxImg.src = this.src;
            });
        });

        closeBtn.addEventListener("click", () => lightbox.style.display = "none");

        lightbox.addEventListener("click", (e) => {
            if (e.target !== lightboxImg) {
                lightbox.style.display = "none";
            }
        });
    }
});
