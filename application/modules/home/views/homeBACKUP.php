<section class="syphrena-hero">
  <div class="syphrena-hero-container">
    <video class="syphrena-background-video" src="https://fr.syphrena.eu/application/themes/default/assets/images/slides/syphrena.mp4" data-src="https://fr.syphrena.eu/application/themes/default/assets/images/slides/syphrena.mp4" loop="loop" muted="muted" preload="auto" autoplay="autoplay" playsinline="playsinline"></video>
    <div class="syphrena-hero-title">
      Rejoignez la bataille de Syphrena !
    </div>
    <div class="syphrena-hero-subtitle">
      Venez vous battre pour votre faction avec une expérience inédite de l'extension Syphrena !
    </div>
    <div class="syphrena-hero-buttons">
      <a href="<?= base_url("/register"); ?>" class="syphrena-hero-button">
        <div class="syphrena-hero-button-inner">
          🏹 NOUS REJOINDRE
        </div>
      </a>
      <a href="<?= base_url("/download"); ?>" class="syphrena-hero-button">
        <div class="syphrena-hero-button-inner">
          📜 CLIENT
        </div>
      </a>
    </div>
  </div>
  <div class="syphrena-hero-divider-thick"></div>
</section>

<section class="syphrena-home-item" style="background-image: url(../application/themes/default/assets/images/default-background.jpg)">
  <div class="syphrena-hero-container">
    <div class="syphrena-hero-title">
     
    </div>
    <div class="syphrena-news-list">
      <?php if ($this->wowmodule->getNewsStatus()) : ?>
        <?php for ($i = 0; $i < 3; $i++) { ?>
          <a href="<?= base_url('news/' . $NewsList[$i]->id); ?>" class="syphrena-new" style="background-image: linear-gradient(0deg, black, transparent), url(<?= base_url('assets/images/news/' . $NewsList[$i]->image); ?>)">
            <div class="syphrena-new-title">
              <?php echo $NewsList[$i]->title ?>
            </div>
            <div class="syphrena-new-subtitle">
              <p>
			  
                <?php /* echo strlen($NewsList[$i]->description) > 142 ? substr($NewsList[$i]->description, 0, 142) . "..." : $NewsList[$i]->description; */ ?>
			
              </p>
            </div>
          </a>
        <?php } ?>
      <?php endif ?>
    </div>
  </div>
  <div class="syphrena-hero-divider-thin"></div>
</section>

<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost:3309;dbname=sclbot_chars;charset=utf8mb4', 'root', 'root');

// Préparation de la requête
$stmt = $pdo->prepare("SELECT COUNT(*) as total FROM 
    (SELECT * FROM characters WHERE online = 1 
    UNION ALL 
    SELECT * FROM characters_bots WHERE online = 1) as combined");

// Exécution de la requête
$stmt->execute();

// Récupération du nombre de joueurs en ligne
$onlinePlayers = $stmt->fetchColumn();
?>

<section class="syphrena-home-item" style="background-image: url(../assets/images/syphrena/card-background-10.jpg)">
  <div class="syphrena-hero-container">
    <div class="syphrena-hero-title">
      Qui est en ligne ?
    </div>
    <div class="syphrena-hero-subtitle">
      Jetez un coup d'œil à notre liste de joueurs si vous voulez trouver des amis avec qui jouer ! 
      Nous avons <?php echo $onlinePlayers ?> <?php echo $onlinePlayers >= 2 ? 'joueurs' : 'joueur' ?> en ligne.
    </div>
    <div class="syphrena-hero-buttons">
      <a href="<?= base_url("online"); ?>" class="syphrena-hero-button">
        <div class="syphrena-hero-button-inner">
          👀 REGARDER
        </div>
      </a>
    </div>
  </div>
  <div class="syphrena-hero-divider-thin"></div>
</section>


<section class="syphrena-home-item" style="background-image: url(../assets/images/syphrena/card-background-1.jpg)">
  <div class="syphrena-hero-container syphrena-home-item-reversed">
    <div class="syphrena-hero-title">
      Besoin d'aide ?
    </div>
    <div class="syphrena-hero-subtitle">
      Rejoignez notre communauté Discord, c'est l'endroit que vous trouverez ce que vous cherchez.
    </div>
    <div class="syphrena-hero-buttons">
      <a href="https://discord.com/invite/m5Ar25Bh5N" class="syphrena-hero-button">
        <div class="syphrena-hero-button-inner">
          🌐 REJOINDRE DISCORD
        </div>
      </a>
    </div>
  </div>
  <div class="syphrena-hero-divider-thin"></div>
</section>
