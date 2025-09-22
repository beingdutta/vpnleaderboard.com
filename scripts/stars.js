document.addEventListener('DOMContentLoaded', function() {
    const starContainers = document.querySelectorAll('.star-rating');
    starContainers.forEach(container => {
        const score = parseFloat(container.dataset.score);
        if (isNaN(score)) return;

        const fullStars = Math.floor(score / 2);
        const halfStar = (score % 2) >= 0.5 ? 1 : 0;
        const emptyStars = 5 - fullStars - halfStar;

        let starsHTML = '';
        for (let i = 0; i < fullStars; i++) {
            starsHTML += '<span class="star-icon full">★</span>';
        }
        if (halfStar) {
            starsHTML += '<span class="star-icon half">★</span>';
        }
        for (let i = 0; i < emptyStars; i++) {
            starsHTML += '<span class="star-icon empty">★</span>';
        }
        container.innerHTML = starsHTML;
    });
});