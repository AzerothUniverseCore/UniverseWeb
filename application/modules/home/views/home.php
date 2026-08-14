<section class="syphrena-hero">
<div class="azeroth-hero-title">
  <div class="syphrena-hero-container">
    <video class="syphrena-background-video" src="../application/themes/default/assets/videos/Azeroth.mp4" data-src="../application/themes/default/assets/videos/Azeroth.mp4" loop="loop" muted="muted" preload="auto" autoplay="autoplay" playsinline="playsinline"></video>
    <div class="syphrena-hero-title">
      <span class="orange-shadow"><?= $this->lang->line('home_hero_title'); ?></span></span> <span class="bfa-orange"><span class="orange-shadow"></span></span>
    </div>
    <div class="syphrena-hero-subtitle">
      <span class="orange-shadow"><?= $this->lang->line('home_hero_subtitle'); ?></span></span> <span class="bfa-orange"><span class="orange-shadow"></span></span>
    </div>
    <div class="syphrena-hero-buttons">
      <a href="<?= site_url("download"); ?>" class="syphrena-hero-button">
        <div class="syphrena-hero-button-inner">
          <span class="orange-shadow">🧙</span></span> <span class="orange-shadow"><?= $this->lang->line('home_hero_play'); ?></span></span>
        </div>
      </a>
    </div>
  </div>
  <div class="syphrena-hero-divider-thick"></div>
</section>

<section class="syphrena-home-item" style="position: relative; background-image: url(../application/themes/default/assets/images/background-universe.jpg)">
  <div class="syphrena-hero-container">
    <div class="syphrena-hero-title">
      <span class="orange-shadow"><?= $this->lang->line('home_adventure_title'); ?></span>
    </div>
	<div class="azeroth-hero-title">
    <div class="azeroth-universe-description">
      <span class="orange-shadow"><p><?= $this->lang->line('home_adventure_description'); ?></p></span>
    </div>
	</div>
	<a href="<?= site_url("register"); ?>" class="syphrena-hero-button">
        <div class="syphrena-hero-button-inner">
          <span class="orange-shadow">🏹</span></span> <span class="orange-shadow"><?= $this->lang->line('home_hero_join_button'); ?></span></span>
        </div>
      </a>
  </div>
  <div class="syphrena-hero-divider-thin"></div>
</section>

<section class="syphrena-home-item" style="position: relative; background-image: url(../application/themes/default/assets/images/WoW_-_Midnight_Launch_-_Hotfixes1280x380.png)">
  <div class="syphrena-hero-container">
    <div class="syphrena-hero-title">
      <span class="orange-shadow"><?= $this->lang->line('home_content_title'); ?></span>
    </div>
	<div class="azeroth-hero-title">
    <div class="azeroth-universe-description">
      <span class="orange-shadow"><p><?= $this->lang->line('home_content_description'); ?></p></span>
    </div>
	</div>
	<a href="https://azeroth-universe.eu/content.php" class="syphrena-hero-button" target="_blank">
        <div class="syphrena-hero-button-inner">
          <span class="orange-shadow">🏹</span></span> <span class="orange-shadow"><?= $this->lang->line('home_content_button'); ?></span></span>
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
            <span class="orange-shadow"><?= $this->lang->line('home_news_section_title'); ?></span>
        </div>
    <div class="syphrena-hero-title"></div>
    <div class="syphrena-news-list">
      <?php if ($this->wowmodule->getNewsStatus()) : ?>
        <?php for ($i = 0; $i < 4; $i++) { ?>
          <a href="<?= site_url('news/' . $NewsList[$i]->id); ?>" class="syphrena-new" style="background-image: linear-gradient(0deg, black, transparent), url(<?= base_url('assets/images/news/' . $NewsList[$i]->image); ?>)">
            <div class="syphrena-new-title syphrena-new-title-centered"><?php echo $NewsList[$i]->title ?></div>
			<br>
            <div class="syphrena-new-subtitle">
			<p class="syphrena-new-meta">
                🕒 <?= date('d M Y', $NewsList[$i]->date) ?>
              </p>
              <span class="orange-shadow"><p><?php echo strlen($NewsList[$i]->description) > 0 ? substr($NewsList[$i]->description, 0, 0) . $this->lang->line('home_news_read_more') : $NewsList[$i]->description; ?></p></span>
            </div>
          </a>
        <?php } ?>
      <?php endif ?>
    </div>
	<a href="<?= base_url('news/?lang=' . $this->lang->lang()); ?>" class="syphrena-hero-button">
        <div class="syphrena-hero-button-inner">
          <span class="orange-shadow">📜</span></span> <span class="orange-shadow"><?= $this->lang->line('home_news_view_all'); ?></span></span>
        </div>
      </a>
  </div>
  <div class="syphrena-hero-divider-thin"></div>
</section>

