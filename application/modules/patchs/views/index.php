<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700;900&family=Cinzel:wght@500;600&family=EB+Garamond:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

<section class="syphrena-home-item" style="position: relative; background-image: url(../application/themes/default/assets/images/head-background-3.jpg)">
  <div class="syphrena-hero-container">
    <div class="syphrena-hero-title">
      <span class="orange-shadow"><?= $this->lang->line('patchs_title'); ?></span>
    </div>
    <p class="syphrena-hero-subtitle"><?= sprintf($this->lang->line('patchs_subtitle'), '<span class="au-fe-code">Data/</span>'); ?></p>

    <div class="au-fe-shell">
      <div class="au-fe-frame">

        <div class="au-fe-sidetabs">
          <button class="au-fe-stab active" data-tab="root"><span>DATA</span></button>
          <button class="au-fe-stab" data-tab="enus"><span>ENUS</span></button>
          <button class="au-fe-stab" data-tab="frfr"><span>FRFR</span></button>
        </div>

        <span class="au-fe-gem tl"></span>
        <span class="au-fe-gem tr"></span>
        <span class="au-fe-gem bl"></span>
        <span class="au-fe-gem br"></span>

        <div class="au-fe-body">

          <div class="au-fe-header">
            <div class="au-fe-headtext">
              <div class="au-fe-title"><?= $this->lang->line('patchs_grimoire_title'); ?></div>
              <div class="au-fe-path" id="au-fe-path">Data/</div>
            </div>
            <div class="au-fe-search">
              <input type="text" id="au-fe-search" placeholder="<?= $this->lang->line('patchs_search_placeholder'); ?>">
            </div>
          </div>

          <div class="au-fe-rule"><span>❖</span></div>

          <div class="au-fe-list" id="au-fe-list"></div>
          <p class="au-fe-empty" id="au-fe-empty"><?= $this->lang->line('patchs_empty'); ?></p>

          <div class="au-fe-rule au-fe-rule-small"><span>❖</span></div>
          <div class="au-fe-count" id="au-fe-count">—</div>

        </div>
      </div>
    </div>

  </div>
  <div class="syphrena-hero-divider-thin"></div>
</section>

