<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700;900&family=Cinzel:wght@500;600&family=EB+Garamond:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

<section class="syphrena-home-item" style="position: relative; background-image: url(../application/themes/default/assets/images/head-background-3.jpg)">
  <div class="syphrena-hero-container">
    <div class="syphrena-hero-title">
      <span class="orange-shadow">TÉLÉCHARGEMENT DES PATCHS</span>
    </div>
    <p class="syphrena-hero-subtitle">Fichiers MPQ à placer dans votre dossier <span class="au-fe-code">Data/</span></p>

    <div class="au-fe-shell">
      <div class="au-fe-frame">

        <div class="au-fe-sidetabs">
          <button class="au-fe-stab active" data-tab="root"><span>DATA</span></button>
          <button class="au-fe-stab" data-tab="frfr"><span>FRFR</span></button>
        </div>

        <span class="au-fe-gem tl"></span>
        <span class="au-fe-gem tr"></span>
        <span class="au-fe-gem bl"></span>
        <span class="au-fe-gem br"></span>

        <div class="au-fe-body">

          <div class="au-fe-header">
            <div class="au-fe-headtext">
              <div class="au-fe-title">Grimoire des patchs</div>
              <div class="au-fe-path" id="au-fe-path">Data/</div>
            </div>
            <div class="au-fe-search">
              <input type="text" id="au-fe-search" placeholder="Rechercher…">
            </div>
          </div>

          <div class="au-fe-rule"><span>❖</span></div>

          <div class="au-fe-list" id="au-fe-list"></div>
          <p class="au-fe-empty" id="au-fe-empty">Aucun fichier ne correspond à ce filtre.</p>

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
(function(){
  const BASE = "https://azeroth-universe.eu/universe_client/Data";

  const rootFiles = [
    ["common.MPQ", 65], ["common-2.MPQ", 1358], ["expansion.MPQ", 65], ["lichking.MPQ", 65],
    ["patch.MPQ", 1421], ["patch-2.MPQ", 1459], ["patch-3.MPQ", 1464], ["patch-4.MPQ", 2500799],
    ["patch-5.MPQ", 3140908], ["patch-6.MPQ", 2762975], ["patch-7.MPQ", 3449454], ["patch-8.MPQ", 2115044],
    ["patch-9.MPQ", 2582024], ["patch-A.MPQ", 3586981], ["patch-B.MPQ", 9576383], ["patch-C.MPQ", 7454003],
    ["patch-D.MPQ", 7066882], ["patch-E.MPQ", 4552382], ["patch-F.MPQ", 4472260], ["patch-I.MPQ", 510847],
    ["patch-K.MPQ", 2906400], ["patch-N.MPQ", 1294573], ["patch-T.MPQ", 16790], ["patch-U.MPQ", 450230],
    ["patch-V.MPQ", 61990], ["patch-Y.MPQ", 5586713], ["patch-Z.MPQ", 1686301], ["patch-ZA.MPQ", 17590],
	["patch-ZB.MPQ", 4721], ["patch-ZC.MPQ", 8521], ["patch-ZD.MPQ", 9721], ["patch-ZE.MPQ", 20290],
  ];

  const frfrFiles = [
    ["backup-frFR.MPQ", 25178], ["base-frFR.MPQ", 30378], ["expansion-locale-frFR.MPQ", 16982],
    ["expansion-speech-frFR.MPQ", 259310], ["lichking-locale-frFR.MPQ", 12329], ["lichking-speech-frFR.MPQ", 20052],
    ["locale-frFR.MPQ", 197304], ["patch-frFR.MPQ", 539160], ["patch-frFR-2.MPQ", 220894],
    ["patch-frFR-3.MPQ", 1225345], ["patch-frFR-4.MPQ", 93], ["patch-frFR-5.MPQ", 571],
    ["patch-frFR-6.MPQ", 327769], ["patch-frFR-7.MPQ", 274], ["patch-frFR-8.MPQ", 419],
    ["patch-frFR-U.MPQ", 811], ["patch-frFR-X.MPQ", 40], ["speech-frFR.MPQ", 431604],
  ];

  const FOLDERS = {
    root: { files: rootFiles, base: BASE, path: "Data/" },
    frfr: { files: frfrFiles, base: BASE + "/frFR", path: "Data/frFR/" }
  };

  function formatKo(ko){
    if(ko >= 1048576) return (ko/1048576).toLocaleString('fr-FR',{maximumFractionDigits:2}) + " Go";
    if(ko >= 1024) return (ko/1024).toLocaleString('fr-FR',{maximumFractionDigits:1}) + " Mo";
    return ko.toLocaleString('fr-FR') + " Ko";
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
    const { files, base, path } = FOLDERS[currentTab];
    pathEl.textContent = path;
    listEl.innerHTML = '';
    let visible = 0;
    let totalKo = 0;

    files.forEach(([name, ko])=>{
      totalKo += ko;
      const match = !query || name.toLowerCase().includes(query);
      if(!match) return;
      visible++;
      const url = `${base}/${name}`;
      const color = qualityColor(ko);
      const row = document.createElement('a');
      row.className = 'au-fe-row';
      row.href = url;
      row.setAttribute('download', '');
      row.style.borderLeftColor = color;
      let displayName = name;
      if(query){
        const re = new RegExp(query.replace(/[.*+?^${}()|[\]\\]/g,'\\$&'), 'ig');
        displayName = name.replace(re, m => `<mark>${m}</mark>`);
      }
      row.innerHTML = `
        <span class="au-fe-fn" style="color:${color}">${displayName}</span>
        <span class="au-fe-size">${formatKo(ko)}</span>
        <span class="au-fe-dl">↓</span>
      `;
      listEl.appendChild(row);
    });

    emptyEl.classList.toggle('au-fe-show', visible === 0);
    countEl.textContent = query
      ? `${visible} résultat${visible>1?'s':''}`
      : `${files.length} fichiers · ${formatKo(totalKo)} au total`;
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
