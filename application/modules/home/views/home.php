<section class="syphrena-hero">
<div class="azeroth-hero-title">
  <div class="syphrena-hero-container">
    <video class="syphrena-background-video" src="../application/themes/default/assets/videos/Azeroth.mp4" data-src="../application/themes/default/assets/videos/Azeroth.mp4" loop="loop" muted="muted" preload="auto" autoplay="autoplay" playsinline="playsinline"></video>
    <div class="syphrena-hero-title">
      <span class="orange-shadow">Revivez votre aventure</span></span> <span class="bfa-orange"><span class="orange-shadow"></span></span>
    </div>
    <div class="syphrena-hero-subtitle">
      <span class="orange-shadow">Choisissez votre faction et préparez-vous à une aventure épique !</span></span> <span class="bfa-orange"><span class="orange-shadow"></span></span>
    </div>
    <div class="syphrena-hero-buttons">
      <a href="<?= base_url("/download"); ?>" class="syphrena-hero-button">
        <div class="syphrena-hero-button-inner">
          <span class="orange-shadow">🧙</span></span> <span class="orange-shadow">JOUER</span></span>
        </div>
      </a>
    </div>
  </div>
  <div class="syphrena-hero-divider-thick"></div>
</section>

<section class="syphrena-home-item" style="position: relative; background-image: url(../application/themes/default/assets/images/background-universe.jpg)">
  <div class="syphrena-hero-container">
    <div class="syphrena-hero-title">
      <span class="orange-shadow">L'AVENTURE VOUS ATTEND !</span>
    </div>
	<div class="azeroth-hero-title">
    <div class="azeroth-universe-description">
      <span class="orange-shadow"><p>Rejoignez Azeroth Universe, un serveur unique qui repousse les limites de World of Warcraft avec du contenu inédit et des mécaniques exclusives ! Que vous soyez un vétéran ou un nouveau joueur, préparez-vous à une aventure sans précédent !</p></span>
    </div>
	</div>
	<a href="<?= base_url("/register"); ?>" class="syphrena-hero-button">
        <div class="syphrena-hero-button-inner">
          <span class="orange-shadow">🏹</span></span> <span class="orange-shadow">NOUS REJOINDRE</span></span>
        </div>
      </a>
  </div>
  <div class="syphrena-hero-divider-thin"></div>
</section>

<!--<section class="syphrena-home-item" style="position: relative; background-image: url(../application/themes/default/assets/images/card-background-10.jpg)">
<div class="azeroth-hero-title">
  <div class="syphrena-hero-container syphrena-home-item-reversed">
    <div class="syphrena-hero-title">
      <span class="orange-shadow">CHAT UNIVERSE</span></span>
    </div>
    <div class="syphrena-hero-subtitle">
      <span class="orange-shadow">Partagez vos aventures, signalez les bugs, suivez l’actualité et échangez avec d’autres héros en temps réel.</span></span>
    </div>
    <div class="syphrena-hero-buttons">
      <a href="https://chat.azerothuniverse.org/" class="syphrena-hero-button">
        <div class="syphrena-hero-button-inner">
          <span class="orange-shadow">💭</span></span> <span class="orange-shadow">REJOINDRE CHAT UNIVERSE</span></span>
        </div>
      </a>
    </div>
  </div>
  <div class="syphrena-hero-divider-thin"></div>
</section>-->

<section class="syphrena-home-item" style="position: relative; background-image: url(../application/themes/default/assets/images/head-background-3.jpg)">
  <div class="syphrena-hero-container">
		<div class="syphrena-hero-title">
            <span class="orange-shadow">DERNIÈRES ACTUALITÉS</span>
        </div>
    <div class="syphrena-hero-title"></div>
    <div class="syphrena-news-list">
      <?php if ($this->wowmodule->getNewsStatus()) : ?>
        <?php for ($i = 0; $i < 4; $i++) { ?>
          <a href="<?= base_url('news/' . $NewsList[$i]->id); ?>" class="syphrena-new" style="background-image: linear-gradient(0deg, black, transparent), url(<?= base_url('assets/images/news/' . $NewsList[$i]->image); ?>)">
            <div class="syphrena-new-title syphrena-new-title-centered"><?php echo $NewsList[$i]->title ?></div>
			<br>
            <div class="syphrena-new-subtitle">
			<p class="syphrena-new-meta">
                🕒 <?= date('d M Y', $NewsList[$i]->date) ?>
              </p>
              <span class="orange-shadow"><p><?php echo strlen($NewsList[$i]->description) > 0 ? substr($NewsList[$i]->description, 0, 0) . "En savoir plus.." : $NewsList[$i]->description; ?></p></span>
            </div>
          </a>
        <?php } ?>
      <?php endif ?>
    </div>
	<a href="<?= base_url("news"); ?>" class="syphrena-hero-button">
        <div class="syphrena-hero-button-inner">
          <span class="orange-shadow">📜</span></span> <span class="orange-shadow">CONSULTER LES ACTUALITÉS</span></span>
        </div>
      </a>
  </div>
  <div class="syphrena-hero-divider-thin"></div>
