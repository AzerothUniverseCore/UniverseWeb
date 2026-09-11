<?php
$copyrightYear = date('Y');
?>
<!DOCTYPE html>
<html lang="fr" id="html-root">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Grimoire d'Azeroth Universe</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700&family=Cinzel+Decorative:wght@700&family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">
<style>
  :root {
    --stage: #000000;
    --stage-2: #0a2818;
    --gold: #c9a227;
    --gold-bright: #f2d788;
    --gold-dim: #7a5f1f;
    --bronze: #8a5a2b;
    --bronze-dark: #4f2f14;
    --leather: #3d160e;
    --leather-dark: #200a06;
    --leather-light: #5c2414;
    --navy: #0e2436;
    --navy-deep: #081722;
    --parchment: #e9c583;
    --parchment-2: #d9a860;
    --parchment-shadow: #a97a3e;
    --parchment-burn: #6b4a22;
    --ink: #3a2410;
    --ink-soft: #5c4020;
    --seal: #7a1f1f;
    --ribbon: #7c1420;
    --ribbon-dark: #490b13;
    --corner-svg: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath d='M6,58 C6,30 30,6 58,6' fill='none' stroke='%234f2f14' stroke-width='9' stroke-linecap='round'/%3E%3Cpath d='M6,58 C6,30 30,6 58,6' fill='none' stroke='%23c9a227' stroke-width='4' stroke-linecap='round'/%3E%3Cpath d='M15,46 Q24,36 19,21 Q30,29 35,15' fill='none' stroke='%23f2d788' stroke-width='2.5' stroke-linecap='round' opacity='0.85'/%3E%3Cpath d='M22,54 Q34,48 34,34' fill='none' stroke='%23f2d788' stroke-width='2' stroke-linecap='round' opacity='0.6'/%3E%3Ccircle cx='58' cy='6' r='5' fill='%23f2d788'/%3E%3Ccircle cx='58' cy='6' r='2' fill='%237a1f1f'/%3E%3Ccircle cx='6' cy='58' r='5' fill='%23f2d788'/%3E%3Ccircle cx='6' cy='58' r='2' fill='%237a1f1f'/%3E%3C/svg%3E");
  }

  * { box-sizing: border-box; }
  html, body { margin: 0; padding: 0; }

  body {
    min-height: 100vh;
    background:
      radial-gradient(ellipse at 50% 20%, rgb(156 63 63 / 10%), transparent 60%),
      radial-gradient(ellipse at 50% 100%, rgba(0,0,0,0.55), transparent 55%),
      var(--stage);
    color: var(--parchment);
    font-family: 'EB Garamond', Georgia, serif;
    overflow-x: hidden;
    position: relative;
  }

  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.05'/%3E%3C/svg%3E");
    background-size: 256px 256px;
    pointer-events: none;
    z-index: 1;
  }

  h1, h2, h3, .display {
    font-family: 'Cinzel', serif;
    letter-spacing: 0.5px;
  }

  /* ---------- top bar ---------- */
  .topbar {
    position: fixed;
    top: 16px;
    right: 16px;
    z-index: 60;
    display: flex;
    gap: 10px;
    align-items: center;
  }
  .lang-switch { display: flex; gap: 6px; background: rgba(4,20,13,0.55); border: 1px solid var(--gold-dim); border-radius: 20px; padding: 4px; backdrop-filter: blur(6px); }
  .lang-btn {
    font-family: 'Cinzel', serif;
    background: transparent;
    border: none;
    color: rgba(240,211,138,0.55);
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 1px;
    padding: 6px 12px;
    border-radius: 16px;
    cursor: pointer;
  }
  .lang-btn.active { background: linear-gradient(180deg, var(--gold-bright), var(--gold)); color: #2a1708; }

  .home-link {
    display: flex; align-items: center; justify-content: center;
    width: 34px; height: 34px; border-radius: 50%;
    background: rgba(4,20,13,0.55); border: 1px solid var(--gold-dim);
    color: var(--gold-bright); text-decoration: none; font-size: 15px;
  }

  /* ---------- stage ---------- */
  .stage {
    position: relative;
    z-index: 2;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 90px 16px 48px;
  }

  /* ============================================================
     COVER
     ============================================================ */
  .cover {
    width: min(92vw, 460px);
    aspect-ratio: 3 / 4.1;
    background:
      linear-gradient(155deg, var(--leather-light) 0%, var(--leather) 45%, var(--leather-dark) 100%);
    border-radius: 10px 16px 16px 10px;
    box-shadow:
      0 30px 70px rgba(0,0,0,0.6),
      inset 0 0 0 2px rgba(205,167,94,0.35),
      inset 0 0 40px rgba(0,0,0,0.5);
    position: relative;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 8%;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    border: 1px solid rgba(0,0,0,0.4);
  }
  .cover:hover { transform: translateY(-6px) rotateX(2deg); box-shadow: 0 40px 80px rgba(0,0,0,0.65), inset 0 0 0 2px rgba(240,211,138,0.5), inset 0 0 40px rgba(0,0,0,0.5); }
  .cover::before {
    content: '';
    position: absolute; inset: 5.5%;
    border: 1.5px solid rgba(205,167,94,0.55);
    border-radius: 6px 12px 12px 6px;
    pointer-events: none;
  }
  .cover::after {
    content: '';
    position: absolute; left: 0; top: 0; bottom: 0; width: 14px;
    background: linear-gradient(90deg, rgba(0,0,0,0.55), transparent);
    border-radius: 10px 0 0 10px;
  }
  .cover-emblem {
    width: min(58%, 168px);
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
  }
  .cover-emblem::before {
    content: '';
    position: absolute;
    left: 50%; top: 50%;
    width: 190%; height: 190%;
    transform: translate(-50%, -50%);
    background: radial-gradient(ellipse at 50% 45%, rgba(14,36,54,0.55), transparent 65%);
    z-index: -1;
  }
  .cover-emblem img {
    display: block;
    width: 100%;
    height: auto;
    filter: drop-shadow(0 6px 14px rgba(0,0,0,0.65)) drop-shadow(0 0 20px rgba(201,162,39,0.3));
  }
  .cover-title {
    font-family: 'Cinzel Decorative', 'Cinzel', serif;
    font-size: clamp(22px, 5.5vw, 32px);
    color: var(--gold-bright);
    text-shadow: 0 2px 10px rgba(0,0,0,0.6);
    line-height: 1.25;
    z-index: 1;
  }
  .cover-sub {
    margin-top: 10px;
    font-size: 13px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: rgba(240,211,138,0.6);
    z-index: 1;
  }
  .cover-hint {
    margin-top: 34px;
    font-size: 13px;
    font-style: italic;
    color: rgba(236,220,180,0.55);
    z-index: 1;
  }
  .cover-corner {
    position: absolute; width: 52px; height: 52px;
    background-image: var(--corner-svg);
    background-size: contain;
    background-repeat: no-repeat;
    opacity: 0.92;
    pointer-events: none;
  }
  .cover-corner.tl { top: 3%; left: 3%; }
  .cover-corner.tr { top: 3%; right: 3%; transform: scaleX(-1); }
  .cover-corner.bl { bottom: 3%; left: 3%; transform: scaleY(-1); }
  .cover-corner.br { bottom: 3%; right: 3%; transform: scale(-1,-1); }

  /* smaller version reused on the open pages / TOC panel */
  .page-corner {
    position: absolute; width: 34px; height: 34px;
    background-image: var(--corner-svg);
    background-size: contain;
    background-repeat: no-repeat;
    opacity: 0.85;
    pointer-events: none;
    z-index: 2;
  }
  .page-corner.tl { top: 5px; left: 5px; }
  .page-corner.tr { top: 5px; right: 5px; transform: scaleX(-1); }
  .page-corner.bl { bottom: 5px; left: 5px; transform: scaleY(-1); }
  .page-corner.br { bottom: 5px; right: 5px; transform: scale(-1,-1); }

  #cover-screen.hidden, #book-screen.hidden { display: none; }

  /* ============================================================
     BOOK
     ============================================================ */
  .book-wrap { display: flex; flex-direction: column; align-items: center; gap: 18px; width: 100%; }

  .book {
    position: relative;
    width: min(94vw, 980px);
    aspect-ratio: 16 / 9.5;
    max-height: 78vh;
    perspective: 2600px;
  }

  .book-shell {
    position: absolute; inset: -16px;
    background: linear-gradient(155deg, var(--leather-light), var(--leather) 50%, var(--leather-dark));
    border-radius: 14px;
    box-shadow: 0 34px 80px rgba(0,0,0,0.65), inset 0 0 0 2px rgba(205,167,94,0.3);
    z-index: 0;
  }
  .book-spine {
    position: absolute; left: 50%; top: -16px; bottom: -16px; width: 26px;
    transform: translateX(-50%);
    background: linear-gradient(90deg, rgba(0,0,0,0.45), rgba(0,0,0,0.05) 30%, rgba(0,0,0,0.05) 70%, rgba(0,0,0,0.45));
    z-index: 5;
    pointer-events: none;
  }
  .book-ribbon {
    position: absolute; left: 50%; top: -14px; width: 22px; height: 34%;
    min-height: 90px;
    transform: translateX(-50%);
    background: linear-gradient(180deg, var(--ribbon) 0%, var(--ribbon-dark) 92%);
    clip-path: polygon(0 0, 100% 0, 100% 86%, 50% 100%, 0 86%);
    box-shadow: 0 8px 16px rgba(0,0,0,0.5), inset 1px 0 0 rgba(255,255,255,0.12), inset -1px 0 0 rgba(0,0,0,0.35);
    z-index: 6;
    pointer-events: none;
  }
  .book-ribbon::before {
    content: '';
    position: absolute; inset: 12px 4px 20px;
    background: repeating-linear-gradient(180deg, rgba(242,215,136,0.4) 0 2px, transparent 2px 13px);
    opacity: 0.7;
  }
  .book-ribbon::after {
    content: '';
    position: absolute; left: 50%; top: 8px; width: 10px; height: 10px;
    transform: translateX(-50%) rotate(45deg);
    background: var(--gold);
    box-shadow: 0 0 0 1px rgba(0,0,0,0.4);
  }

  .leftPanel, .rightStack { position: absolute; top: 0; height: 100%; width: 50%; }
  .leftPanel { left: 0; z-index: 500; }
  .rightStack { right: 0; transform-style: preserve-3d; }

  .leftPanel-inner {
    position: absolute; inset: 6px 4px 6px 10px;
    background:
      radial-gradient(ellipse at 75% 85%, rgba(107,74,34,0.18), transparent 50%),
      radial-gradient(ellipse at 15% 15%, rgba(255,241,204,0.22), transparent 45%),
      radial-gradient(ellipse at 30% 0%, rgba(255,255,255,0.10), transparent 55%),
      linear-gradient(120deg, var(--parchment), var(--parchment-2) 60%, var(--parchment-shadow));
    border-radius: 3px 10px 10px 3px;
    box-shadow: inset 0 0 46px rgba(107,74,34,0.4), inset 0 0 90px rgba(107,74,34,0.18), 2px 0 10px rgba(0,0,0,0.3);
    padding: 28px 22px 22px;
    overflow-y: auto;
    color: var(--ink);
  }
  .toc-title {
    font-size: clamp(14px, 2.2vw, 19px);
    color: var(--seal);
    text-align: center;
    margin: 0 0 4px;
    letter-spacing: 1px;
  }
  .toc-rule { height: 1px; background: linear-gradient(90deg, transparent, var(--gold-dim), transparent); margin: 10px 0 14px; }
  .toc-list { list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 3px; }
  .toc-item {
    display: flex; align-items: baseline; gap: 8px;
    font-size: clamp(11.5px, 1.7vw, 14px);
    padding: 6px 8px;
    border-radius: 4px;
    cursor: pointer;
    color: var(--ink-soft);
    transition: background 0.15s, color 0.15s;
    line-height: 1.3;
  }
  .toc-item:hover { background: rgba(122,31,31,0.08); color: var(--ink); }
  .toc-item.current { background: rgba(122,31,31,0.14); color: var(--seal); font-weight: 600; }
  .toc-num { font-family: 'Cinzel', serif; font-size: 0.85em; color: var(--gold-dim); flex-shrink: 0; min-width: 1.4em; }

  .rightStack .page {
    position: absolute; inset: 0;
    transform-style: preserve-3d;
    transform-origin: left center;
    transition: transform 0.9s cubic-bezier(0.45, 0.05, 0.55, 0.95);
  }
  .rightStack .page.flipped { transform: rotateY(-178deg); }

  .face {
    position: absolute; inset: 6px 10px 6px 4px;
    backface-visibility: hidden;
    border-radius: 10px 3px 3px 10px;
    overflow: hidden;
  }
  .face.front {
    background:
      radial-gradient(ellipse at 20% 90%, rgba(107,74,34,0.2), transparent 50%),
      radial-gradient(ellipse at 85% 10%, rgba(255,241,204,0.2), transparent 45%),
      radial-gradient(ellipse at 70% 0%, rgba(255,255,255,0.10), transparent 55%),
      linear-gradient(240deg, var(--parchment), var(--parchment-2) 60%, var(--parchment-shadow));
    box-shadow: inset 0 0 46px rgba(107,74,34,0.4), inset 0 0 90px rgba(107,74,34,0.18), -2px 0 10px rgba(0,0,0,0.3);
  }
  .face.back {
    transform: rotateY(180deg);
    background:
      radial-gradient(ellipse at 30% 100%, rgba(0,0,0,0.12), transparent 55%),
      linear-gradient(60deg, var(--parchment-shadow), var(--parchment-2) 55%, var(--parchment));
    box-shadow: inset 0 0 46px rgba(107,74,34,0.35);
    display: flex; align-items: center; justify-content: center;
  }
  .face.back .seal {
    width: 78px; height: 78px; border-radius: 50%;
    background: radial-gradient(circle at 35% 30%, var(--gold-bright), var(--bronze) 65%, var(--bronze-dark) 100%);
    border: 2px solid var(--gold-dim);
    box-shadow: 0 4px 14px rgba(0,0,0,0.45), inset 0 0 0 3px rgba(32,10,6,0.35);
    display: flex; align-items: center; justify-content: center;
    color: var(--leather-dark); font-size: 28px;
    opacity: 0.92;
  }

  .page-content { position: absolute; inset: 0; padding: 28px 24px 18px; overflow-y: auto; color: var(--ink); }
  .page-icon {
    width: 40px; height: 40px; border-radius: 50%;
    background: radial-gradient(circle at 35% 30%, var(--gold-bright), var(--gold) 65%, var(--gold-dim));
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; color: var(--leather-dark);
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
    flex-shrink: 0;
  }
  .page-head { display: flex; align-items: center; gap: 12px; margin-bottom: 4px; }
  .page-kicker { font-size: 11px; letter-spacing: 2px; text-transform: uppercase; color: var(--gold-dim); margin: 0; }
  .page-title { font-size: clamp(16px, 2.6vw, 21px); color: var(--seal); margin: 2px 0 0; line-height: 1.2; }
  .page-rule { height: 1px; background: linear-gradient(90deg, var(--gold-dim), transparent); margin: 12px 0 14px; }
  .page-body { font-size: clamp(13px, 1.85vw, 16px); line-height: 1.62; color: var(--ink); }
  .page-body::first-letter {
    font-family: 'Cinzel Decorative', serif;
    font-size: 2.5em;
    float: left;
    line-height: 0.85;
    padding: 0.05em 0.08em 0 0;
    color: var(--seal);
  }
  .page-num { position: absolute; bottom: 10px; right: 18px; font-family: 'Cinzel', serif; font-size: 11px; color: var(--gold-dim); }

  /* ---------- controls ---------- */
  .controls {
    display: flex; align-items: center; gap: 2px;
    background: linear-gradient(180deg, var(--bronze) 0%, var(--bronze-dark) 100%);
    border: 2px solid var(--gold-dim);
    border-radius: 10px;
    padding: 7px 9px;
    box-shadow:
      0 14px 28px rgba(0,0,0,0.55),
      inset 0 1px 0 rgba(255,255,255,0.18),
      inset 0 -3px 6px rgba(0,0,0,0.45);
  }
  .nav-btn {
    width: 36px; height: 36px; border-radius: 6px;
    background: linear-gradient(180deg, var(--gold-bright), var(--gold) 60%, var(--gold-dim));
    color: var(--leather-dark);
    border: 1px solid rgba(32,10,6,0.55); cursor: pointer;
    font-size: 15px;
    display: flex; align-items: center; justify-content: center;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.55), 0 3px 8px rgba(0,0,0,0.4);
    transition: transform 0.15s, opacity 0.15s;
  }
  .nav-btn:hover:not(:disabled) { transform: translateY(-2px); }
  .nav-btn:disabled { opacity: 0.35; cursor: default; }
  .page-counter {
    font-family: 'Cinzel', serif; font-size: 12.5px; letter-spacing: 1px;
    color: var(--ink);
    min-width: 76px; text-align: center;
    margin: 0 8px;
    padding: 8px 10px;
    background: linear-gradient(160deg, var(--parchment), var(--parchment-2));
    border: 1px solid var(--gold-dim);
    border-radius: 5px;
    box-shadow: inset 0 2px 5px rgba(107,74,34,0.5), inset 0 -1px 0 rgba(255,255,255,0.25);
  }
  .toc-toggle {
    display: none;
    font-family: 'Cinzel', serif; font-size: 12px; letter-spacing: 1px;
    background: rgba(4,20,13,0.55); color: var(--gold-bright);
    border: 1px solid var(--gold-dim); border-radius: 20px;
    padding: 8px 16px; cursor: pointer;
  }

  /* ---------- responsive: narrow screens -> TOC becomes a drawer ---------- */
  @media (max-width: 760px) {
    .book { aspect-ratio: 3 / 4.3; max-height: 70vh; }
    .leftPanel {
      width: min(78vw, 320px);
      left: 0;
      transform: translateX(-104%);
      transition: transform 0.35s ease;
      z-index: 700;
    }
    .leftPanel.open { transform: translateX(0); }
    .rightStack { width: 100%; left: 0; right: 0; }
    .book-spine { display: none; }
    .book-ribbon { display: none; }
    .toc-toggle { display: inline-block; }
    .leftPanel-inner { box-shadow: 4px 0 24px rgba(0,0,0,0.5); border-radius: 3px 10px 10px 3px; }
  }

  @media (max-width: 420px) {
    .page-content { padding: 18px 16px 14px; }
    .cover { aspect-ratio: 3 / 4.4; }
  }

  .stage { padding-block: 90px 32px; }
