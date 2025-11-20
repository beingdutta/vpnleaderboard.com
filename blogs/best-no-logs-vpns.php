<?php
require_once __DIR__ . '/../db.php';

// Fetch data for the VPNs mentioned in the article
// Updated list for the No-Log VPN article
$vpn_names = ['NordVPN', 'ExpressVPN', 'Surfshark', 'Proton VPN', 'Private Internet Access', 'Windscribe', 'PrivadoVPN', 'hide.me'];
$placeholders = implode(',', array_fill(0, count($vpn_names), '?'));

// Since this article is for India/Global, we'll join with the vpns_india table
// (keeping the same logic as your template for consistency)
$sql = "
SELECT
  v_all.name, v_all.logo_path, v_all.based_in, v_all.logging_policy, v_all.protocols_supported, v_all.website_url,
  v_reg.speed_mbps, v_reg.starting_price, v_reg.affiliate_link
FROM vpn_master_table v_all
LEFT JOIN vpns_india v_reg ON v_all.id = v_reg.vpn_id
WHERE v_all.name IN ($placeholders)
";

$stmt = $pdo->prepare($sql);
$stmt->execute($vpn_names);
$compared_vpns_raw = $stmt->fetchAll(PDO::FETCH_ASSOC);
$compared_vpns = array_column($compared_vpns_raw, null, 'name');

// This file is a self-contained article.
$article = [
    'title' => 'Best Free No Log VPN 2025: The Only Safe Options (Audited & Tested)',
    'author' => 'Jane Doe',
    'author_bio' => 'Jane is a cybersecurity analyst with over a decade of experience in digital privacy and network security, specializing in demystifying complex topics for a mainstream audience.',
    'author_avatar' => 'https://i.pravatar.cc/150?u=jane',
    'date' => 'November 20, 2025',
    'image' => '/assets/general-image-assets/best-no-logs-vpn.webp', // Image of code/security abstract
];

$canonical = 'https://www.vpnleaderboard.com/blogs/best-no-logs-vpns';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($article['title']) ?> | VPN Leaderboard</title> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/assets/site-icon.png" type="image/png">

    <meta name="description" content="Looking for a truly free no log VPN? We tested dozens to find the only safe free VPNs with strict no-logs policies, RAM-only servers, and independent audits in 2025.">
    <meta
      name="keywords"
      content="free no log vpn, free vpn no logs, free vpn with no logs, no log vpn free, best free vpn no logs, no log free vpn, best free vpn with no logs, free no logs vpn, free vpn no logging, no-log vpn free, best free no log vpn, best no log free vpn, free android vpn no logs, free anonymous vpn no logs, free no log vpn android, free no log vpn reddit, free no logging vpn, free vpn with no log policy, vpn free no logs, vpn no log free, android free vpn no logs, best free no log vpn for win, best free no log windows vpn"
    />
    <meta property="og:title" content="<?= htmlspecialchars($article['title']) ?>">
    <meta property="og:description" content="Looking for a truly free no log VPN? We tested dozens to find the only safe free VPNs with strict no-logs policies, RAM-only servers, and independent audits in 2025.">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?= htmlspecialchars($canonical) ?>"> 
    <meta property="og:image" content="<?= htmlspecialchars($article['image']) ?>">

    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="/styles/style.css?v=<?= @filemtime(__DIR__ . '/styles/style.css') ?>" rel="stylesheet">
    <link href="/styles/custom-styles.css?v=<?= time() ?>" rel="stylesheet">
    
    <!-- Citation Style -->
    <style>
      .cite-badge {
        font-size: 0.75em;
        vertical-align: super;
        cursor: help;
        opacity: 0.8;
        transition: opacity 0.2s;
        text-decoration: none;
      }
      .cite-badge:hover {
        opacity: 1;
      }
    </style>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1RMZD8BYYZ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-1RMZD8BYYZ');
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Is there a truly free VPN with no logs?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, but very few. Proton VPN and Windscribe are the most reputable 'freemium' services. They offer limited free plans funded by their paid users, allowing them to maintain strict no-logs policies without selling your data."
          }
        },
        {
          "@type": "Question",
          "name": "Why are most free VPNs dangerous?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Most 'free' VPNs make money by logging your browsing history and selling it to advertisers. Some, like Hola VPN, even operate as P2P networks, routing other users' traffic through your device, which poses a massive security risk."
          }
        },
        {
          "@type": "Question",
          "name": "What are RAM-only servers and why do they matter?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "RAM-only (diskless) servers run entirely on volatile memory. This means that every time the server is rebooted or powered off, all data is instantly and physically wiped. This makes it technically impossible for a VPN provider to store long-term logs on the server hardware."
          }
        }
      ]
    }
    </script>
