<?php
require_once __DIR__ . '/../db.php';

// --- Data Fetching ---
// In a real app, you'd fetch from a DB: SELECT * FROM reviews WHERE slug = :slug
$slug = $_GET['slug'] ?? '';
if (!$slug) {
    http_response_code(404);
    echo "404 Not Found";
    exit;
}

// For this example, we'll find the article in an array.
$all_reviews = [
    'expressvpn-review-2025' => [
        'title' => 'ExpressVPN Review 2025: Still the King of Speed?',
        'author' => 'Mike Richards',
        'author_bio' => 'Mike is a tech journalist specializing in performance testing and consumer software analysis.',
        'author_avatar' => 'https://i.pravatar.cc/150?u=mike',
        'date' => 'September 12, 2025',
        'image' => 'https://images.unsplash.com/photo-1614027164847-1b28accfbdf1?q=80&w=1920',
        'scores' => ['Speed' => 9.5, 'Streaming' => 9.2, 'Security' => 9.8, 'UX' => 9.0, 'Support' => 9.3],
        'summary' => [
            'Logging Policy' => 'Strict No-Logs Policy',
            'Headquarters' => 'British Virgin Islands',
            'Protocols' => 'Lightway, OpenVPN, IKEv2',
            'Simultaneous Connections' => '8',
            'Money-Back Guarantee' => '30 Days',
        ],
    ]
    // ... add other reviews here with their slugs as keys
];

$article = $all_reviews[$slug] ?? null;
if (!$article) {
    http_response_code(404);
    echo "404 Not Found";
    exit;
}
$overall_score = round(array_sum($article['scores']) / count($article['scores']), 1);

$canonical = (isset($_SERVER['HTTPS'])?'https':'http') . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER['REQUEST_URI'],'?');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($article['title']) ?> | VPN Leaderboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="We put ExpressVPN through its paces to see if its performance, security, and features still justify its premium price tag.">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/styles/style.css?v=<?= @filemtime(__DIR__ . '/../styles/style.css') ?>" rel="stylesheet">
</head>
<body>
  <?php include __DIR__ . '/../nav.php'; ?>

  <header class="article-hero" style="background-image: url('<?= htmlspecialchars($article['image']) ?>');">
    <div class="article-hero-overlay">
      <div class="container">
        <h1 class="display-4 fw-bold"><?= htmlspecialchars($article['title']) ?></h1>
        <p class="lead">Last updated on <?= htmlspecialchars($article['date']) ?></p>
      </div>
    </div>
  </header>

  <main class="container my-5">
    <div class="row g-5">
      <div class="col-lg-8">
        <div class="p-4 mb-4 rounded verdict-box">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <h3 class="mt-0 mb-2">Final Verdict</h3>
                <div class="star-rating" data-score="<?= $overall_score ?>"></div>
            </div>
            <p>After rigorous testing, ExpressVPN remains a top-tier choice for users who prioritize speed and ease of use. While its price is on the higher end, the performance and reliable unblocking capabilities for streaming services make it a worthwhile investment for many.</p>
            <p class="mb-0"><strong>Overall Score: <?= $overall_score ?>/10</strong></p>
        </div>

        <article class="article-content">
          <p class="lead">We put ExpressVPN through its paces to see if its performance, security, and features still justify its premium price tag. After extensive testing, here's our in-depth analysis.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
          <h2>Performance and Speed</h2>
          <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida.</p>

          <h3>Security Features</h3>
          <p>Praesent dapibus, neque id cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus. Phasellus ultrices nulla quis nibh. Quisque a lectus. Donec consectetuer ligula vulputate sem tristique cursus.</p>

          <p>Donec eget tellus non erat lacinia fermentum. Donec in velit vel ipsum auctor pulvinar. Vestibulum iaculis lacinia est. Proin dictum elementum velit. Fusce euismod consequat ante. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</p>
        </article>
      </div>
      <div class="col-lg-4">
        <div class="sticky-sidebar">
          <div class="p-4 rounded scorecard-box mb-4">
            <h4 class="fst-italic mb-3">Scorecard</h4>
            <?php foreach ($article['scores'] as $name => $score): ?>
            <div class="score-item mb-3">
                <div class="d-flex justify-content-between small mb-1">
                    <span><?= htmlspecialchars($name) ?></span>
                    <span><strong><?= htmlspecialchars($score) ?></strong>/10</span>
                </div>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar" role="progressbar" style="width: <?= ($score * 10) ?>%;" aria-valuenow="<?= $score ?>" aria-valuemin="0" aria-valuemax="10"></div>
                </div>
            </div>
            <?php endforeach; ?>
          </div>

          <div class="p-4 rounded summary-box mb-4">
            <h4 class="fst-italic mb-3">Quick Facts</h4>
            <table class="table table-sm summary-table">
                <tbody>
                    <?php foreach ($article['summary'] as $key => $value): ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($key) ?></th>
                        <td><?= htmlspecialchars($value) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
          </div>

          <div class="p-4 rounded author-box">
            <h4 class="fst-italic">Reviewed by</h4>
            <div class="d-flex align-items-center mt-3">
              <img src="<?= htmlspecialchars($article['author_avatar']) ?>" alt="<?= htmlspecialchars($article['author']) ?>" width="64" height="64" class="rounded-circle me-3">
              <div class="fw-bold"><?= htmlspecialchars($article['author']) ?></div>
            </div>
            <p class="small text-secondary mt-3"><?= htmlspecialchars($article['author_bio']) ?></p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/../footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/scripts/script.js"></script>
  <script src="/scripts/stars.js"></script>
</body>
</html>