<section class="syphrena-home-item" style="position: relative; background-image: url(../application/themes/default/assets/images/head-background-2.jpg)">
<div class="azeroth-hero-title">
  <div class="syphrena-hero-container">
    <div class="syphrena-hero-title">
        <span class="orange-shadow"><?= $this->lang->line('home_features_title'); ?></span>
    </div>
    <div class="image-section">
      
      <div class="image-column">
        <div class="image-item">
          <img src="../assets/icon/sesame80.png" alt="<?= $this->lang->line('home_feature_sesame_title'); ?>">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title"><?= $this->lang->line('home_feature_sesame_title'); ?></p></span>
            <p class="image-description"><?= $this->lang->line('home_feature_sesame_desc'); ?> <a href="<?= site_url('download'); ?>" target="_blank"><?= $this->lang->line('home_feature_join_us_link'); ?></a><br><br><a href="<?= site_url('news/10'); ?>" target="_blank"><?= $this->lang->line('home_read_article'); ?></a></br></p>
          </div>
        </div>
        <div class="image-item">
          <img src="../assets/icon/recuperations.png" alt="<?= $this->lang->line('home_feature_recovery_title'); ?>">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title"><?= $this->lang->line('home_feature_recovery_title'); ?></p></span>
            <p class="image-description"><?= $this->lang->line('home_feature_recovery_desc'); ?> <a href="https://discord.gg/yBnzhaJChf" target="_blank"><?= $this->lang->line('home_feature_join_discord_link'); ?></a><br><br><a href="<?= site_url('news/1'); ?>" target="_blank"><?= $this->lang->line('home_read_article'); ?></a></br></p>
          </div>
        </div>
        <div class="image-item">
          <img src="../assets/icon/breloque.png" alt="Conversion Breloques">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title"><?= $this->lang->line('home_feature_trinkets_title'); ?></p></span>
            <p class="image-description"><?= $this->lang->line('home_feature_trinkets_desc'); ?> <br><a href="<?= site_url('vote'); ?>" target="_blank"><?= $this->lang->line('home_feature_trinkets_link'); ?></a> <br><br><a href="<?= site_url('news/7'); ?>" target="_blank"><?= $this->lang->line('home_read_article'); ?></a></br></p>
          </div>
        </div>
        <div class="image-item">
          <img src="../assets/icon/contributor.png" alt="Contributeur">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title"><?= $this->lang->line('home_feature_contributor_title'); ?></p></span>
            <p class="image-description"><?= $this->lang->line('home_feature_contributor_desc'); ?> <br><a href="<?= site_url('donate'); ?>" target="_blank"><?= $this->lang->line('home_feature_contributor_link'); ?></a> <br><br><a href="<?= site_url('news/2'); ?>" target="_blank"><?= $this->lang->line('home_read_article'); ?></a></br></p>
          </div>
        </div>
      </div>

      
      <div class="image-column">
		<div class="image-item">
          <img src="../assets/icon/interfactionah.png" alt="Interfaction PvE">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title"><?= $this->lang->line('home_feature_crossfaction_title'); ?></p></span>
            <p class="image-description"><?= $this->lang->line('home_feature_crossfaction_desc'); ?></p>
          </div>
        </div>
        <div class="image-item">
          <img src="../assets/icon/expRate.png" alt="<?= $this->lang->line('home_feature_exprate_title'); ?>">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title"><?= $this->lang->line('home_feature_exprate_title'); ?></p></span>
            <p class="image-description"><?= $this->lang->line('home_feature_exprate_desc'); ?></p>
          </div>
        </div>
        <div class="image-item">
          <img src="../assets/icon/Heirloom.png" alt="<?= $this->lang->line('home_feature_heirloom_title'); ?>">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title"><?= $this->lang->line('home_feature_heirloom_title'); ?></p></span>
            <p class="image-description"><?= $this->lang->line('home_feature_heirloom_desc'); ?></p>
          </div>
        </div>
        <div class="image-item">
          <img src="../assets/icon/tmog.png" alt="Transmogrification">
          <div class="image-text">
            <span class="orange-shadow"><p class="image-title"><?= $this->lang->line('home_feature_transmog_title'); ?></p></span>
            <p class="image-description"><?= $this->lang->line('home_feature_transmog_desc'); ?></p>
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
            </i><span class="orange-shadow"><?= $this->lang->line('home_tv_title'); ?></span>
        </div>
        <p class="syphrena-hero-subtitle"><?= $this->lang->line('home_tv_subtitle'); ?></p>
        <a href="https://www.youtube.com/@AzerothUniverseTV" class="syphrena-hero-button" target="_blank">
            <div class="syphrena-hero-button-inner">
                <span class="orange-shadow">
            <i class="fab fa-youtube"></i>
        </span>
        <span class="orange-shadow"><?= $this->lang->line('home_tv_watch'); ?></span>
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



<section class="syphrena-home-item" style="background-image: url(../assets/images/syphrena/head-background.jpg)">
<div class="azeroth-hero-title">
  <div class="syphrena-hero-container syphrena-home-item-reversed">
    <div class="syphrena-hero-title">
      <span class="orange-shadow"><?= $this->lang->line('home_help_title'); ?></span></span>
    </div>
    <div class="syphrena-hero-subtitle">
      <span class="orange-shadow"><?= $this->lang->line('home_help_subtitle'); ?></span></span>
    </div>
    <div class="syphrena-hero-buttons">
      <a href="https://discord.gg/yBnzhaJChf" class="syphrena-hero-button">
        <div class="syphrena-hero-button-inner">
          <span class="orange-shadow">🌐</span></span> <span class="orange-shadow"><?= $this->lang->line('home_join_discord_button'); ?></span></span>
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
            alert("<?= $this->lang->line('home_devtools_disabled'); ?>");
            return false;
        }
    }, false);

    
    window.addEventListener('keydown', function (e) {
        if ((e.ctrlKey && e.shiftKey && e.keyCode === 73) || 
            (e.ctrlKey && e.shiftKey && e.keyCode === 67) || 
            (e.ctrlKey && e.shiftKey && e.keyCode === 74) || 
            (e.ctrlKey && e.keyCode === 85)) {
            e.preventDefault();
            alert("<?= $this->lang->line('home_devtools_disabled'); ?>");
            return false;
        }
    }, false);
</script>