<style>
  :root{
    --au-orange: #e79233;
    --au-orange-soft: #f6c377;
    --au-gold-hi: #f2d18a;
    --au-gold-lo: #7a5722;
    --au-leather-1: #221a13;
    --au-leather-2: #14100b;
    --au-text: #ece1cc;
    --au-text-dim: #a4917a;
    --au-line: rgba(230,190,120,0.18);

    /* Couleurs de rareté (style objet WoW) */
    --q-poor:#9d9d9d;
    --q-common:#ffffff;
    --q-uncommon:#1eff00;
    --q-rare:#0070dd;
    --q-epic:#a335ee;
    --q-legendary:#ff8000;
  }

  .au-fe-code{
    display:inline-block;
    background:rgba(231,146,51,0.14);
    border:1px solid rgba(231,146,51,0.35);
    color:var(--au-orange-soft);
    padding:1px 8px;
    border-radius:5px;
    font-family:'Courier New', monospace;
    font-size:0.9em;
  }

  .au-fe-shell{
    max-width:640px;
    margin:38px auto 0;
    padding-left:38px; /* place pour les onglets qui dépassent */
  }

  .au-fe-frame{
    position:relative;
    background:
      radial-gradient(120% 140% at 50% -10%, rgba(231,146,51,0.08), transparent 55%),
      linear-gradient(165deg, var(--au-leather-1), var(--au-leather-2));
    border:2px solid var(--au-gold-lo);
    border-radius:8px;
    box-shadow:
      0 0 0 1px rgba(0,0,0,0.6),
      inset 0 0 0 1px rgba(242,209,138,0.15),
      0 24px 60px rgba(0,0,0,0.55);
  }

  /* Coins ornementés (façon rivets/gemmes de cadre WoW) */
  .au-fe-gem{
    position:absolute;
    width:11px; height:11px;
    background:radial-gradient(circle at 35% 30%, var(--au-gold-hi), var(--au-orange) 55%, var(--au-gold-lo) 100%);
    border:1px solid rgba(0,0,0,0.6);
    border-radius:2px;
    transform:rotate(45deg);
    box-shadow:0 0 6px rgba(231,146,51,0.5);
    z-index:2;
  }
  .au-fe-gem.tl{ top:-6px; left:-6px; }
  .au-fe-gem.tr{ top:-6px; right:-6px; }
  .au-fe-gem.bl{ bottom:-6px; left:-6px; }
  .au-fe-gem.br{ bottom:-6px; right:-6px; }

  /* Onglets latéraux façon carnet de sorts */
  .au-fe-sidetabs{
    position:absolute;
    left:-34px;
    top:22px;
    display:flex;
    flex-direction:column;
    gap:10px;
    z-index:1;
  }
  .au-fe-stab{
    width:36px;
    height:88px;
    background:linear-gradient(180deg, #2b2016, #1a130c);
    border:2px solid var(--au-gold-lo);
    border-right:none;
    border-radius:8px 0 0 8px;
    color:var(--au-text-dim);
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    transition:transform .18s ease, background .18s ease, box-shadow .18s ease, color .18s ease;
  }
  .au-fe-stab span{
    writing-mode:vertical-rl;
    transform:rotate(180deg);
    font-family:'Cinzel', serif;
    font-size:12px;
    letter-spacing:.14em;
    font-weight:600;
  }
  .au-fe-stab:hover{ color:var(--au-text); }
  .au-fe-stab.active{
    background:linear-gradient(180deg, #3a2a16, #241a0e);
    border-color:var(--au-orange);
    color:var(--au-orange-soft);
    transform:translateX(-5px);
    box-shadow:-6px 4px 16px rgba(0,0,0,0.5), 0 0 12px rgba(231,146,51,0.35);
  }

  .au-fe-body{
    position:relative;
    padding:20px 22px 16px;
  }

  .au-fe-header{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:12px;
  }
  .au-fe-title{
    font-family:'Cinzel Decorative', 'Cinzel', serif;
    font-size:17px;
    color:var(--au-orange-soft);
    text-shadow:0 0 12px rgba(231,146,51,0.35);
  }
  .au-fe-path{
    font-family:'EB Garamond', serif;
    font-style:italic;
    font-size:12.5px;
    color:var(--au-text-dim);
    margin-top:2px;
  }

  .au-fe-search input{
    background:rgba(0,0,0,0.35);
    border:1px solid var(--au-line);
    border-radius:4px;
    color:var(--au-text);
    font-family:'EB Garamond', serif;
    font-size:13px;
    padding:6px 10px;
    outline:none;
    width:140px;
    transition:border-color .15s ease;
  }
  .au-fe-search input:focus{ border-color:var(--au-orange); }
  .au-fe-search input::placeholder{ color:var(--au-text-dim); }

  .au-fe-rule{
    display:flex;
    align-items:center;
    text-align:center;
    color:var(--au-gold-lo);
    margin:14px 0 6px;
  }
  .au-fe-rule::before, .au-fe-rule::after{
    content:"";
    flex:1;
    height:1px;
    background:linear-gradient(90deg, transparent, var(--au-line), transparent);
  }
  .au-fe-rule span{ padding:0 10px; font-size:10px; color:var(--au-orange); opacity:.8; }
  .au-fe-rule-small{ margin:10px 0 4px; }

  .au-fe-list{
    /* min-height = max-height (au lieu d'une simple max-height) : le
       grimoire garde toujours la meme taille, meme quand l'onglet actif
       n'a qu'une seule ligne (ENUS/FRFR depuis leur regroupement en une
       seule archive GitHub) - sinon le cadre se retrecit et les onglets
       lateraux (positionnes en absolu par rapport au cadre) depassent en
       bas au lieu de rester contenus dedans. */
    min-height:360px;
    max-height:360px;
    overflow-y:auto;
    padding-right:4px;
  }
  .au-fe-list::-webkit-scrollbar{ width:5px; }
  .au-fe-list::-webkit-scrollbar-thumb{ background:var(--au-orange); opacity:.5; border-radius:3px; }
  .au-fe-list::-webkit-scrollbar-track{ background:transparent; }

  .au-fe-row{
    display:flex;
    align-items:center;
    gap:10px;
    padding:8px 8px 8px 12px;
    margin-bottom:3px;
    border-radius:4px;
    background:rgba(255,255,255,0.02);
    border-left:3px solid var(--q-common);
    text-decoration:none;
    cursor:pointer;
    transition:background .15s ease, border-left-color .15s ease;
  }
  .au-fe-row:hover{ background:rgba(231,146,51,0.10); }
  .au-fe-row.au-fe-hidden{ display:none; }

  .au-fe-fn{
    flex:1;
    min-width:0;
    font-family:'EB Garamond', serif;
    font-size:14.5px;
    font-weight:600;
    overflow:hidden; text-overflow:ellipsis; white-space:nowrap;
  }
  .au-fe-fn mark{
    background:rgba(231,146,51,0.35);
    color:#fff;
    border-radius:2px;
  }

  .au-fe-size{
    flex:none;
    color:var(--au-text-dim);
    font-size:11.5px;
    font-variant-numeric:tabular-nums;
    min-width:56px;
    text-align:right;
  }

  .au-fe-dl{
    flex:none;
    width:22px; height:22px;
    border-radius:50%;
    background:radial-gradient(circle at 35% 30%, #4a3a26, #1a130c);
    border:1px solid var(--au-gold-lo);
    display:flex; align-items:center; justify-content:center;
    color:var(--au-orange-soft);
    font-size:11px;
    opacity:.55;
    transition:opacity .15s ease, border-color .15s ease, box-shadow .15s ease;
  }
  .au-fe-row:hover .au-fe-dl{
    opacity:1;
    border-color:var(--au-orange);
    box-shadow:0 0 8px rgba(231,146,51,0.5);
  }

  .au-fe-empty{
    display:none;
    text-align:center;
    color:var(--au-text-dim);
    font-family:'EB Garamond', serif;
    font-style:italic;
    font-size:13.5px;
    padding:30px 20px;
  }
  .au-fe-empty.au-fe-show{ display:block; }

  .au-fe-count{
    text-align:center;
    color:var(--au-text-dim);
    font-family:'EB Garamond', serif;
    font-style:italic;
    font-size:12px;
  }

  @media (max-width:560px){
    .au-fe-shell{ padding-left:0; }
    .au-fe-sidetabs{
      position:static;
      flex-direction:row;
      justify-content:center;
      margin-bottom:14px;
      gap:8px;
    }
    .au-fe-stab{
      width:auto;
      height:auto;
      padding:8px 18px;
      border-radius:6px;
      border-right:2px solid var(--au-gold-lo);
    }
    .au-fe-stab span{ writing-mode:horizontal-tb; transform:none; }
    .au-fe-stab.active{ transform:translateY(-3px); }
    .au-fe-search input{ width:120px; }
  }
</style>

<script>
const AU_I18N = {
  locale: "<?= $this->lang->line('patchs_locale'); ?>",
  ko: "<?= $this->lang->line('patchs_unit_ko'); ?>",
  mo: "<?= $this->lang->line('patchs_unit_mo'); ?>",
  go: "<?= $this->lang->line('patchs_unit_go'); ?>",
  resultSingular: "<?= $this->lang->line('patchs_result_singular'); ?>",
  resultPlural: "<?= $this->lang->line('patchs_result_plural'); ?>",
  totalFiles: "<?= $this->lang->line('patchs_total_files'); ?>",
  totalSuffix: "<?= $this->lang->line('patchs_total_suffix'); ?>"
};
(function(){
  // Hebergement GitHub Releases (depot UniverseClient) depuis la migration
  // hors du VPS. Chaque entree porte desormais sa PROPRE url complete (plus
  // de prefixe commun type BASE + nom de fichier) et un `type` :
  //   - "download" : fichier .MPQ unique, telechargeable directement en un
  //     clic (correspond aux entrees "kind: direct" du manifest du launcher).
  //   - "page" : gros patch (ou pack de langue) desormais distribue sous
  //     forme d'archive .rar en plusieurs parties (limite ~2 Go par fichier
  //     sur GitHub Releases) - le lien renvoie vers la page GitHub Releases
  //     du patch, ou le joueur voit et telecharge lui-meme chaque partie
  //     (correspond aux entrees "kind: archive" du manifest). La taille
  //     affichee est le TOTAL de toutes les parties reelles de ce patch.
  const REPO_RELEASES = "https://github.com/AzerothUniverseCore/UniverseClient/releases";

  const rootFiles = [
    ["common.MPQ", 64, REPO_RELEASES + "/download/common.MPQ/common.MPQ", "download"],
    ["common-2.MPQ", 1362, REPO_RELEASES + "/download/common-2.MPQ/common-2.MPQ", "download"],
    ["expansion.MPQ", 64, REPO_RELEASES + "/download/expansion.MPQ/expansion.MPQ", "download"],
    ["lichking.MPQ", 64, REPO_RELEASES + "/download/lichking.MPQ/lichking.MPQ", "download"],
    ["patch.MPQ", 1423, REPO_RELEASES + "/download/patch.MPQ/patch.MPQ", "download"],
    ["patch-2.MPQ", 1454, REPO_RELEASES + "/download/patch-2.MPQ/patch-2.MPQ", "download"],
    ["patch-3.MPQ", 1464, REPO_RELEASES + "/download/patch-3.MPQ/patch-3.MPQ", "download"],
    ["patch-4.MPQ", 2500608, REPO_RELEASES + "/tag/patch-4.MPQ", "page"],
    ["patch-5.MPQ", 3140915, REPO_RELEASES + "/tag/patch-5.MPQ", "page"],
    ["patch-6.MPQ", 2762752, REPO_RELEASES + "/tag/patch-6.MPQ", "page"],
    ["patch-7.MPQ", 3449856, REPO_RELEASES + "/tag/patch-7.MPQ", "page"],
    ["patch-8.MPQ", 2115072, REPO_RELEASES + "/tag/patch-8.MPQ", "page"],
    ["patch-9.MPQ", 2582528, REPO_RELEASES + "/tag/patch-9.MPQ", "page"],
    ["patch-A.MPQ", 3587072, REPO_RELEASES + "/tag/patch-A.MPQ", "page"],
    // ATTENTION patch-B.MPQ : le manifest.json du launcher liste 12 parties
    // (part01-part12) mais seules 10 existent reellement sur GitHub
    // (part01-part10) au moment de cette mise a jour - taille ci-dessous
    // basee sur ces 10 parties reelles. A corriger cote manifest.json (voir
    // le recap envoye separement) avant que ce chiffre ne soit peut-etre
    // amene a changer.
    ["patch-B.MPQ", 9576448, REPO_RELEASES + "/tag/patch-B.MPQ", "page"],
    ["patch-C.MPQ", 7453696, REPO_RELEASES + "/tag/patch-C.MPQ", "page"],
    ["patch-D.MPQ", 7066624, REPO_RELEASES + "/tag/patch-D.MPQ", "page"],
    ["patch-E.MPQ", 4472832, REPO_RELEASES + "/tag/patch-E.MPQ", "page"],
    ["patch-F.MPQ", 4471808, REPO_RELEASES + "/tag/patch-F.MPQ", "page"],
    ["patch-I.MPQ", 510976, REPO_RELEASES + "/download/patch-I.MPQ/patch-I.MPQ", "download"],
    ["patch-K.MPQ", 2906112, REPO_RELEASES + "/tag/patch-K.MPQ", "page"],
    ["patch-N.MPQ", 1289748, REPO_RELEASES + "/download/patch-N.MPQ/patch-N.MPQ", "download"],
    ["patch-T.MPQ", 16794, REPO_RELEASES + "/download/patch-T.MPQ/patch-T.MPQ", "download"],
    ["patch-U.MPQ", 450560, REPO_RELEASES + "/download/patch-U.MPQ/patch-U.MPQ", "download"],
    ["patch-Y.MPQ", 5586944, REPO_RELEASES + "/tag/patch-Y.MPQ", "page"],
    ["patch-Z.MPQ", 1688207, REPO_RELEASES + "/download/patch-Z.MPQ/patch-Z.MPQ", "download"],
    ["patch-ZA.MPQ", 41882, REPO_RELEASES + "/download/patch-ZA.MPQ/patch-ZA.MPQ", "download"],
  ];

  // frFR/enUS ne sont plus des dizaines de petits .MPQ individuels : ils
  // sont desormais chacun regroupes en UNE seule archive .rar multi-parties
  // sur GitHub (voir manifest.json, entrees "frFR"/"enUS"), donc une seule
  // ligne par langue ici (taille = total des parties reelles).
  const enusFiles = [
    ["enUS (archive complete)", 3816816, REPO_RELEASES + "/tag/enUS", "page"],
  ];

  const frfrFiles = [
    ["frFR (archive complete)", 3565159, REPO_RELEASES + "/tag/frFR", "page"],
  ];

  const FOLDERS = {
    root: { files: rootFiles, path: "Data/" },
    enus: { files: enusFiles, path: "Data/enUS/" },
    frfr: { files: frfrFiles, path: "Data/frFR/" }
  };

  function formatKo(ko){
    if(ko >= 1048576) return (ko/1048576).toLocaleString(AU_I18N.locale,{maximumFractionDigits:2}) + " " + AU_I18N.go;
    if(ko >= 1024) return (ko/1024).toLocaleString(AU_I18N.locale,{maximumFractionDigits:1}) + " " + AU_I18N.mo;
    return ko.toLocaleString(AU_I18N.locale) + " " + AU_I18N.ko;
  }

  // Couleurs de rareté façon objet WoW, selon le poids du fichier
  function qualityColor(ko){
    if(ko < 100) return 'var(--q-poor)';
    if(ko < 51200) return 'var(--q-common)';
    if(ko < 512000) return 'var(--q-uncommon)';
    if(ko < 2097152) return 'var(--q-rare)';
    if(ko < 5242880) return 'var(--q-epic)';
    return 'var(--q-legendary)';
  }

  let currentTab = 'root';
  let query = '';

  const listEl = document.getElementById('au-fe-list');
  const emptyEl = document.getElementById('au-fe-empty');
  const countEl = document.getElementById('au-fe-count');
  const searchEl = document.getElementById('au-fe-search');
  const pathEl = document.getElementById('au-fe-path');

  function render(){
    const { files, path } = FOLDERS[currentTab];
    pathEl.textContent = path;
    listEl.innerHTML = '';
    let visible = 0;
    let totalKo = 0;

    files.forEach(([name, ko, url, type])=>{
      totalKo += ko;
      const match = !query || name.toLowerCase().includes(query);
      if(!match) return;
      visible++;
      const isPage = type === 'page';
      const color = qualityColor(ko);
      const row = document.createElement('a');
      row.className = 'au-fe-row';
      row.href = url;
      if(isPage){
        // Gros patch multi-parties : ouvre la page GitHub Releases dans un
        // nouvel onglet plutot que de tenter un telechargement direct (qui
        // ne recupererait qu'UNE seule partie de l'archive).
        row.target = '_blank';
        row.rel = 'noopener';
      } else {
        row.setAttribute('download', '');
      }
      row.style.borderLeftColor = color;
      let displayName = name;
      if(query){
        const re = new RegExp(query.replace(/[.*+?^${}()|[\]\\]/g,'\\$&'), 'ig');
        displayName = name.replace(re, m => `<mark>${m}</mark>`);
      }
      row.innerHTML = `
        <span class="au-fe-fn" style="color:${color}">${displayName}</span>
        <span class="au-fe-size">${formatKo(ko)}</span>
        <span class="au-fe-dl">${isPage ? '↗' : '↓'}</span>
      `;
      listEl.appendChild(row);
    });

    emptyEl.classList.toggle('au-fe-show', visible === 0);
    countEl.textContent = query
      ? `${visible} ${visible>1 ? AU_I18N.resultPlural : AU_I18N.resultSingular}`
      : `${files.length} ${AU_I18N.totalFiles} · ${formatKo(totalKo)} ${AU_I18N.totalSuffix}`;
  }

  document.querySelectorAll('.au-fe-stab').forEach(tab=>{
    tab.addEventListener('click', ()=>{
      document.querySelectorAll('.au-fe-stab').forEach(t=>t.classList.remove('active'));
      tab.classList.add('active');
      currentTab = tab.dataset.tab;
      query = '';
      searchEl.value = '';
      listEl.scrollTop = 0;
      render();
    });
  });

  searchEl.addEventListener('input', (e)=>{
    query = e.target.value.trim().toLowerCase();
    render();
  });

  render();
})();
</script>