</section>

<section class="syphrena-home-item" style="position: relative; background-image: url(../application/themes/default/assets/images/head-background-2.jpg)">
<div class="azeroth-hero-title">
  <div class="syphrena-hero-container">
    <div class="syphrena-hero-title">
        <span class="orange-shadow">Nos Fonctionnalités</span>
    </div>
    <div class="image-section">
      
      <div class="image-column">
        <div class="image-item">
          <img src="../assets/icon/sesame80.png" alt="Sésame">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title">Sésame</p></span>
            <p class="image-description">Idéal pour ceux qui souhaitent plonger rapidement dans le contenu de haut niveau. <a href="/fr/download" target="_blank">Nous Rejoindre</a><br><br><a href="/fr/news/10" target="_blank">Lire l'article..</a></br></p>
          </div>
        </div>
        <div class="image-item">
          <img src="../assets/icon/recuperations.png" alt="Récupération de personnage">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title">Récupération de personnage</p></span>
            <p class="image-description">Azeroth Universe propose un service de récupération de personnage en provenance d'autres serveurs privés/officiel. <a href="https://discord.com/invite/yDVSxdWFYx" target="_blank">Rejoindre Discord</a><br><br><a href="/fr/news/1" target="_blank">Lire l'article..</a></br></p>
          </div>
        </div>
        <div class="image-item">
          <img src="../assets/icon/breloque.png" alt="Conversion Breloques">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title">Conversion des Breloques</p></span>
            <p class="image-description">Vous pouvez obtenir des Breloques en votant pour le serveur : <br><a href="/fr/vote" target="_blank">Obtenir des Breloques Inférieures</a> <br><br><a href="/fr/news/7" target="_blank">Lire l'article..</a></br></p>
          </div>
        </div>
        <div class="image-item">
          <img src="../assets/icon/contributor.png" alt="Contributeur">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title">Contributeur</p></span>
            <p class="image-description">Grade exclusif permettant de profiter de nombreux avantages en jeu ! <br><a href="/fr/donate" target="_blank">Contribuer pour Azeroth Universe</a> <br><br><a href="/fr/news/2" target="_blank">Lire l'article..</a></br></p>
          </div>
        </div>
      </div>

      
      <div class="image-column">
		<div class="image-item">
          <img src="../assets/icon/interfactionah.png" alt="Interfaction PvE">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title">Interfaction</p></span>
            <p class="image-description">Les raids et donjons peuvent être réalisés en interfaction, facilitant ainsi l'organisation du PvE.</p>
          </div>
        </div>
        <div class="image-item">
          <img src="../assets/icon/expRate.png" alt="Modificateur d'expérience">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title">Modificateur d'expérience</p></span>
            <p class="image-description">Le modificateur d'expérience vous permet d'ajuster le gain d'XP pour une progression plus rapide ou plus lente selon vos préférences.</p>
          </div>
        </div>
        <div class="image-item">
          <img src="../assets/icon/Heirloom.png" alt="Équipement Héritage">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title">Équipement Héritage</p></span>
            <p class="image-description">L'équipement Héritage vous offre des objets qui augmentent vos statistiques et facilitent la montée en niveau de vos personnages.</p>
          </div>
        </div>
        <div class="image-item">
          <img src="../assets/icon/tmog.png" alt="Transmogrification">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title">Transmogrification</p></span>
            <p class="image-description">Transformez votre style en choisissant l'équipement de votre choix grâce à la monnaie de transmogrification.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="syphrena-hero-divider-thin"></div>
</section>

<section class="syphrena-home-item" style="position: relative; background-image: url(../application/themes/default/assets/images/tv-game.jpg)">
<div class="azeroth-hero-title">
  <div class="syphrena-hero-container">
        <div class="syphrena-hero-title">
            </i><span class="orange-shadow">AZEROTH UNIVERSE TV</span>
        </div>
        <p class="syphrena-hero-subtitle">Découvrez nos vidéos et contenus sur notre chaîne officielle Azeroth Universe TV.</p>
        <a href="https://www.youtube.com/@AzerothUniverseTV" class="syphrena-hero-button" target="_blank">
            <div class="syphrena-hero-button-inner">
                <span class="orange-shadow">
            <i class="fab fa-youtube"></i>
        </span>
        <span class="orange-shadow">REGARDER</span>
            </div>
        </a>
  </div>
  <div class="syphrena-hero-divider-thin"></div>
</section>


<!--<section class="syphrena-home-item" style="position: relative; background-image: url(../application/themes/default/assets/images/bann-game.jpg)">
    <div class="azeroth-hero-title">
        <div class="syphrena-hero-container syphrena-home-item-reversed">
            <div class="syphrena-hero-title">
                <span class="orange-shadow">PORTAIL VERS AZEROTH</span>
            </div>
            <p class="syphrena-hero-subtitle">Lancez le jeu, connectez-vous et plongez immédiatement dans l'aventure !</p>
            <a href="azeroth://" class="syphrena-hero-button">
                <div class="syphrena-hero-button-inner">
                    <span class="orange-shadow">🌀</span> <span class="orange-shadow">ENTRER DANS AZEROTH</span>
                </div>
            </a>
            <script>
                function launchApp() {
                    window.location.href = "azeroth://";
                }
            </script>
        </div>
        <div class="syphrena-hero-divider-thin"></div>
    </div>
