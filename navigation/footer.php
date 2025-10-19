<footer class="footer py-4 border-top" style="--bs-border-color: var(--border-color);">
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
    <div>&copy; <?= date('Y') ?> VPN Leaderboard · All rights reserved.</div>
    <div class="d-flex flex-wrap gap-3">
      <a href="about.php" class="text-decoration-none footer-link">About</a>
      <a href="contact.php" class="text-decoration-none footer-link">Contact</a>
      <a href="terms.php" class="text-decoration-none footer-link">Terms</a>
      <a href="privacy.php" class="text-decoration-none footer-link">Privacy</a>
    </div>
  </div>
</footer>

<!-- Vote Prompt Modal -->
<div class="modal fade" id="votePromptModal" tabindex="-1" aria-labelledby="votePromptModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background: var(--background-secondary);">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="votePromptModalLabel">Your Vote Matters!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center p-3">
        <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-person-check-fill mb-2 vote-modal-icon" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
          <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
        </svg>
        <p class="mb-0">Help the community find the best VPN. It only takes a second to upvote or downvote your favorite service. Your contribution makes a difference!</p>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Maybe Later</button>
        <button type="button" id="voteNowBtn" class="btn btn-primary">Vote Now!</button>
      </div>
    </div>
  </div>
</div>