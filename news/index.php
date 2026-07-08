<?php
$newsList = [
	(object)[
        'id' => 10,
        'title' => 'Sésame de bienvenue',
        'description' => 'Idéal pour ceux qui souhaitent plonger rapidement dans le contenu de haut niveau.',
        'image' => 'SesameWelcome.PNG',
        'date' => strtotime('2025-03-10')
    ],
	(object)[
        'id' => 9,
        'title' => 'Présentation des races',
        'description' => 'Plongez dans une expérience unique avec un large éventail de choix pour façonner votre personnage !',
        'image' => 'WOW_VASRaceChangeUpdate_shop_1x_1920x1080.jpg',
        'date' => strtotime('2025-03-10')
    ],
	(object)[
        'id' => 8,
        'title' => 'Azeroth Universe Trailer',
        'description' => 'Présentation du trailer Azeroth Universe',
        'image' => '866690.png',
        'date' => strtotime('2025-03-10')
    ],
	(object)[
        'id' => 1,
        'title' => 'Récupération de Personnage',
        'description' => 'Azeroth Universe propose un service de récupération de personnage en provenance d\'autres serveurs privés/officiel de World of Warcraft.',
        'image' => 'recuperation-personnage.jpg',
        'date' => strtotime('2025-03-06')
    ],
	(object)[
        'id' => 2,
        'title' => 'Grade Contributeur',
        'description' => 'Grade exclusif qui vous permet de profiter de nombreux avantages en jeu !',
        'image' => 'ContributorNews.png',
        'date' => strtotime('2025-03-05')
    ],
	(object)[
        'id' => 3,
        'title' => 'Présentation de notre contenu',
        'description' => 'Découvrez un aperçu de notre contenu en jeu.',
        'image' => 'PresentationContent.png',
        'date' => strtotime('2025-03-04')
    ],
	(object)[
        'id' => 4,
        'title' => 'Guide de démarrage',
        'description' => 'Ce guide a pour but d’aider les joueurs en répondant aux questions fréquemment posées et en les orientant vers les différents lieux du jeu.',
        'image' => 'background_bfa_guide_mecagone.jpg',
        'date' => strtotime('2025-03-03')
    ],
	(object)[
        'id' => 5,
        'title' => '#1 Event Azeroth Universe',
        'description' => 'Aperçu de l’événement à venir sur Azeroth Universe ! L’événement approche à grands pas, et voici un petit aperçu de ce qui vous attend !',
        'image' => 'campagne-du-reve-demeraude-57.jpg',
        'date' => strtotime('2025-03-02')
    ],
	(object)[
        'id' => 6,
        'title' => 'Recrutement chez Azeroth Universe',
        'description' => 'Nous cherchons des joueurs motivés pour rejoindre l\'équipe et contribuer au développement du serveur.',
        'image' => '1020721.jpg',
        'date' => strtotime('2025-03-01')
    ],
	(object)[
        'id' => 7,
        'title' => 'Conversion des Breloques',
        'description' => 'Vous pouvez obtenir des Breloques Inférieures en votant pour le serveur',
        'image' => 'T1KUF7O5LNYI1684527730121.jpg',
        'date' => strtotime('2025-02-28')
    ],
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Azeroth Universe - Actualités</title>
    <link rel="stylesheet" href="style.css">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>

    <section class="news-section">
        <div class="news-container">
    <section class="home-logo-container">
        <a href="/fr/" class="home-logo-link">
            <img src="UniverseLogo.png" alt="Azeroth Universe Logo" class="home-logo">
        </a>
    </section>
            <div class="azeroth-hero-title">
                <span class="orange-shadow"><h1><u>Nos Actualités</u></h1></span>
            </div>
            <div class="news-list">
                <?php foreach ($newsList as $news) : ?>
                    <div class="news-item">
                        <a href="/fr/news/<?= $news->id ?>" class="news-link">
                            <div class="news-image" style="background-image: url('<?= $news->image ?>');"></div>
                            <div class="news-content">
                                <h2 class="news-title"><?= htmlspecialchars($news->title) ?></h2>
                                <p class="news-date">🕒<?= date('d M Y', $news->date) ?></p>
                                <p class="news-description"><?= htmlspecialchars(substr($news->description, 0, 150)) ?>...</p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<section class="footer-section">
    <p class="footer-text">
        <i class="far fa-copyright"></i> <?= date('Y'); ?> 
        <a href="/fr/" class="footer-link">Azeroth Universe</a>. Tous droits réservés.
    </p>
    <p class="footer-small-text">
        Toutes les marques citées appartiennent à leurs propriétaires respectifs.
    </p>
</section>
</body>
</html>
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