</section>-->

<?php
// Connexion à la base de données Auth
$pdoAuth = new PDO('mysql:host=localhost:3309;dbname=auc_auth;charset=utf8mb4', 'root', 'root');

// Préparation de la requête pour obtenir le statut du royaume
$stmtRealmStatus = $pdoAuth->prepare("SELECT * FROM realmlist WHERE flag = 64 AND id = 1;");
$stmtRealmStatus->execute();
$realmStatus = $stmtRealmStatus->fetchColumn();

// Vérifier si le royaume est hors ligne
$isRealmOffline = ($realmStatus == 0);

// Connexion à la base de données des personnages
$pdoCharacters = new PDO('mysql:host=localhost:3309;dbname=auc_chars;charset=utf8mb4', 'root', 'root');

// Récupération du nombre de joueurs en ligne
$stmtOnlinePlayers = $pdoCharacters->prepare("SELECT COUNT(*) FROM characters WHERE online = 1");
$stmtOnlinePlayers->execute();
$onlinePlayers = $stmtOnlinePlayers->fetchColumn();

// Texte à afficher en fonction de l'état du royaume
$heroTitle = $isRealmOffline ? "Maintenance du royaume" : "Qui est en ligne ?";
$heroSubtitle = $isRealmOffline ?
    "Notre royaume est temporairement inaccessible. Revenez bientôt pour continuer votre épopée dans Azeroth Universe !" :
    "Actuellement, {$onlinePlayers} " . ($onlinePlayers >= 2 ? 'aventuriers' : 'aventurier') . " explorent les terres Azeroth Universe.";
?>

<section class="syphrena-home-item" style="background-image: url(../assets/images/syphrena/PMRXIDON1CB21725038037493.jpg)">
<div class="azeroth-hero-title">
    <div class="syphrena-hero-container">
	<div class="server-status">
    <span class="pulse <?php echo $isRealmOffline ? 'red' : 'green'; ?>"></span>
    <span class="orange-shadow"><span class="server-text"><?php echo $isRealmOffline ? 'Royaume hors ligne' : 'Royaume en ligne'; ?></span></span>
</div>
        <div class="syphrena-hero-title">
			<span class="orange-shadow"><?php echo $heroTitle; ?></span>
        </div>
        <div class="syphrena-hero-subtitle">
            <span class="orange-shadow"><?php echo $heroSubtitle; ?></span>
        </div>
        <div class="syphrena-hero-buttons">
            <?php if ($isRealmOffline): ?>
            <!--<a href="/time/frFR" class="syphrena-hero-button">
                <div class="syphrena-hero-button-inner">
                    <span class="orange-shadow">🕰️ TEMPS RESTANT</span>
                </div>
            </a>-->
            <?php else: ?>
            <a href="<?php echo base_url('online'); ?>" class="syphrena-hero-button">
                <div class="syphrena-hero-button-inner">
                    <span class="orange-shadow">👥 Voir les joueurs en ligne</span>
                </div>
            </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="syphrena-hero-divider-thin"></div>
</section>

<section class="syphrena-home-item" style="background-image: url(../assets/images/syphrena/head-background.jpg)">
<div class="azeroth-hero-title">
  <div class="syphrena-hero-container syphrena-home-item-reversed">
    <div class="syphrena-hero-title">
      <span class="orange-shadow">Besoin d'aide ?</span></span>
    </div>
    <div class="syphrena-hero-subtitle">
      <span class="orange-shadow">Rejoignez notre communauté Discord, l'endroit idéal pour trouver ce que vous cherchez !</span></span>
    </div>
    <div class="syphrena-hero-buttons">
      <a href="https://discord.gg/efTx9k4nfE" class="syphrena-hero-button">
        <div class="syphrena-hero-button-inner">
          <span class="orange-shadow">🌐</span></span> <span class="orange-shadow">REJOINDRE DISCORD</span></span>
        </div>
      </a>
    </div>
  </div>
  <div class="syphrena-hero-divider-thin"></div>
</section>
<script type="text/javascript">
  
    window.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    }, false);

   
    window.addEventListener('keydown', function (e) {
        if (e.keyCode === 123) { 
            e.preventDefault();
            alert("Les outils de développement sont désactivés.");
            return false;
        }
    }, false);

    
    window.addEventListener('keydown', function (e) {
        if ((e.ctrlKey && e.shiftKey && e.keyCode === 73) || 
            (e.ctrlKey && e.shiftKey && e.keyCode === 67) || 
            (e.ctrlKey && e.shiftKey && e.keyCode === 74) || 
            (e.ctrlKey && e.keyCode === 85)) {
            e.preventDefault();
            alert("Les outils de développement sont désactivés.");
            return false;
        }
    }, false);
</script>