</style>
</head>
<body class="lang-fr">

<div class="topbar">
  <button type="button" class="toc-toggle" id="tocToggle">Sommaire</button>
  <div class="lang-switch">
    <button type="button" class="lang-btn" data-lang="fr">FR</button>
    <button type="button" class="lang-btn" data-lang="en">EN</button>
  </div>
  <a class="home-link" href="index.php" title="Retour a l'accueil">&#8962;</a>
</div>

<div class="stage">

  <!-- ============================== COVER ============================== -->
  <div id="cover-screen">
    <div class="cover" id="coverOpen">
      <span class="cover-corner tl"></span><span class="cover-corner tr"></span>
      <span class="cover-corner bl"></span><span class="cover-corner br"></span>
      <div class="cover-emblem"><img src="LogoAzerothUniverseA.png" alt="Azeroth Universe"></div>
      <div class="cover-title" data-i18n="cover_title">Grimoire<br>d'Azeroth Universe</div>
      <div class="cover-sub" data-i18n="cover_sub">Chroniques du royaume</div>
      <div class="cover-hint" data-i18n="cover_hint">— touchez la couverture pour l'ouvrir —</div>
    </div>
  </div>

  <!-- ============================== BOOK ================================ -->
  <div id="book-screen" class="hidden">
    <div class="book-wrap">
      <div class="book" id="book">
        <div class="book-shell"></div>
        <div class="book-spine"></div>
        <div class="book-ribbon"></div>

        <div class="leftPanel" id="leftPanel">
          <div class="leftPanel-inner">
            <span class="page-corner tl"></span><span class="page-corner tr"></span>
            <span class="page-corner bl"></span><span class="page-corner br"></span>
            <h2 class="toc-title" data-i18n="toc_title">Table des Matieres</h2>
            <div class="toc-rule"></div>
            <ul class="toc-list" id="tocList"></ul>
          </div>
        </div>

        <div class="rightStack" id="rightStack"></div>
      </div>

      <div class="controls">
        <button type="button" class="nav-btn" id="prevBtn" aria-label="Page precedente">&#10094;</button>
        <span class="page-counter" id="pageCounter">1 / 11</span>
        <button type="button" class="nav-btn" id="nextBtn" aria-label="Page suivante">&#10095;</button>
      </div>
    </div>
  </div>

