<!DOCTYPE html>
<html lang="fr" id="html-root">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Azeroth Universe - Contenu</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --jade-950: #04140d;
    --jade-900: #0a2818;
    --jade-800: #123f28;
    --jade-700: #1c5636;
    --jade-600: #2c7a4c;
    --jade-500: #3f9c66;
    --gold: #cda75e;
    --gold-bright: #f0d38a;
    --gold-dim: #7a6130;
    --bg-page: #04140d;
    --bg-card: rgba(31,99,63,0.4);
    --bg-nav: rgba(4,20,13,0.86);
    --border: rgba(63,156,102,0.24);
    --border-strong: rgba(63,156,102,0.55);
    --border-gold: rgba(205,167,94,0.35);
    --text: #eaf5ee;
    --text-muted: #a9c9b6;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }

  body {
    font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    background: var(--bg-page);
    color: var(--text);
    min-height: 100vh;
    position: relative;
  }

  .bg-video {
    position: fixed;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center 30%;
    z-index: 0;
    pointer-events: none;
  }

  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background: linear-gradient(180deg, rgba(4,20,13,0.5) 0%, rgba(4,20,13,0.58) 45%, rgba(4,20,13,0.72) 100%);
    pointer-events: none;
    z-index: 1;
  }
  body::after {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
    background-size: 256px 256px;
    opacity: 0.5;
    pointer-events: none;
    z-index: 2;
  }

  .page-lang { display: none; position: relative; z-index: 3; }
  body.lang-fr #pf-fr { display: block; }
  body.lang-en #pf-en { display: block; }

  /* ---------- sticky nav ---------- */
  .navbar {
    position: sticky;
    top: 14px;
    z-index: 30;
    display: flex;
    align-items: center;
    gap: 28px;
    width: calc(100% - 32px);
    max-width: 1320px;
    margin: 14px auto 0;
    padding: 10px 24px;
    background: rgba(18,63,43,0.4);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    border: 1px solid rgb(30 139 98);
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.25);
  }
  .nav-brand { display: flex; align-items: center; flex-shrink: 0; }
  .nav-logo { height: 52px; width: auto; display: block; }

  .nav-pills {
    display: flex;
    align-items: center;
    gap: 6px;
    flex: 1;
  }
  .nav-pill {
    flex-shrink: 0;
    font-size: 13px;
    font-weight: 600;
    color: rgba(255,255,255,0.92);
    text-decoration: none;
    padding: 8px 10px;
    border-radius: 8px;
    white-space: nowrap;
    transition: all 0.2s;
  }
  .nav-pill:hover { color: var(--gold-bright); background: rgba(255,255,255,0.07); }

  .nav-item { position: relative; flex-shrink: 0; }
  .nav-item-btn {
    display: flex; align-items: center; gap: 5px;
    flex-shrink: 0;
    font-size: 13px;
    font-weight: 600;
    color: rgba(255,255,255,0.92);
    background: transparent;
    border: none;
    padding: 8px 10px;
    border-radius: 8px;
    white-space: nowrap;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.2s;
  }
  .nav-item-btn i { font-size: 13px; transition: transform 0.2s; }
  .nav-item-btn:hover { color: var(--gold-bright); background: rgba(255,255,255,0.07); }
  .nav-item.open .nav-item-btn i { transform: rotate(180deg); }
  .nav-item.open .nav-item-btn { color: var(--gold-bright); background: rgba(255,255,255,0.07); }

  .nav-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    margin-top: 10px;
    min-width: 230px;
    background: rgba(10,35,24,0.92);
    backdrop-filter: blur(14px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 6px;
    display: none;
    flex-direction: column;
    gap: 2px;
    box-shadow: 0 16px 32px rgba(0,0,0,0.45);
  }
  .nav-item.open .nav-dropdown { display: flex; }
  .nav-dropdown a {
    padding: 9px 12px;
    border-radius: 8px;
    color: rgba(255,255,255,0.85);
    font-size: 13px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.15s;
  }
  .nav-dropdown a:hover { background: rgba(255,255,255,0.08); color: var(--gold-bright); }

  .nav-divider { width: 1px; height: 24px; background: rgba(255,255,255,0.15); flex-shrink: 0; }

  .lang-switch {
    display: flex;
    gap: 10px;
    flex-shrink: 0;
  }
  .lang-btn {
    background: rgba(255,255,255,0.08);
    border: none;
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.2px;
    padding: 10px 22px;
    min-width: 90px;
    border-radius: 8px;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.15s;
    opacity: 0.5;
  }
  .lang-btn[data-lang="fr"] { background: linear-gradient(180deg, #28c48c 0%, #1d9c6e 100%); color: #fff; }
  .lang-btn[data-lang="en"] { background: linear-gradient(180deg, #ffa22e 0%, #e8850a 100%); color: #1a1408; }
  .lang-btn.active { opacity: 1; box-shadow: 0 4px 14px rgba(0,0,0,0.4); }
  .lang-btn:not(.active):hover { opacity: 0.8; }

  .nav-toggle {
    display: none;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    background: transparent;
    border: none;
    color: #fff;
    font-size: 20px;
    cursor: pointer;
    flex-shrink: 0;
    order: 2;
  }

  /* ---------- mobile nav ---------- */
  @media (max-width: 860px) {
    .navbar { flex-wrap: wrap; gap: 12px; padding: 10px 16px; }
    .nav-brand { order: 1; }
    .nav-toggle { display: flex; }
    .nav-divider { display: none; }
    .lang-switch { order: 3; margin-left: auto; }
    .nav-pills {
      display: none;
      order: 4;
      flex-basis: 100%;
      flex-direction: column;
      align-items: stretch;
      gap: 2px;
      margin-top: 10px;
      padding-top: 12px;
      border-top: 1px solid rgba(255,255,255,0.1);
    }
    .navbar.mobile-open .nav-pills { display: flex; }
    .nav-pill, .nav-item { width: 100%; }
    .nav-pill { padding: 10px 8px; }
    .nav-item-btn { width: 100%; justify-content: space-between; padding: 10px 8px; }
    .nav-dropdown {
      position: static;
      margin: 4px 0 4px 12px;
      min-width: 0;
      background: rgba(255,255,255,0.04);
      border: none;
      box-shadow: none;
      backdrop-filter: none;
    }
  }
  @media (max-width: 640px) {
    .nav-logo { height: 40px; }
    .lang-btn { padding: 8px 14px; min-width: 0; }
  }

  /* ---------- hero ---------- */
  .hero {
    position: relative;
    width: 100%;
    text-align: center;
    min-height: clamp(420px, 82vh, 700px);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    padding: 40px 20px 56px;
    overflow: hidden;
  }
  .hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(4,20,13,0) 0%, rgba(4,20,13,0) 55%, rgba(4,20,13,0.45) 80%, rgba(4,20,13,0.85) 100%);
    z-index: 0;
  }
  .hero > * { position: relative; z-index: 1; }

  .hero-fade {
    height: 160px;
    margin-bottom: -160px;
    position: relative;
    z-index: 5;
    background: linear-gradient(180deg, rgba(4,20,13,0.85) 0%, rgba(4,20,13,0.35) 45%, rgba(4,20,13,0) 100%);
    pointer-events: none;
  }

  .server-name {
    font-family: 'Cinzel', serif;
    font-size: 42px;
    font-weight: 700;
    color: var(--gold-bright);
    letter-spacing: 5px;
    text-transform: uppercase;
    text-shadow: 0 2px 16px rgba(0,0,0,0.85), 0 0 40px rgba(205,167,94,0.35), 0 0 90px rgba(63,156,102,0.3);
  }
  .subtitle { font-size: 12px; color: var(--text-muted); margin-top: 10px; letter-spacing: 2.5px; text-transform: uppercase; text-shadow: 0 2px 10px rgba(0,0,0,0.85); }
  .badge-version {
    display: inline-block;
    background: rgba(4,20,13,0.55);
    color: var(--gold-bright);
    border: 0.5px solid var(--gold-dim);
    font-size: 11px;
    font-weight: 500;
    padding: 4px 14px;
    border-radius: 20px;
    margin-top: 16px;
    letter-spacing: 1px;
    backdrop-filter: blur(4px);
    box-shadow: 0 2px 10px rgba(0,0,0,0.4);
  }

  .hero-rule { display: flex; align-items: center; gap: 12px; max-width: 360px; margin: 26px auto 0; }
  .hero-rule::before, .hero-rule::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, transparent, var(--gold) 50%, transparent); opacity: 0.6; }
  .hero-rule .diamond { width: 7px; height: 7px; background: var(--gold-bright); transform: rotate(45deg); box-shadow: 0 0 10px rgba(240,211,138,0.65); flex-shrink: 0; }

  .wrap { max-width: 880px; margin: 0 auto; padding: 0 20px 4rem; }

  /* ---------- content sections ---------- */
  .content-section { padding-top: 2.6rem; scroll-margin-top: 96px; }
  .sec-head { display: flex; align-items: center; gap: 12px; margin-bottom: 1.1rem; }
  .sec-icon-wrap {
    width: 36px; height: 36px; flex-shrink: 0; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, rgba(205,167,94,0.16), rgba(63,156,102,0.28));
    border: 0.5px solid var(--border-strong);
  }
  .sec-icon { font-size: 17px; color: var(--gold-bright); }
  .sec-title { font-family: 'Cinzel', serif; font-size: 17px; font-weight: 600; letter-spacing: 1px; color: var(--text); white-space: nowrap; }
  .sec-count {
    font-size: 10px; color: var(--gold); background: rgba(205,167,94,0.08);
    border: 0.5px solid rgba(205,167,94,0.25); padding: 2px 9px; border-radius: 20px; white-space: nowrap;
  }
  .sec-rule { flex: 1; height: 1px; background: linear-gradient(90deg, var(--border-strong), transparent); }

  .tag-cloud { display: flex; flex-wrap: wrap; gap: 8px; }
  .tag {
    display: flex; align-items: flex-start; gap: 7px;
    background: rgb(0 0 0 / 76%);
    border: 0.5px solid rgb(63 156 102);
    border-radius: 10px;
    padding: 8px 12px;
    font-size: 12.5px;
    line-height: 1.5;
    color: var(--text-muted);
    transition: border-color 0.2s, color 0.2s, background 0.2s;
  }
  .tag:hover { border-color: var(--border-strong); color: var(--text); background: rgba(31,99,63,0.6); }
  .tag::before {
    content: ''; width: 5px; height: 5px; margin-top: 6px; flex-shrink: 0;
    background: var(--gold); transform: rotate(45deg); opacity: 0.8;
  }

  /* ---------- what's new (distinct treatment) ---------- */
  .new-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
  @media (max-width: 620px) { .new-grid { grid-template-columns: 1fr; } }
  .new-card {
    position: relative;
    display: flex; align-items: center; gap: 12px;
    background: linear-gradient(135deg, rgb(34 83 54), rgb(37 93 75 / 7%));
    border: 0.5px solid rgb(63 156 102);
    border-radius: 14px;
    padding: 14px 16px;
    overflow: hidden;
  }
  .new-card::before {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(circle at 15% 15%, rgba(240,211,138,0.15), transparent 60%);
    pointer-events: none;
  }
  .new-icon {
    font-size: 19px; color: var(--gold-bright); flex-shrink: 0;
    width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;
    background: rgba(205,167,94,0.1); border: 0.5px solid var(--border-strong); border-radius: 10px;
  }
  .new-text { display: flex; flex-direction: column; gap: 3px; }
  .new-name { font-size: 13px; font-weight: 600; color: var(--text); letter-spacing: 0.3px; }
  .new-badge {
    font-size: 9px; align-self: flex-start;
    background: rgba(63,156,102,0.22); color: #b9f0d1;
    border: 0.5px solid rgba(63,156,102,0.5);
    padding: 1px 6px; border-radius: 10px; letter-spacing: 0.5px;
  }

  .divider-orn { display: flex; align-items: center; gap: 12px; margin: 2.6rem 0 0; }
  .divider-orn::before, .divider-orn::after { content: ''; flex: 1; height: 1px; background: linear-gradient(90deg, transparent, var(--gold) 50%, transparent); opacity: 0.5; }
  .divider-orn .diamond { width: 7px; height: 7px; background: var(--gold-bright); transform: rotate(45deg); box-shadow: 0 0 10px rgba(240,211,138,0.6); flex-shrink: 0; }

  .footer { text-align: center; font-size: 11px; color: rgba(159,179,160,0.5); letter-spacing: 2px; text-transform: uppercase; margin-top: 2rem; }
