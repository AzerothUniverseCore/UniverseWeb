<section class="syphrena-hero">
    <div class="syphrena-hero-container">
      <video class="syphrena-background-video" src="https://azerothuniverse.org/application/themes/default/assets/videos/Azeroth.mp4" data-src="https://azerothuniverse.org/application/themes/default/assets/videos/Azeroth.mp4" loop="loop" muted="muted" preload="auto" autoplay="autoplay" playsinline="playsinline"></video>
      <div class="syphrena-hero-title">
        ⚠️ Maintenance ! ⚠️
      </div>
      <div class="syphrena-hero-subtitle" id="message">
        Les services sont temporairement indisponibles pour améliorer la qualité de Azeroth Universe.
      </div>
      <div class="syphrena-hero-buttons">
        <a href="https://azerothuniverse.org/maintenance.php" target="_blank" class="syphrena-hero-button">
          <div class="syphrena-hero-button-inner">
            🏹 SUIVRE LA PROGRESSION DE AZEROTH UNIVERSE
          </div>
        </a>
      </div>
    </div>
    <div class="syphrena-hero-divider-thick"></div>
  </section>

  <script>
    const messages = [
      "Les services sont temporairement indisponibles pour améliorer la qualité de Azeroth Universe.",
      "Vous pouvez suivre la progression de Azeroth Universe en cliquant sur le bouton ci-dessous."
    ];

    let currentIndex = 0;

    function changeMessage() {
      document.getElementById('message').textContent = messages[currentIndex];
      currentIndex = (currentIndex + 1) % messages.length;
    }

    setInterval(changeMessage, 2500);
  </script>
  
<section class="syphrena-home-item" style="background-image: url(../assets/images/syphrena/card-background-1.jpg)">
  <div class="syphrena-hero-container syphrena-home-item-reversed">
    <div class="syphrena-hero-title">
      Besoin d'aide ?
    </div>
    <div class="syphrena-hero-subtitle">
      Rejoignez notre communauté Discord, c'est l'endroit où vous découvrirez tout ce que vous cherchez.
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