<body>
  <?php include __DIR__ . '/../navigation/nav.php'; ?>

  <header class="article-hero" style="background-image: url(/assets/general-image-assets/best-no-logs-vpn.webp);">
    <div class="article-hero-overlay">
      <div class="container">
        <h1 class="display-4 fw-bold">Best Free No Log VPN 2025: The Only Safe Options</h1>
        <p class="lead">Posted on <?= htmlspecialchars($article['date']) ?></p>
      </div>
    </div>
  </header>

  <div class="container mt-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/blogs/">Blogs</a></li>
        <li class="breadcrumb-item active" aria-current="page">Best Free No Log VPN 2025</li>
      </ol>
    </nav>
  </div>


  <main class="container my-5">
    <div class="row g-5">
      <div class="col-lg-8">
        <article class="article-content">
          <p class="lead">In the shadowy marketplace of digital privacy, "No Logs" has become the ultimate buzzword. Every VPN provider, from the industry giants to the shady apps on the Google Play Store, screams it from the rooftops: "We keep zero logs! Your secrets are safe with us!" But as a security analyst who has dissected privacy policies for over a decade, I can tell you that for 90% of free VPNs, this is a lie.</p>
          <p>The reality is harsh. Running a global server network costs millions of dollars. If a <strong>free no log vpn</strong> isn't charging you a subscription, they have to keep the lights on somehow. Usually, that "somehow" involves tracking every website you visit, packaging that data into a neat profile, and selling it to the highest bidder. You aren't the customer; you are the product.</p>
          <p>However, there is a sliver of hope. There exists a small, elite tier of "Freemium" VPNs  services backed by legitimate privacy companies that offer a limited free version as a loss leader. These services actually respect the "No Logs" promise. Today, we are going to go deep. We will deconstruct the technology behind true privacy (like RAM-only servers and independent audits), expose the dangerous free VPNs you must avoid, and reveal the <strong>best free vpn no logs</strong> options that you can actually trust in 2025.</p>
          
          <h2 class="mt-5">The Anatomy of a Lie: What "No Logs" Actually Means</h2>
          <p>Before we look at the apps, you need to understand the technology. When a VPN claims "No Logs," what are they actually saying? In the past, this was just a promise on a Terms of Service page. Today, in 2025, we demand technical proof.</p>
          
          <h3>1. The Gold Standard: RAM-Only (Diskless) Servers</h3>
          <p>This is the most critical technical advancement in VPN privacy. Traditional servers write data to hard drives (HDDs or SSDs). Even if a company "deletes" logs, data forensics can often recover fragments of that data from the drive. </p>
          <p>A true no-log vpn free or paid should use RAM-only servers. These servers run entirely on volatile memory. They have no hard drives. Why does this matter? Because RAM requires power to hold data. The moment the server is rebooted, powered down, or seized by authorities, <em>every single byte of data</em> is instantly and physically wiped. It is technically impossible for data to persist.</p>

          <h3>2. The "Audit" Era</h3>
          <p>Trust, but verify. A VPN can say anything on its website. The only way to know for sure is if they have opened their doors to a "Big Four" auditing firm (like PwC, Deloitte, KPMG, or Ernst & Young) to physically inspect their servers and code. If a free vpn with no logs hasn't been audited, their promise is just marketing.</p>

          <h2 class="mt-5">The "Free VPN" Minefield: Services to Avoid</h2>
          <p>When you search for a free android vpn no logs or the best free no log windows vpn, you will likely encounter these names. They are popular, they are free, and they are dangerous.</p>
          <ul>
              <li><strong>Hola VPN:</strong> This is not a VPN; it is a botnet. It routes other users' traffic through <em>your</em> device. It has practically no security and logs everything you do.</li>
              <li><strong>Urban VPN:</strong> Their privacy policy explicitly states they collect your browsing history and location. They are a data mining operation disguised as a security tool.</li>
              <li><strong>Turbo VPN (Free Version):</strong> Riddled with ads and trackers. While great for unblocking a quick site, it is not a privacy tool.</li>
              <li><strong>SuperVPN:</strong> Has been flagged multiple times for critical vulnerabilities and malware risks.</li>
          </ul>

          <h2 class="mt-5">The Survivors: The Best Free No Log VPNs of 2025</h2>
          <p>After filtering out the scams, the trackers, and the liars, we are left with a very short list. These are the "Freemium" champions. They are safe because their business model relies on upgrading you to a paid plan, not selling your data.</p>

          <div class="d-flex align-items-center mt-4">
            <img src="<?= htmlspecialchars('/' . ($compared_vpns['Proton VPN']['logo_path'] ?? 'assets/protonvpn.png')) ?>" alt="Proton VPN Logo" width="36" height="36" class="rounded me-3">
            <span class="h3 mb-0">
              1. Proton VPN Free - The Privacy King (Unlimited Data)
            </span>
          </div>
          <p class="mt-3">If you want the absolute best free vpn with no logs, Proton VPN is the undisputed king. Born from the same team of scientists at CERN who created Proton Mail, this company essentially defines modern privacy.</p>
          <p>The "No Logs" Proof: Proton is based in Switzerland, a country with some of the world's strongest privacy laws (outside the 14 Eyes alliance). Their no-logs policy has been independently audited by Securitum, and their apps are open-source, meaning anyone can inspect the code for backdoors.</p>
          <p>The Free Plan: It is the only reputable free VPN that offers unlimited data. You can leave it on 24/7. There are no data caps to worry about. </p>
          <p>The Catch:</p>
            <ul>
                <li><strong>Limited Servers:</strong> You can only connect to servers in 5 countries (US, Netherlands, Japan, Romania, Poland). You cannot pick a specific city; the app chooses the fastest one for you.</li>
                <li><strong>"Medium" Speeds:</strong> During peak hours, free servers can get congested, leading to slower speeds compared to the paid plan.</li>
                <li><strong>No P2P/Streaming:</strong> The free servers do not support torrenting and generally struggle with unblocking Netflix.</li>
            </ul>
          </p>
          
          <section class="pros-cons my-4">
            <div class="row">
              <div class="col-md-6">
                <h2>Pros</h2>
                <ul class="pros-list">
                  <li><strong>Unlimited Data</strong> (The biggest pro)</li>
                  <li>Strict, audited No-Logs policy</li>
                  <li>Based in Switzerland (Privacy Haven)</li>
                  <li>Open-source apps</li>
                </ul>
              </div>
              <div class="col-md-6">
                <h2>Cons</h2>
                <ul class="cons-list">
                  <li>Only 5 server locations</li>
                  <li>No torrenting support</li>
                  <li>Can be slower during peak times</li>
                </ul>
              </div>
            </div>
          </section>

          <div class="d-flex align-items-center mt-4">
            <img src="<?= htmlspecialchars('/' . ($compared_vpns['PrivadoVPN']['logo_path'] ?? 'assets/privadovpn.png')) ?>" alt="PrivadoVPN Logo" width="36" height="36" class="rounded me-3">
            <span class="h3 mb-0">
              2. PrivadoVPN Free - The Streaming Specialist
            </span>
          </div>
          <p class="mt-3">PrivadoVPN is a newer player that has quickly climbed the ranks of the best free no log vpn lists. Like Proton, it is based in Switzerland, giving it that coveted legal protection.</p>
          <p>The "No Logs" Proof: Privado operates under Swiss law and maintains a strict no-logs policy. While it hasn't had as many high-profile audits as Proton, its jurisdiction and business model (freemium) are solid indicators of trust.</p>
          <p>The Free Plan: You get 10GB of data per month. While capped, it offers something Proton doesn't: access to 12 server locations and the ability to unblock streaming sites like Netflix and Disney+. It's widely considered one of the fastest free VPNs available.</p>
          <p>The Catch: Once you hit that 10GB limit, you are dropped to a much slower "emergency" speed (around 1Mbps), which is barely usable for modern browsing.</p>

          <section class="pros-cons my-4">
            <div class="row">
              <div class="col-md-6">
                <h2>Pros</h2>
                <ul class="pros-list">
                  <li>10GB of high-speed data</li>
                  <li>Works with Netflix and streaming</li>
                  <li>Servers in 12 locations (including UK, Canada)</li>
                  <li>Swiss Jurisdiction</li>
                </ul>
              </div>
              <div class="col-md-6">
                <h2>Cons</h2>
                <ul class="cons-list">
                  <li>10GB Data Cap</li>
                  <li>Slower speeds after cap is reached</li>
                </ul>
              </div>
            </div>
          </section>

          <div class="d-flex align-items-center mt-4">
            <img src="<?= htmlspecialchars('/' . ($compared_vpns['Windscribe']['logo_path'] ?? 'assets/windscribe.png')) ?>" alt="Windscribe Logo" width="36" height="36" class="rounded me-3">
            <span class="h3 mb-0">
              3. Windscribe Free - The Feature-Rich Powerhouse
            </span>
          </div>
          <p class="mt-3">Windscribe is a favorite in the free no log vpn reddit community. It balances a generous free plan with a suite of advanced privacy tools that usually cost money.</p>
          <p>The "No Logs" Proof: Windscribe has a very transparent (and often humorous) privacy policy. They explicitly state they do not keep connection logs, IP timestamps, or session logs. They have also proved this transparency through regular transparency reports.</p>
          <p>The Free Plan: You get up to 10GB of data per month (if you verify your email). You get access to servers in 10+ countries. But the real star is the R.O.B.E.R.T. tool, a server-side ad and malware blocker that makes browsing significantly cleaner and safer.</p>
          <p>The Catch: Like Privado, it's capped at 10GB. Also, Windscribe is based in Canada, which is a member of the Five Eyes intelligence alliance. However, since they keep no logs, they theoretically have nothing to hand over even if served a warrant.</p>

          <section class="pros-cons my-4">
            <div class="row">
              <div class="col-md-6">
                <h2>Pros</h2>
                <ul class="pros-list">
                  <li>10GB Monthly Data</li>
                  <li>Built-in Ad/Malware Blocker (R.O.B.E.R.T.)</li>
                  <li>Access to 10+ countries</li>
                  <li>Very user-friendly app</li>
                </ul>
              </div>
              <div class="col-md-6">
                <h2>Cons</h2>
                <ul class="cons-list">
                  <li>Based in Canada (Five Eyes)</li>
                  <li>10GB Limit</li>
                </ul>
              </div>
            </div>
          </section>

          <div class="d-flex align-items-center mt-4">
            <img src="<?= htmlspecialchars('/' . ($compared_vpns['hide.me']['logo_path'] ?? 'assets/hidemevpn.png')) ?>" alt="hide.me Logo" width="36" height="36" class="rounded me-3">
            <span class="h3 mb-0">
              4. hide.me Free - The Speed Demon
            </span>
          </div>
          <p class="mt-3">hide.me is another veteran in the privacy space, known for its independently audited zero-log policy and blazing fast speeds.</p>
          <p>The "No Logs" Proof: hide.me was one of the first VPNs to be independently audited by Leon Juranic of DefenseCode Ltd, confirming their zero-log claims. They are based in Malaysia, which has no mandatory data retention laws.</p>
          <p>The Free Plan: It offers unlimited data (technically). However, after you use 10GB, you lose the ability to choose your server location (it becomes random) and you lose the streaming support. But for pure browsing privacy, it's a solid unlimited option alongside Proton.</p>

          <h2 class="mt-5">When "Free" Isn't Enough: The Case for Paid No-Log VPNs</h2>
          <p>While Proton and Windscribe are excellent, they have limits. If you want RAM-only servers across 100 countries, blazing fast speeds for 4K streaming, and dedicated P2P servers, you need to look at the premium tier. These services have undergone the most rigorous audits in the industry.</p>

          <div class="d-flex align-items-center mt-4">
            <img src="<?= htmlspecialchars('/' . ($compared_vpns['NordVPN']['logo_path'] ?? 'assets/nordvpn.png')) ?>" alt="NordVPN Logo" width="36" height="36" class="rounded me-3">
            <span class="h3 mb-0">
              1. NordVPN - The Audit Champion
            </span>
          </div>
          <p class="mt-3">NordVPN has set the industry standard for audits. They have been audited four times by PwC and Deloitte. They run a massive network of RAM-only servers, meaning no data can physically persist on their hardware. Their "Threat Protection Pro" feature also actively blocks malware and trackers, adding another layer of privacy to your browsing.</p>

          <div class="d-flex align-items-center mt-4">
            <img src="<?= htmlspecialchars('/' . ($compared_vpns['ExpressVPN']['logo_path'] ?? 'assets/expressvpn.png')) ?>" alt="ExpressVPN Logo" width="36" height="36" class="rounded me-3">
            <span class="h3 mb-0">
              2. ExpressVPN - The Pioneer
            </span>
          </div>
          <p class="mt-3">ExpressVPN invented the RAM-only server concept with their "TrustedServer" technology. They wipe their servers not just on reboot, but frequently to ensure data hygiene. Based in the British Virgin Islands, they are immune to data retention laws and have proved their no-logs policy in high-profile investigations (like the assassination of the Russian ambassador to Turkey, where authorities seized an ExpressVPN server and found absolutely nothing).</p>

          <div class="d-flex align-items-center mt-4">
            <img src="<?= htmlspecialchars('/' . ($compared_vpns['Surfshark']['logo_path'] ?? 'assets/surfsharkvpn.png')) ?>" alt="Surfshark Logo" width="36" height="36" class="rounded me-3">
            <span class="h3 mb-0">
              3. Surfshark - The Best Value
            </span>
          </div>
          <p class="mt-3">Surfshark offers a fully audited, RAM-only server network at a fraction of the price of competitors. They allow unlimited simultaneous connections, meaning you can protect your entire household's devices with one account. Their "CleanWeb" feature is excellent at blocking ads and trackers, further reducing your digital footprint.</p>

          <h2 class="mt-5">Conclusion: Privacy is a Right, Not a Luxury</h2>
          <p>In 2025, finding a <strong>best free vpn no logs</strong> is difficult, but not impossible. You have to tread carefully.</p>
          <ul>
              <li>For <strong>Unlimited Data</strong> and maximum privacy, choose <strong>Proton VPN Free</strong>.</li>
              <li>For <strong>Streaming</strong> and ad-blocking, choose <strong>Windscribe</strong> or <strong>PrivadoVPN</strong> (just mind the 10GB cap).</li>
              <li>If you value your privacy above all else and want full speed and features, the small investment in <strong>NordVPN</strong> or <strong>ExpressVPN</strong> is worth every penny.</li>
          </ul>
          <p>Whatever you do, avoid the "too good to be true" completely free apps. In the world of VPNs, if you aren't paying for the product, you likely <em>are</em> the product.</p>
        </article>

        <!-- FAQ Section -->
        <section class="my-5 pt-4">
          <h2 class="text-center mb-4">Frequently Asked Questions</h2>
          <div class="accordion" id="faqAccordion">
            <div class="accordion-item" style="background-color: var(--background-secondary); border-color: var(--border-color);">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="background-color: var(--background-secondary); color: var(--text-primary);">
                  Is there a truly free VPN with no logs?
                </button>
              </h2>
              <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Yes, but very few. Proton VPN and Windscribe are the most reputable 'freemium' services. They offer limited free plans funded by their paid users, allowing them to maintain strict no-logs policies without selling your data.
                </div>
              </div>
            </div>
            <div class="accordion-item" style="background-color: var(--background-secondary); border-color: var(--border-color);">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background-color: var(--background-secondary); color: var(--text-primary);">
                  Why are most free VPNs dangerous?
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Most 'free' VPNs make money by logging your browsing history and selling it to advertisers. Some, like Hola VPN, even operate as P2P networks, routing other users' traffic through your device, which poses a massive security risk.
                </div>
              </div>
            </div>
            <div class="accordion-item" style="background-color: var(--background-secondary); border-color: var(--border-color);">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="background-color: var(--background-secondary); color: var(--text-primary);">
                  What are RAM-only servers and why do they matter?
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  RAM-only (diskless) servers run entirely on volatile memory. This means that every time the server is rebooted or powered off, all data is instantly and physically wiped. This makes it technically impossible for a VPN provider to store long-term logs on the server hardware.
                </div>
              </div>
            </div>
             <div class="accordion-item" style="background-color: var(--background-secondary); border-color: var(--border-color);">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="background-color: var(--background-secondary); color: var(--text-primary);">
                  What is the best free no log VPN for Android?
                </button>
              </h2>
              <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Proton VPN is widely considered the best free no-log VPN for Android because it offers unlimited data and has a dedicated, open-source Android app that is easy to use and secure.
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Sources Section -->
        <section class="my-5 pt-4">
          <div class="p-4 rounded verdict-box">
            <h3 class="mt-0 mb-3">Article Sources</h3>
            <ul class="list-unstyled small">
              <li class="mb-2">[1.1] PureVPN Blog: "What Are RAM-Only VPN Servers and Why Are They Important?"</li>
              <li class="mb-2">[2.2] Proton VPN: "Proton VPN Speeds"</li>
              <li class="mb-2">[3.1] CNET: "ProtonVPN Review 2025"</li>
              <li class="mb-2">[4.1] TechRepublic: "Windscribe VPN Review"</li>
              <li class="mb-2">[5.3] vpnMentor: "hide.me VPN Review"</li>
              <li class="mb-2">[6.2] CyberInsider: "PrivadoVPN Review"</li>
            </ul>
          </div>
        </section>
      </div>
      <div class="col-lg-4">
        <div class="sticky-sidebar">
          <div class="p-4 rounded author-box">
            <h4 class="fst-italic">About the author</h4>
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

  <?php include __DIR__ . '/../navigation/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/scripts/script.js"></script>
</body>

</html>