</style>
</head>
<body class="lang-fr">
<script>
(function(){
  var saved = 'fr';
  try { saved = localStorage.getItem('au_lang') || 'fr'; } catch (e) {}
  document.body.className = 'lang-' + saved;
})();
</script>

<video class="bg-video" autoplay muted loop playsinline poster="1600_FAQs.jpg">
  <source src="MoPLaunch_Masthead_loop.mp4" type="video/mp4">
</video>

<!-- ============================= FRENCH ============================= -->
<div class="page-lang" id="pf-fr">

  <nav class="navbar">
    <div class="nav-brand">
      <a href="http://azeroth-universe.eu/"><img class="nav-logo" src="LogoAzerothUniverseA.png" alt="Azeroth Universe"></a>
    </div>
    <div class="nav-pills">
      <a class="nav-pill" href="#fr-new">Nouveautés</a>

      <div class="nav-item">
        <button type="button" class="nav-item-btn">Monde <i class="ti ti-chevron-down"></i></button>
        <div class="nav-dropdown">
          <a href="#fr-world">Monde &amp; Contenu</a>
          <a href="#fr-pvp">Donjons, Raids &amp; PvP</a>
          <a href="#fr-mounts">Montures &amp; Familiers</a>
        </div>
      </div>

      <div class="nav-item">
        <button type="button" class="nav-item-btn">Personnage <i class="ti ti-chevron-down"></i></button>
        <div class="nav-dropdown">
          <a href="#fr-progression">Progression</a>
          <a href="#fr-custom">Personnalisation</a>
          <a href="#fr-account">Compte</a>
        </div>
      </div>

      <div class="nav-item">
        <button type="button" class="nav-item-btn">Technique <i class="ti ti-chevron-down"></i></button>
        <div class="nav-dropdown">
          <a href="#fr-gameplay">Gameplay</a>
          <a href="#fr-ui">Interface</a>
          <a href="#fr-engine">Moteur</a>
        </div>
      </div>
    </div>
    <button type="button" class="nav-toggle" aria-label="Menu"><i class="ti ti-menu-2"></i></button>
    <div class="nav-divider"></div>
    <div class="lang-switch">
      <button type="button" class="lang-btn" data-lang="fr">FR</button>
      <button type="button" class="lang-btn" data-lang="en">EN</button>
    </div>
  </nav>

  <div class="hero" id="fr-top">
    <div class="server-name">Azeroth Universe</div>
    <div class="subtitle">Explorez Notre Contenu</div>
    <div class="badge-version"><i class="ti ti-disc"></i> Client 3.3.5</div>
    <div class="hero-rule"><span class="diamond"></span></div>
  </div>
  <div class="hero-fade"></div>

  <div class="wrap">

    <section class="content-section" id="fr-new">
      <div class="sec-head">
        <div class="sec-icon-wrap"><i class="ti ti-sparkles sec-icon"></i></div>
        <span class="sec-title">Nouveautés</span>
        <span class="sec-count">7</span>
        <span class="sec-rule"></span>
      </div>
      <div class="new-grid">
        <div class="new-card"><div class="new-icon"><i class="ti ti-arrow-big-up-lines"></i></div><div class="new-text"><span class="new-name">Mise à Niveau de l'Équipement</span><span class="new-badge">NOUVEAU</span></div></div>
        <div class="new-card"><div class="new-icon"><i class="ti ti-heart-plus"></i></div><div class="new-text"><span class="new-name">Résurrection</span><span class="new-badge">NOUVEAU</span></div></div>
        <div class="new-card"><div class="new-icon"><i class="ti ti-message-circle"></i></div><div class="new-text"><span class="new-name">Interface de Dialogue</span><span class="new-badge">NOUVEAU</span></div></div>
        <div class="new-card"><div class="new-icon"><i class="ti ti-robot"></i></div><div class="new-text"><span class="new-name">Système de Bot</span><span class="new-badge">NOUVEAU</span></div></div>
        <div class="new-card"><div class="new-icon"><i class="ti ti-moon"></i></div><div class="new-text"><span class="new-name">Hôtel des Ventes au Marché Noir</span><span class="new-badge">NOUVEAU</span></div></div>
        <div class="new-card"><div class="new-icon"><i class="ti ti-target"></i></div><div class="new-text"><span class="new-name">Points de Combo (Voleur / Druide)</span><span class="new-badge">NOUVEAU</span></div></div>
        <div class="new-card" style="grid-column: 1 / -1;"><div class="new-icon"><i class="ti ti-hourglass"></i></div><div class="new-text"><span class="new-name">Le Temps de Chromie</span><span class="new-badge">NOUVEAU</span></div></div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="fr-world">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-world sec-icon"></i></div><span class="sec-title">Monde &amp; Contenu</span><span class="sec-count">9</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Azeroth Cataclysm (remplace l'Azeroth WotLK d'origine)</div>
        <div class="tag">Continent de Pandarie</div>
        <div class="tag">Quêtes de Mists of Pandaria</div>
        <div class="tag">Niveau Maximum 90</div>
        <div class="tag">31 Races Jouables</div>
        <div class="tag">24 Classes Jouables</div>
        <div class="tag">Classes Portées (Moine, Chasseur de Démons, Évocateur)</div>
        <div class="tag">Classes 100% Personnalisées (Mage de Guerre du Sang, Héros)</div>
        <div class="tag">Spécialisations Prestige Personnalisées (Pyromancien, Géomancien, Chronomancien, Empoisonneur, Nécromancien, Ravageur du Chaos, Maître des Bêtes, Chevalier)</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="fr-progression">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-sword sec-icon"></i></div><span class="sec-title">Progression</span><span class="sec-count">10</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Système de Paragon</div>
        <div class="tag">Système de Rebirth</div>
        <div class="tag">Armes Artéfacts (A0 → A8)</div>
        <div class="tag">Améliorations d'Armes Artéfacts</div>
        <div class="tag">Équipement Héroïque (S0 → S8)</div>
        <div class="tag">Équipement Mythique (S0 → M+8)</div>
        <div class="tag">Mythique+ Complet (M+FULL)</div>
        <div class="tag">Difficulté de Raid Mythique</div>
        <div class="tag">Donjons Mythique+</div>
        <div class="tag">Plafonds de Statistiques Supprimés</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="fr-pvp">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-shield sec-icon"></i></div><span class="sec-title">Donjons, Raids &amp; PvP</span><span class="sec-count">5</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Donjons &amp; Raids Personnalisés</div>
        <div class="tag">Codex des Rencontres (Guide d'Aventure)</div>
        <div class="tag">Tableau d'Appel du Héros</div>
        <div class="tag">Arène 1c1</div>
        <div class="tag">Nouvelles Arènes &amp; Champs de Bataille (Arène Tol'Viron, Temple de Kotmogu, Les Pics Jumeaux, Le Croc du Tigre, Bataille de Gilnéas)</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="fr-custom">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-palette sec-icon"></i></div><span class="sec-title">Personnalisation</span><span class="sec-count">8</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Transmogrification</div>
        <div class="tag">Retouche (Reforging)</div>
        <div class="tag">Système d'Amélioration d'Équipement</div>
        <div class="tag">Collection d'Apparences (Garde-Robe)</div>
        <div class="tag">Zone Cosmétique</div>
        <div class="tag">Collections</div>
        <div class="tag">PNJ d'Habillage (DressNPC)</div>
        <div class="tag">Marchand de Présentation Transmog</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="fr-mounts">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-paw sec-icon"></i></div><span class="sec-title">Montures &amp; Familiers</span><span class="sec-count">5</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Montures Volantes en Azeroth &amp; Pandarie</div>
        <div class="tag">Toutes les Montures WotLK et plus</div>
        <div class="tag">Journal des Montures (compte entier)</div>
        <div class="tag">Tous les Familiers de Combat WotLK et plus</div>
        <div class="tag">Journal des Familiers (compte entier)</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="fr-account">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-trophy sec-icon"></i></div><span class="sec-title">Compte</span><span class="sec-count">3</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">20 Personnages par Royaume</div>
        <div class="tag">Hauts Faits (compte entier)</div>
        <div class="tag">Grimoires d'Identité &amp; de Conversion</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="fr-gameplay">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-settings sec-icon"></i></div><span class="sec-title">Gameplay</span><span class="sec-count">13</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Ramassage de Butin en Zone</div>
        <div class="tag">Recherche de Groupe en Solo</div>
        <div class="tag">SoloCraft</div>
        <div class="tag">MultiTrainer</div>
        <div class="tag">MultiVendor</div>
        <div class="tag">Système de Bot PNJ</div>
        <div class="tag">Système de Modèles PNJ</div>
        <div class="tag">Téléporteur</div>
        <div class="tag">Modificateur de Taux d'XP</div>
        <div class="tag">XP Weekend</div>
        <div class="tag">Boutique Sans Pay-to-Win</div>
        <div class="tag">Boutique en Jeu</div>
        <div class="tag">Événements</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="fr-ui">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-device-desktop sec-icon"></i></div><span class="sec-title">Interface</span><span class="sec-count">5</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Interface Dragonflight</div>
        <div class="tag">Système de Talents Personnalisé</div>
        <div class="tag">Écran de Connexion Multi-Extensions</div>
        <div class="tag">Sélection &amp; Création de Personnage Personnalisées</div>
        <div class="tag">Infobulles Mythiques</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="fr-engine">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-tool sec-icon"></i></div><span class="sec-title">Moteur</span><span class="sec-count">5</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Moteur Eluna Lua</div>
        <div class="tag">Rechargement des Modèles Créature / Objet / GameObject</div>
        <div class="tag">Mise à l'Échelle des GameObjects (GobjScale)</div>
        <div class="tag">Déplacement des GameObjects (GoMove)</div>
        <div class="tag">Phase 0</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>
    <div class="footer">Azeroth Universe</div>

  </div>
</div>

<!-- ============================== ENGLISH ============================== -->
<div class="page-lang" id="pf-en">

  <nav class="navbar">
    <div class="nav-brand">
      <a href="http://azeroth-universe.eu/"><img class="nav-logo" src="LogoAzerothUniverseA.png" alt="Azeroth Universe"></a>
    </div>
    <div class="nav-pills">
      <a class="nav-pill" href="#en-new">What's New</a>

      <div class="nav-item">
        <button type="button" class="nav-item-btn">World <i class="ti ti-chevron-down"></i></button>
        <div class="nav-dropdown">
          <a href="#en-world">World &amp; Content</a>
          <a href="#en-pvp">Dungeons, Raids &amp; PvP</a>
          <a href="#en-mounts">Mounts &amp; Pets</a>
        </div>
      </div>

      <div class="nav-item">
        <button type="button" class="nav-item-btn">Character <i class="ti ti-chevron-down"></i></button>
        <div class="nav-dropdown">
          <a href="#en-progression">Progression</a>
          <a href="#en-custom">Customization</a>
          <a href="#en-account">Account</a>
        </div>
      </div>

      <div class="nav-item">
        <button type="button" class="nav-item-btn">Technical <i class="ti ti-chevron-down"></i></button>
        <div class="nav-dropdown">
          <a href="#en-gameplay">Gameplay</a>
          <a href="#en-ui">Interface</a>
          <a href="#en-engine">Engine</a>
        </div>
      </div>
    </div>
    <button type="button" class="nav-toggle" aria-label="Menu"><i class="ti ti-menu-2"></i></button>
    <div class="nav-divider"></div>
    <div class="lang-switch">
      <button type="button" class="lang-btn" data-lang="fr">FR</button>
      <button type="button" class="lang-btn" data-lang="en">EN</button>
    </div>
  </nav>

  <div class="hero" id="en-top">
    <div class="server-name">Azeroth Universe</div>
    <div class="subtitle">Explore Our Content</div>
    <div class="badge-version"><i class="ti ti-disc"></i> Client 3.3.5</div>
    <div class="hero-rule"><span class="diamond"></span></div>
  </div>
  <div class="hero-fade"></div>

  <div class="wrap">

    <section class="content-section" id="en-new">
      <div class="sec-head">
        <div class="sec-icon-wrap"><i class="ti ti-sparkles sec-icon"></i></div>
        <span class="sec-title">What's New</span>
        <span class="sec-count">7</span>
        <span class="sec-rule"></span>
      </div>
      <div class="new-grid">
        <div class="new-card"><div class="new-icon"><i class="ti ti-arrow-big-up-lines"></i></div><div class="new-text"><span class="new-name">Gear Upgrade</span><span class="new-badge">NEW</span></div></div>
        <div class="new-card"><div class="new-icon"><i class="ti ti-heart-plus"></i></div><div class="new-text"><span class="new-name">Resurrection</span><span class="new-badge">NEW</span></div></div>
        <div class="new-card"><div class="new-icon"><i class="ti ti-message-circle"></i></div><div class="new-text"><span class="new-name">Dialogue Interface</span><span class="new-badge">NEW</span></div></div>
        <div class="new-card"><div class="new-icon"><i class="ti ti-robot"></i></div><div class="new-text"><span class="new-name">Bot System</span><span class="new-badge">NEW</span></div></div>
        <div class="new-card"><div class="new-icon"><i class="ti ti-moon"></i></div><div class="new-text"><span class="new-name">Black Market Auction House</span><span class="new-badge">NEW</span></div></div>
        <div class="new-card"><div class="new-icon"><i class="ti ti-target"></i></div><div class="new-text"><span class="new-name">Combo Points System (Rogue / Druid)</span><span class="new-badge">NEW</span></div></div>
        <div class="new-card" style="grid-column: 1 / -1;"><div class="new-icon"><i class="ti ti-hourglass"></i></div><div class="new-text"><span class="new-name">Chromie Time</span><span class="new-badge">NEW</span></div></div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="en-world">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-world sec-icon"></i></div><span class="sec-title">World &amp; Content</span><span class="sec-count">9</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Cataclysm Azeroth (replaces the original WotLK Azeroth)</div>
        <div class="tag">Pandaria Continent</div>
        <div class="tag">Mists of Pandaria Questlines</div>
        <div class="tag">Max Level 90</div>
        <div class="tag">31 Playable Races</div>
        <div class="tag">24 Playable Classes</div>
        <div class="tag">Ported Classes (Monk, Demon Hunter, Evoker)</div>
        <div class="tag">Fully Custom Classes (Blood Battle Mage, Hero)</div>
        <div class="tag">Custom Prestige Specializations (Pyromancer, Geomancer, Chronomancer, Venomancer, Necromancer, Chaos Ravager, Beastmaster, Knight)</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="en-progression">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-sword sec-icon"></i></div><span class="sec-title">Progression</span><span class="sec-count">10</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Paragon System</div>
        <div class="tag">Rebirth System</div>
        <div class="tag">Artifact Weapons (A0 → A8)</div>
        <div class="tag">Artifact Weapon Upgrades</div>
        <div class="tag">Heroic Gear (S0 → S8)</div>
        <div class="tag">Mythic Gear (S0 → M+8)</div>
        <div class="tag">Full Mythic+ (M+FULL)</div>
        <div class="tag">Mythic Raid Difficulty</div>
        <div class="tag">Mythic+ Dungeons</div>
        <div class="tag">Removed Stat Caps</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="en-pvp">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-shield sec-icon"></i></div><span class="sec-title">Dungeons, Raids &amp; PvP</span><span class="sec-count">5</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Custom Dungeons &amp; Raids</div>
        <div class="tag">Codex Encounter Journal (Adventure Guide)</div>
        <div class="tag">Hero's Call Board</div>
        <div class="tag">1v1 Arena</div>
        <div class="tag">New Arenas &amp; Battlegrounds (Tol'viron Arena, Temple of Kotmogu, Twin Peaks, The Tiger's Peak, Battle for Gilneas)</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="en-custom">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-palette sec-icon"></i></div><span class="sec-title">Customization</span><span class="sec-count">8</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Transmogrification</div>
        <div class="tag">Reforging</div>
        <div class="tag">Item Upgrade System</div>
        <div class="tag">Appearance Collection (Wardrobe)</div>
        <div class="tag">Cosmetic Zone</div>
        <div class="tag">Collections</div>
        <div class="tag">DressNPC</div>
        <div class="tag">Transmog Display Vendor</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="en-mounts">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-paw sec-icon"></i></div><span class="sec-title">Mounts &amp; Battle Pets</span><span class="sec-count">5</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Flying Mounts in Azeroth &amp; Pandaria</div>
        <div class="tag">All WotLK+ Mounts</div>
        <div class="tag">Account-wide Mount Journal</div>
        <div class="tag">All WotLK+ Battle Pets</div>
        <div class="tag">Account-wide Pet Journal</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="en-account">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-trophy sec-icon"></i></div><span class="sec-title">Account Features</span><span class="sec-count">3</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">20 Characters per Realm</div>
        <div class="tag">Account-wide Achievements</div>
        <div class="tag">Identity &amp; Conversion Grimoires</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="en-gameplay">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-settings sec-icon"></i></div><span class="sec-title">Gameplay</span><span class="sec-count">13</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Zone-wide Loot Pickup</div>
        <div class="tag">Solo LFG</div>
        <div class="tag">SoloCraft</div>
        <div class="tag">MultiTrainer</div>
        <div class="tag">MultiVendor</div>
        <div class="tag">NPC Bot System</div>
        <div class="tag">NPC Template System</div>
        <div class="tag">Teleporter</div>
        <div class="tag">XP Rate Modifier</div>
        <div class="tag">Weekend XP</div>
        <div class="tag">No Pay-to-Win Shop</div>
        <div class="tag">In-Game Shop</div>
        <div class="tag">Events</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="en-ui">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-device-desktop sec-icon"></i></div><span class="sec-title">Interface</span><span class="sec-count">5</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Dragonflight UI</div>
        <div class="tag">Custom Talent System</div>
        <div class="tag">Multi Expansion Login Screen</div>
        <div class="tag">Custom Character Selection &amp; Creation</div>
        <div class="tag">Mythic Tooltips</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>

    <section class="content-section" id="en-engine">
      <div class="sec-head"><div class="sec-icon-wrap"><i class="ti ti-tool sec-icon"></i></div><span class="sec-title">Engine</span><span class="sec-count">5</span><span class="sec-rule"></span></div>
      <div class="tag-cloud">
        <div class="tag">Eluna Lua Engine</div>
        <div class="tag">Reload Creature, Item &amp; GameObject Templates</div>
        <div class="tag">GameObject Scaling (GobjScale)</div>
        <div class="tag">GameObject Movement (GoMove)</div>
        <div class="tag">Phase 0</div>
      </div>
    </section>

    <div class="divider-orn"><span class="diamond"></span></div>
    <div class="footer">Azeroth Universe</div>

  </div>
</div>

<script>
(function(){
  function setLang(l){
    document.body.className = 'lang-' + l;
    document.getElementById('html-root').setAttribute('lang', l);
    document.querySelectorAll('.lang-btn').forEach(function(b){
      b.classList.toggle('active', b.dataset.lang === l);
    });
    try { localStorage.setItem('au_lang', l); } catch (e) {}
  }
  document.querySelectorAll('.lang-btn').forEach(function(b){
    b.addEventListener('click', function(){ setLang(b.dataset.lang); });
  });
  var current = document.body.className.replace('lang-', '') || 'fr';
  setLang(current);

  document.querySelectorAll('.nav-item-btn').forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.stopPropagation();
      var item = btn.closest('.nav-item');
      var wasOpen = item.classList.contains('open');
      document.querySelectorAll('.nav-item.open').forEach(function(i){ i.classList.remove('open'); });
      if (!wasOpen) item.classList.add('open');
    });
  });
  document.addEventListener('click', function(){
    document.querySelectorAll('.nav-item.open').forEach(function(i){ i.classList.remove('open'); });
  });

  document.querySelectorAll('.nav-toggle').forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.stopPropagation();
      btn.closest('.navbar').classList.toggle('mobile-open');
    });
  });
  document.querySelectorAll('.nav-pills a, .nav-pill').forEach(function(link){
    link.addEventListener('click', function(){
      var navbar = link.closest('.navbar');
      if (navbar) navbar.classList.remove('mobile-open');
      document.querySelectorAll('.nav-item.open').forEach(function(i){ i.classList.remove('open'); });
    });
  });
})();
</script>

</body>
</html>