</div>

<script>
(function(){
  "use strict";

  var UI = {
    fr: {
      cover_title: "Grimoire<br>d'Azeroth Universe",
      cover_sub: "Chroniques du royaume",
      cover_hint: "— touchez la couverture pour l'ouvrir —",
      toc_title: "Table des Matieres"
    },
    en: {
      cover_title: "Grimoire<br>of Azeroth Universe",
      cover_sub: "Chronicles of the realm",
      cover_hint: "— touch the cover to open it —",
      toc_title: "Table of Contents"
    }
  };

  var PAGES = [
    {
      icon: "&#127760;",
      kicker: { fr: "Chapitre I", en: "Chapter I" },
      title: { fr: "Le Monde d'Azeroth Universe", en: "The World of Azeroth Universe" },
      body: {
        fr: "Azeroth a ete transformee par le Cataclysme : l'Azeroth d'origine, celle de l'ere WotLK, a laisse place a l'Azeroth du Cataclysme. Plus loin, la brume s'est levee sur le continent de Pandarie, ouvrant ses propres quetes de Mists of Pandaria. Le niveau maximum atteint desormais 90, et le monde compte 31 races jouables pour 24 classes jouables.",
        en: "Azeroth has been reshaped by the Cataclysm: the original WotLK-era Azeroth gave way to its Cataclysm incarnation. Further off, the mists have parted over the continent of Pandaria, opening its own Mists of Pandaria questlines. The maximum level now reaches 90, and the world holds 31 playable races across 24 playable classes."
      }
    },
    {
      icon: "&#9876;&#65039;",
      kicker: { fr: "Chapitre II", en: "Chapter II" },
      title: { fr: "Les Classes", en: "The Classes" },
      body: {
        fr: "Au-dela des dix classes historiques, trois furent portees depuis des ages plus recents : le Moine, le Chasseur de Demons et l'Evoker. Deux autres sont nees entierement sur ce serveur : le Mage de Combat Sanglant et le Heros. Et pour l'aventurier en quete de rarete, des classes secondaires exclusives attendent d'etre decouvertes : Pyromancer, Geomancer, Chronomancer, Venomancer, Necromancer, Ravageur du Chaos, Dompteur et Cavalier.",
        en: "Beyond the ten classic classes, three were ported from later ages: the Monk, the Demon Hunter and the Evoker. Two others were born entirely on this server: the Blood Battle Mage and the Hero. And for the adventurer seeking rarity, exclusive secondary classes await discovery: Pyromancer, Geomancer, Chronomancer, Venomancer, Necromancer, Ravageur du Chaos, Dompteur and Cavalier."
      }
    },
    {
      icon: "&#10024;",
      kicker: { fr: "Chapitre III", en: "Chapter III" },
      title: { fr: "La Voie de la Puissance", en: "The Path of Power" },
      body: {
        fr: "Une fois le sommet atteint, le voyage continue. Le systeme Parangon permet d'investir sans fin dans tes statistiques, tandis que le systeme Rebirth t'offre une renaissance grace a ta propre Pierre de Rebirth. Les armes prodigieuses s'ameliorent de A0 a A8, et l'equipement grimpe du Heroique (S0 a S8) au Mythique (jusqu'a M+8), avec du Mythique+ complet, des raids en difficulte Mythique et des donjons Mythique+. Les plafonds de statistiques ont ete abolis.",
        en: "Once the summit is reached, the journey continues. The Parangon system lets you invest endlessly into your stats, while the Rebirth system offers you a rebirth through your own Pierre de Rebirth. Artifact weapons grow from A0 to A8, and gear climbs from Heroic (S0 to S8) to Mythic (up to M+8), with full Mythic+, Mythic-difficulty raids and Mythic+ dungeons. Stat caps have been abolished."
      }
    },
    {
      icon: "&#128737;&#65039;",
      kicker: { fr: "Chapitre IV", en: "Chapter IV" },
      title: { fr: "Epreuves et Champs de Bataille", en: "Trials and Battlegrounds" },
      body: {
        fr: "Des donjons et raids entierement personnalises t'attendent, repertories dans le Codex des Rencontres (Guide d'Aventure). Le Tableau d'Appel du Heros te guide vers l'aventure, et l'Arene 1c1 met ta seule valeur a l'epreuve. De nouvelles arenes et champs de bataille ont rejoint le monde : l'Arene Tol'Viron, le Temple de Kotmogu, les Pics Jumeaux, le Croc du Tigre et la Bataille de Gilneas.",
        en: "Fully custom dungeons and raids await you, catalogued in the Codex Encounter Journal (Adventure Guide). The Hero's Call Board guides you toward adventure, and the 1v1 Arena puts your worth alone to the test. New arenas and battlegrounds have joined the world: Tol'viron Arena, Temple of Kotmogu, Twin Peaks, The Tiger's Peak and Battle for Gilneas."
      }
    },
    {
      icon: "&#127917;",
      kicker: { fr: "Chapitre V", en: "Chapter V" },
      title: { fr: "L'Art de l'Apparence", en: "The Art of Appearance" },
      body: {
        fr: "Transmogrifie ton equipement a volonte, retouche-le (Reforge) et ameliore-le grace au systeme d'amelioration d'objets. Chaque apparence obtenue rejoint pour toujours ta Garde-Robe. Visite le PNJ d'Habillage pour t'essayer a de nouveaux styles, admire-toi chez le marchand de presentation transmog, et flane dans la Zone Cosmetique.",
        en: "Transmogrify your gear at will, reforge it, and upgrade it through the item upgrade system. Every look you earn joins your Wardrobe forever. Visit the DressNPC to try new styles, admire yourself at the transmog display vendor, and wander through the Cosmetic Zone."
      }
    },
    {
      icon: "&#128012;",
      kicker: { fr: "Chapitre VI", en: "Chapter VI" },
      title: { fr: "Compagnons de Voyage", en: "Companions for the Road" },
      body: {
        fr: "Toutes les montures WotLK et posterieures peuplent ce monde, et le vol t'est ouvert aussi bien en Azeroth qu'en Pandarie. Chaque monture rejoint ton Journal des Montures, valable sur tout ton compte. Il en va de meme pour tes familiers de combat, consignes dans ton Journal des Familiers.",
        en: "All WotLK-and-later mounts populate this world, and flight is open to you in both Azeroth and Pandaria. Every mount joins your account-wide Mount Journal. The same holds for your battle pets, recorded in your account-wide Pet Journal."
      }
    },
    {
      icon: "&#128220;",
      kicker: { fr: "Chapitre VII", en: "Chapter VII" },
      title: { fr: "Ton Heritage", en: "Your Legacy" },
      body: {
        fr: "Ton compte peut abriter jusqu'a 50 personnages, dont 20 par royaume. Tes hauts faits se partagent sur tout le compte, et deux grimoires te sont propres : le Grimoire d'Identite et le Grimoire de Conversion, pour transformer tes dons en recompenses. Deviens Contributeur depuis la Pierre de Contributeur pour debloquer instantanement une monture exclusive, des objets et un lot hebdomadaire.",
        en: "Your account can hold up to 50 characters, with up to 20 per realm. Your achievements are shared account-wide, and two grimoires are yours alone: the Identity Grimoire and the Conversion Grimoire, to turn your donations into rewards. Become a Contributor through the Contributor Stone to instantly unlock an exclusive mount, items and a weekly bundle."
      }
    },
    {
      icon: "&#9881;&#65039;",
      kicker: { fr: "Chapitre VIII", en: "Chapter VIII" },
      title: { fr: "Vivre l'Aventure", en: "Living the Adventure" },
      body: {
        fr: "Le butin se ramasse a present en zone entiere. Une Recherche de Groupe en solo, SoloCraft, un MultiTrainer et un MultiVendor t'epargnent bien des allers-retours. Un reseau de teleporteurs relie les recoins du monde, un modificateur de taux d'experience (avec ses week-ends XP) accelere ta progression, et des evenements rythment la vie du serveur. Et si tu croises un aventurier au comportement etrangement poli, c'est peut-etre l'un des PNJ Bots : parle-lui, il te repondra !",
        en: "Loot now gathers itself across the whole zone. A Solo LFG, SoloCraft, a MultiTrainer and a MultiVendor spare you many a trip back and forth. A network of teleporters links the world's corners, an XP rate modifier (with its XP weekends) speeds your progress, and events punctuate the server's life. And if you cross paths with an oddly polite adventurer, it might be one of the NPC Bots: talk to it, it will answer you!"
      }
    },
    {
      icon: "&#128065;&#65039;",
      kicker: { fr: "Chapitre IX", en: "Chapter IX" },
      title: { fr: "Le Regard du Voyageur", en: "The Traveler's View" },
      body: {
        fr: "L'interface a ete redessinee dans le style Dragonflight, et un systeme de talents entierement personnalise t'accompagne dans tes choix. L'ecran de connexion accueille plusieurs extensions a la fois, la creation et la selection de personnage ont ete retravaillees, et des infobulles dediees detaillent l'equipement Mythique.",
        en: "The interface has been redesigned in the Dragonflight style, and a fully custom talent system accompanies your choices. The login screen welcomes several expansions at once, character creation and selection have been reworked, and dedicated tooltips detail Mythic gear."
      }
    },
    {
      icon: "&#128176;",
      kicker: { fr: "Chapitre X", en: "Chapter X" },
      title: { fr: "La Boutique AzerothUniverse", en: "The AzerothUniverse Shop" },
      body: {
        fr: "Notre boutique en jeu ne vend aucun avantage de puissance (No Pay-to-Win) : tu y trouveras la gamme d'objets exclusifs AzerothUniverse, avec ses paliers d'amelioration du S0 au S8 puis du M0 au M+FULL. Accessible depuis le Menu Echap, en jeu, a tout moment.",
        en: "Our in-game shop sells no power advantage (No Pay-to-Win): you'll find the exclusive AzerothUniverse item line there, with its upgrade tiers from S0 to S8 then M0 to M+FULL. Accessible from the Escape Menu, in game, at any time."
      }
    },
    {
      icon: "&#129504;",
      kicker: { fr: "Derniere Page", en: "Final Page" },
      title: { fr: "Le Mot du Scribe", en: "A Word from the Scribe" },
      body: {
        fr: "Ce grimoire n'est qu'un instantane : Azeroth Universe continue de grandir, chapitre apres chapitre. Rejoins la communaute sur Discord pour suivre les pages a venir. Que ton aventure soit legendaire.",
        en: "This grimoire is but a snapshot: Azeroth Universe keeps growing, chapter after chapter. Join the community on Discord to follow the pages yet to come. May your adventure be legendary."
      }
    }
  ];

  var lang = "fr";
  var currentIndex = 0;
  var leftPanelOpen = false;

  var rightStack = document.getElementById("rightStack");
  var tocList = document.getElementById("tocList");
  var pageCounter = document.getElementById("pageCounter");
  var prevBtn = document.getElementById("prevBtn");
  var nextBtn = document.getElementById("nextBtn");
  var leftPanel = document.getElementById("leftPanel");
  var tocToggle = document.getElementById("tocToggle");

  function buildPages() {
    rightStack.innerHTML = "";
    PAGES.forEach(function (p, i) {
      var leaf = document.createElement("div");
      var isFlipped = i < currentIndex;
      leaf.className = isFlipped ? "page flipped" : "page";
      leaf.style.zIndex = isFlipped ? String(i) : String(PAGES.length - i);
      leaf.innerHTML =
        '<div class="face front">' +
          '<span class="page-corner tl"></span><span class="page-corner tr"></span>' +
          '<span class="page-corner bl"></span><span class="page-corner br"></span>' +
          '<div class="page-content">' +
            '<div class="page-head">' +
              '<div class="page-icon">' + p.icon + '</div>' +
              '<div>' +
                '<p class="page-kicker">' + p.kicker[lang] + '</p>' +
                '<h3 class="page-title">' + p.title[lang] + '</h3>' +
              '</div>' +
            '</div>' +
            '<div class="page-rule"></div>' +
            '<p class="page-body">' + p.body[lang] + '</p>' +
          '</div>' +
          '<span class="page-num">' + (i + 1) + '</span>' +
        '</div>' +
        '<div class="face back"><div class="seal">&#10022;</div></div>';
      rightStack.appendChild(leaf);
    });
  }

  function buildToc() {
    tocList.innerHTML = "";
    PAGES.forEach(function (p, i) {
      var li = document.createElement("li");
      li.className = "toc-item";
      li.dataset.index = String(i);
      li.innerHTML = '<span class="toc-num">' + (i + 1) + '</span><span>' + p.title[lang] + '</span>';
      li.addEventListener("click", function () {
        currentIndex = i;
        render();
        if (window.matchMedia("(max-width: 760px)").matches) closeLeftPanel();
      });
      tocList.appendChild(li);
    });
  }

  function applyUiText() {
    document.querySelectorAll("[data-i18n]").forEach(function (el) {
      var key = el.getAttribute("data-i18n");
      if (UI[lang][key]) el.innerHTML = UI[lang][key];
    });
  }

  var TOP_Z = PAGES.length + 50;

  function settleZIndex(leaf, i, flipped) {
    leaf.style.zIndex = flipped ? String(i) : String(PAGES.length - i);
  }

  function render() {
    var leaves = rightStack.querySelectorAll(".page");
    leaves.forEach(function (leaf, i) {
      var shouldBeFlipped = i < currentIndex;
      var isFlipped = leaf.classList.contains("flipped");

      if (shouldBeFlipped === isFlipped) {
        settleZIndex(leaf, i, isFlipped);
        return;
      }

      leaf.style.zIndex = String(TOP_Z);
      leaf.classList.toggle("flipped", shouldBeFlipped);
      leaf.addEventListener("transitionend", function onDone(e) {
        if (e.target !== leaf || e.propertyName !== "transform") return;
        leaf.removeEventListener("transitionend", onDone);
        settleZIndex(leaf, i, shouldBeFlipped);
      });
    });

    var tocItems = tocList.querySelectorAll(".toc-item");
    tocItems.forEach(function (item, i) {
      item.classList.toggle("current", i === currentIndex);
    });

    pageCounter.textContent = (currentIndex + 1) + " / " + PAGES.length;
    prevBtn.disabled = currentIndex <= 0;
    nextBtn.disabled = currentIndex >= PAGES.length - 1;
  }

  function nextPage() { if (currentIndex < PAGES.length - 1) { currentIndex++; render(); } }
  function prevPage() { if (currentIndex > 0) { currentIndex--; render(); } }

  function openLeftPanel() { leftPanel.classList.add("open"); leftPanelOpen = true; }
  function closeLeftPanel() { leftPanel.classList.remove("open"); leftPanelOpen = false; }

  function setLang(l) {
    lang = l;
    document.body.className = "lang-" + l;
    document.querySelectorAll(".lang-btn").forEach(function (b) {
      b.classList.toggle("active", b.dataset.lang === l);
    });
    applyUiText();
    buildPages();
    buildToc();
    render();
  }

  // ---------- events ----------
  tocToggle.style.visibility = "hidden";
  document.getElementById("coverOpen").addEventListener("click", function () {
    document.getElementById("cover-screen").classList.add("hidden");
    document.getElementById("book-screen").classList.remove("hidden");
    tocToggle.style.visibility = "visible";
  });

  nextBtn.addEventListener("click", nextPage);
  prevBtn.addEventListener("click", prevPage);

  document.addEventListener("keydown", function (e) {
    if (document.getElementById("book-screen").classList.contains("hidden")) return;
    if (e.key === "ArrowRight") nextPage();
    if (e.key === "ArrowLeft") prevPage();
  });

  tocToggle.addEventListener("click", function () {
    if (leftPanelOpen) closeLeftPanel(); else openLeftPanel();
  });

  document.querySelectorAll(".lang-btn").forEach(function (b) {
    b.addEventListener("click", function () { setLang(b.dataset.lang); });
  });
  
  rightStack.addEventListener("click", function (e) {
    var leaf = e.target.closest(".page");
    if (!leaf) return;
    var idx = Array.prototype.indexOf.call(rightStack.children, leaf);
    if (idx === currentIndex) nextPage();
  });

  setLang("fr");
})();
</script>
</body>
</html>
