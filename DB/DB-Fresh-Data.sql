-- Normalize protocol names & fix jurisdictions, counts, device limits, logging & free availability.

UPDATE vpn_master_table
SET supported_countries = 105,
    server_count = 3000,  -- "3000+" historically; ExpressVPN publishes 105 countries, not an exact server count. Keep conservative 3000.
    device_limit = 14,
    protocols_supported = 'Lightway, OpenVPN, IKEv2',
    logging_policy = 'No activity or connection logs (audited)',
    based_in = 'British Virgin Islands',
    Free_available = 0,
    suitable_for = 'Gaming, Streaming, Privacy',
    Platform = 'Windows, macOS, iOS, Android, Linux, Routers'
WHERE id = 1; -- ExpressVPN
-- Sources: expressvpn.com/vpn-server; expressvpn.com/support/.../simultaneous-connections; expressvpn.com/blog/bvi-privacy-legislation/ :contentReference[oaicite:13]{index=13}

UPDATE vpn_master_table
SET supported_countries = 118,
    server_count = 7400,
    device_limit = 10,
    protocols_supported = 'NordLynx (WireGuard), OpenVPN, IKEv2',
    logging_policy = 'No-logs policy (audited)',
    based_in = 'Panama',
    Free_available = 0,
    suitable_for = 'Office Work, Streaming, Security',
    Platform = 'Windows, macOS, iOS, Android, Linux, Routers'
WHERE id = 2; -- NordVPN
-- Sources: nordvpn.com/servers; support.nordvpn.com "How many devices..."; "Where is NordVPN based" :contentReference[oaicite:14]{index=14}

UPDATE vpn_master_table
SET supported_countries = 100,
    server_count = 3200,
    device_limit = NULL,  -- unlimited → NULL + note in features
    protocols_supported = 'WireGuard, OpenVPN, IKEv2',
    logging_policy = 'No-logs policy (audited)',
    based_in = 'Netherlands',
    Free_available = 0,
    features = 'Unlimited devices; RAM-only servers; 10Gbps ports',
    Platform = 'Windows, macOS, iOS, Android, Linux, Routers'
WHERE id = 3; -- Surfshark
-- Sources: surfshark.com/servers; support.surfshark.com device-limit; Surfshark about/location :contentReference[oaicite:15]{index=15}

UPDATE vpn_master_table
SET supported_countries = 126,
    server_count = 12377,
    device_limit = 10, -- Proton VPN Plus typical device cap
    protocols_supported = 'WireGuard, OpenVPN, IKEv2',
    logging_policy = 'Strict no-logs policy (independently audited)',
    based_in = 'Switzerland',
    Free_available = 1,
    Platform = 'Windows, macOS, iOS, Android, Linux, Routers'
WHERE id = 6; -- Proton VPN
-- Sources: protonvpn.com/vpn-servers; protonvpn.com/free-vpn; TechRadar audit news :contentReference[oaicite:16]{index=16}

UPDATE vpn_master_table
SET supported_countries = 47,
    server_count = NULL, -- vendor doesn’t publish exact count
    device_limit = NULL, -- unlimited devices
    protocols_supported = 'WireGuard, OpenVPN, IKEv2',
    logging_policy = 'No-logs policy (audited)',
    based_in = 'Canada',
    Free_available = 1,
    Platform = 'Windows, macOS, iOS, Android, Browser extensions'
WHERE id = 10; -- TunnelBear
-- Sources: tunnelbear.com (47 countries); support/pricing pages (unlimited devices) :contentReference[oaicite:17]{index=17}

UPDATE vpn_master_table
SET supported_countries = 91,
    server_count = 2600,
    device_limit = 10,
    protocols_supported = 'WireGuard, OpenVPN, IKEv2',
    logging_policy = 'Zero-log (independently audited)',
    based_in = 'Malaysia',
    Free_available = 1,
    Platform = 'Windows, macOS, iOS, Android, Linux'
WHERE id = 14; -- hide.me
-- Sources: hide.me network page; hide.me FAQ (devices); TechRadar review (server count & 91 locations) :contentReference[oaicite:18]{index=18}

UPDATE vpn_master_table
SET supported_countries = 100,
    server_count = 9800, -- official page shows ~9800; reviews cite 11.5k+
    device_limit = 7,
    protocols_supported = 'WireGuard, OpenVPN, IKEv2',
    logging_policy = 'No-logs policy (audited)',
    based_in = 'Romania',
    Free_available = 0,
    Platform = 'Windows, macOS, iOS, Android, Linux, Routers'
WHERE id = 16; -- CyberGhost
-- Sources: cyberghostvpn.com/vpn-server; support article; TechRadar review (context) :contentReference[oaicite:19]{index=19}

UPDATE vpn_master_table
SET supported_countries = 0,
    server_count = 0,
    device_limit = 0,
    protocols_supported = NULL,
    logging_policy = 'Service discontinued (Apr 2024)',
    based_in = NULL,
    Free_available = 0,
    features = 'Service discontinued (see website)'
WHERE id = 17; -- Atlas VPN
-- Source: atlasvpn.com front page (service discontinued) :contentReference[oaicite:20]{index=20}

UPDATE vpn_master_table
SET supported_countries = 65,
    server_count = 6000,
    device_limit = 10,
    protocols_supported = 'WireGuard, OpenVPN, IKEv2',
    logging_policy = 'No-logs policy (audited)',
    based_in = 'British Virgin Islands',
    Free_available = 0,
    Platform = 'Windows, macOS, iOS, Android, Linux, Routers'
WHERE id = 18; -- PureVPN
-- Sources: purevpn.com/servers; Wikipedia (BVI jurisdiction) :contentReference[oaicite:21]{index=21}

UPDATE vpn_master_table
SET supported_countries = 35, -- mid of 34–37
    server_count = 700,
    device_limit = 10,
    protocols_supported = 'WireGuard, OpenVPN',
    logging_policy = 'No activity logs; connection metadata may be retained',
    based_in = 'Czech Republic',
    Free_available = 0,
    Platform = 'Windows, macOS, iOS, Android'
WHERE id = 19; -- Avast SecureLine VPN
-- Sources: thebestvpn.com (700 servers / 34–37 countries); avast page (10 devices) :contentReference[oaicite:22]{index=22}

UPDATE vpn_master_table
SET supported_countries = 69,
    server_count = NULL, -- fluctuates; vendor doesn’t publish exact
    device_limit = NULL, -- unlimited devices
    protocols_supported = 'WireGuard, OpenVPN, IKEv2',
    logging_policy = 'No identifying logs',
    based_in = 'Canada',
    Free_available = 1,
    Platform = 'Windows, macOS, iOS, Android, Linux, Routers'
WHERE id = 20; -- Windscribe
-- Sources: windscribe knowledge-base (69 countries); status/server pages; KB (HQ Canada) :contentReference[oaicite:23]{index=23}

UPDATE vpn_master_table
SET supported_countries = 63,
    server_count = 200,
    device_limit = 10,
    protocols_supported = 'WireGuard, OpenVPN, IKEv2',
    logging_policy = 'No-logs policy',
    based_in = 'Sweden',
    Free_available = 0,
    Platform = 'Windows, macOS, iOS, Android, Linux'
WHERE id = 21; -- PrivateVPN
-- Sources: privatevpn.com server locations; blog/devices (10 devices) :contentReference[oaicite:24]{index=24}
