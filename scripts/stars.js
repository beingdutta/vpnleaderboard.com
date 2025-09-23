document.addEventListener('DOMContentLoaded', function() {
  const starRatingElements = document.querySelectorAll('.star-rating');

  starRatingElements.forEach(el => {
    const score = parseFloat(el.getAttribute('data-score'));
    if (isNaN(score)) return;

    // Convert 10-point scale to 5 stars
    const maxStars = 5;
    const scoreOutOf5 = score / 2; // e.g., 8.8 -> 4.4

    const fullStars = Math.floor(scoreOutOf5);  // whole stars
    const decimalPart = scoreOutOf5 - fullStars; // fraction
    let starsHtml = '';

    for (let i = 1; i <= maxStars; i++) {
      if (i <= fullStars) {
        starsHtml += '<span class="star-icon full">★</span>';
      } else if (i === fullStars + 1 && decimalPart >= 0.25) {
        // render a half star if fraction >= 0.25
        if (decimalPart >= 0.75) {
          starsHtml += '<span class="star-icon full">★</span>'; // almost full
        } else {
          starsHtml += '<span class="star-icon half">★</span>';
        }
      } else {
        starsHtml += '<span class="star-icon">★</span>';
      }
    }

    el.innerHTML = starsHtml;
  });
});
