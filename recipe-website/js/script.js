// js/script.js

document.addEventListener("DOMContentLoaded", function() {
    // Star rating functionality
    const stars = document.querySelectorAll('.star-rating input');
    
    stars.forEach(star => {
        star.addEventListener('change', function() {
            const form = this.closest('form');
            // You can optionally submit the form automatically on star selection
            // form.submit();
        });
    });

    // Home page search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            let filter = searchInput.value.toLowerCase();
            let recipeCards = document.querySelectorAll('.recipe-card');

            recipeCards.forEach(card => {
                let title = card.querySelector('h3').textContent.toLowerCase();
                let description = card.querySelector('p').textContent.toLowerCase();
                if (title.includes(filter) || description.includes(filter)) {
                    card.style.display = "";
                } else {
                    card.style.display = "none";
                }
            });
        });
    }
});