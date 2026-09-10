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
    --stage: #04140d;
    --stage-2: #0a2818;
    --gold: #cda75e;
    --gold-bright: #f0d38a;
    --gold-dim: #7a6130;
    --leather: #4a2c14;
    --leather-dark: #2a1708;
    --leather-light: #6b4322;
    --parchment: #ecdcb4;
    --parchment-2: #e2cd9c;
    --parchment-shadow: #c9ad78;
    --ink: #3a2a14;
    --ink-soft: #5c4426;
    --seal: #7a1f1f;
  }

  * { box-sizing: border-box; }
  html, body { margin: 0; padding: 0; }

  body {
    min-height: 100vh;
    background:
      radial-gradient(ellipse at 50% 20%, rgba(63,156,102,0.10), transparent 60%),
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
    width: 86px; height: 86px;
    border-radius: 50%;
    background: radial-gradient(circle at 35% 30%, var(--gold-bright), var(--gold) 55%, var(--gold-dim) 100%);
    box-shadow: 0 4px 18px rgba(0,0,0,0.55), inset 0 0 0 3px rgba(42,23,8,0.5);
    display: flex; align-items: center; justify-content: center;
    font-size: 34px;
    color: var(--leather-dark);
    margin-bottom: 22px;
    position: relative;
    z-index: 1;
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
    position: absolute; width: 30px; height: 30px;
    border: 1.5px solid rgba(205,167,94,0.5);
  }
  .cover-corner.tl { top: 3%; left: 3%; border-right: none; border-bottom: none; }
  .cover-corner.tr { top: 3%; right: 3%; border-left: none; border-bottom: none; }
  .cover-corner.bl { bottom: 3%; left: 3%; border-right: none; border-top: none; }
  .cover-corner.br { bottom: 3%; right: 3%; border-left: none; border-top: none; }

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

  .leftPanel, .rightStack { position: absolute; top: 0; height: 100%; width: 50%; }
  .leftPanel { left: 0; z-index: 500; }
  .rightStack { right: 0; transform-style: preserve-3d; }

  .leftPanel-inner {
    position: absolute; inset: 6px 4px 6px 10px;
    background:
      radial-gradient(ellipse at 30% 0%, rgba(255,255,255,0.10), transparent 55%),
      linear-gradient(120deg, var(--parchment), var(--parchment-2) 60%, var(--parchment-shadow));
    border-radius: 3px 10px 10px 3px;
    box-shadow: inset 0 0 30px rgba(120,90,40,0.25), 2px 0 10px rgba(0,0,0,0.3);
    padding: 22px 20px;
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
      radial-gradient(ellipse at 70% 0%, rgba(255,255,255,0.10), transparent 55%),
      linear-gradient(240deg, var(--parchment), var(--parchment-2) 60%, var(--parchment-shadow));
    box-shadow: inset 0 0 30px rgba(120,90,40,0.25), -2px 0 10px rgba(0,0,0,0.3);
  }
  .face.back {
    transform: rotateY(180deg);
    background:
      radial-gradient(ellipse at 30% 100%, rgba(0,0,0,0.12), transparent 55%),
      linear-gradient(60deg, var(--parchment-shadow), var(--parchment-2) 55%, var(--parchment));
    box-shadow: inset 0 0 30px rgba(120,90,40,0.3);
    display: flex; align-items: center; justify-content: center;
  }
  .face.back .seal {
    width: 74px; height: 74px; border-radius: 50%;
    border: 2px solid var(--gold-dim);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold-dim); font-size: 26px;
    opacity: 0.65;
  }

  .page-content { position: absolute; inset: 0; padding: 22px 22px 18px; overflow-y: auto; color: var(--ink); }
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
  .controls { display: flex; align-items: center; gap: 18px; }
  .nav-btn {
    width: 42px; height: 42px; border-radius: 50%;
    background: linear-gradient(180deg, var(--gold-bright), var(--gold));
    color: var(--leather-dark);
    border: none; cursor: pointer;
    font-size: 17px;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 6px 16px rgba(0,0,0,0.4);
    transition: transform 0.15s, opacity 0.15s;
  }
  .nav-btn:hover:not(:disabled) { transform: translateY(-2px); }
  .nav-btn:disabled { opacity: 0.3; cursor: default; }
  .page-counter { font-family: 'Cinzel', serif; font-size: 13px; letter-spacing: 1px; color: rgba(240,211,138,0.75); min-width: 90px; text-align: center; }
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
      <div class="cover-emblem">&#9878;</div>
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

        <div class="leftPanel" id="leftPanel">
          <div class="leftPanel-inner">
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
