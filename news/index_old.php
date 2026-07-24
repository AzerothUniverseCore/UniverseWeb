<?php
/**
 * Azeroth Universe - Page "Actualites" / "News" (page statique hors CodeIgniter)
 *
 * Cette page vit en dehors de l'application CodeIgniter (elle est servie
 * directement par Apache depuis /news/ car .htaccess ne reecrit pas les
 * URLs qui correspondent a un dossier reel). Elle n'a donc pas acces au
 * systeme de langue MY_Lang du CMS ni a ses tables via CI_DB.
 *
 * Bilingue : la langue est choisie via le lien FR/EN en haut de page
 * (parametre ?lang=fr|en, memorise ensuite dans un cookie), avec une
 * detection Accept-Language en secours et repli sur le francais (langue
 * par defaut du site).
 *
 * Donnees : les news ne sont plus codees en dur, elles viennent des tables
 * `news` (anglais) / `newsfr` (francais) deja utilisees par le module
 * News du CMS (auc_website) - pas besoin d'une table supplementaire,
 * cela evite d'avoir deux endroits differents a mettre a jour pour la
 * meme actualite. Les identifiants d'articles restent donc les memes
 * que ceux utilises par /fr/news/{id} et /en/news/{id}.
 */

// ------------------------------------------------------------------
// Langue
// ------------------------------------------------------------------
$lang = 'fr';

if (isset($_GET['lang']) && in_array($_GET['lang'], ['fr', 'en'], true)) {
    $lang = $_GET['lang'];
    setcookie('auc_lang', $lang, time() + 60 * 60 * 24 * 365, '/');
} elseif (isset($_COOKIE['auc_lang']) && in_array($_COOKIE['auc_lang'], ['fr', 'en'], true)) {
    $lang = $_COOKIE['auc_lang'];
} elseif (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) && stripos($_SERVER['HTTP_ACCEPT_LANGUAGE'], 'en') === 0) {
    $lang = 'en';
}

$newsTable = ($lang === 'en') ? 'news' : 'newsfr';

// ------------------------------------------------------------------
// Traductions de l'interface (textes fixes de cette page)
// ------------------------------------------------------------------
$i18n = [
    'fr' => [
        'html_lang'      => 'fr',
        'page_title'     => 'Azeroth Universe - Actualités',
        'heading'        => 'Nos Actualités',
        'copyright_name' => 'Azeroth Universe',
        'rights'         => 'Tous droits réservés.',
        'trademark'      => "Toutes les marques citées appartiennent à leurs propriétaires respectifs.",
        'devtools_alert' => 'Les outils de développement sont désactivés.',
        'logo_alt'       => 'Azeroth Universe Logo',
        'empty_list'     => 'Aucune actualité pour le moment.',
    ],
    'en' => [
        'html_lang'      => 'en',
        'page_title'     => 'Azeroth Universe - News',
        'heading'        => 'Our News',
        'copyright_name' => 'Azeroth Universe',
        'rights'         => 'All rights reserved.',
        'trademark'      => 'All trademarks mentioned belong to their respective owners.',
        'devtools_alert' => 'Developer tools are disabled.',
        'logo_alt'       => 'Azeroth Universe Logo',
        'empty_list'     => 'No news available yet.',
    ],
];
$t = $i18n[$lang];

// ------------------------------------------------------------------
// Connexion DB (reprend la configuration CodeIgniter existante, pour ne
// pas dupliquer les identifiants de connexion dans ce fichier)
// ------------------------------------------------------------------
$newsList = [];
$dbConfigPath = __DIR__ . '/../application/config/database.php';

if (is_file($dbConfigPath)) {
    // Les fichiers de config CodeIgniter commencent tous par
    // `defined('BASEPATH') OR exit('No direct script access allowed');`.
    // Cette page n'est pas bootstrappee par CodeIgniter (BASEPATH n'existe
    // pas), donc sans cette ligne l'inclusion de database.php stoppe tout
    // le script avec ce message. Definir la constante suffit a satisfaire
    // le garde-fou sans avoir a charger tout le framework.
    if (!defined('BASEPATH')) {
        define('BASEPATH', true);
    }

    // database.php choisit sa config via un switch(ENVIRONMENT). Cette
    // constante est normalement definie par index.php (le front
    // controller de CodeIgniter) ; on reprend exactement la meme logique
    // ici pour tomber sur le meme environnement (donc les memes
    // identifiants) que le reste du site.
    if (!defined('ENVIRONMENT')) {
        define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
    }

    require $dbConfigPath;

    $activeGroup = isset($active_group) ? $active_group : 'default';
    $conf = isset($db[$activeGroup]) ? $db[$activeGroup] : (isset($db['default']) ? $db['default'] : null);

    if ($conf) {
        try {
            $pdo = new PDO(
                'mysql:host=' . $conf['hostname'] . ';dbname=' . $conf['database'] . ';charset=utf8mb4',
                $conf['username'],
                $conf['password'],
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

            $stmt = $pdo->query("SELECT `id`, `title`, `description`, `image`, `date` FROM `{$newsTable}` ORDER BY `date` DESC");
            $newsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $newsList = [];
        }
    }
}

/**
 * Apercu texte propre (sans HTML) pour la carte d'actualite.
 */
function auc_news_preview($html, $maxLength = 150)
{
    $text = html_entity_decode(strip_tags($html), ENT_QUOTES, 'UTF-8');
    $text = preg_replace('/\s+/u', ' ', trim($text));

    $preview = function_exists('mb_substr')
        ? mb_substr($text, 0, $maxLength, 'UTF-8')
        : substr($text, 0, $maxLength);

    return htmlspecialchars($preview, ENT_QUOTES, 'UTF-8') . '...';
}
?>

<!DOCTYPE html>
<html lang="<?= $t['html_lang'] ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title><?= htmlspecialchars($t['page_title']) ?></title>
    <link rel="stylesheet" href="style.css">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>

    <section class="news-section">
        <div class="news-container">
    <section class="home-logo-container">
        <a href="/<?= $lang ?>/" class="home-logo-link">
            <img src="UniverseLogo.png" alt="<?= htmlspecialchars($t['logo_alt']) ?>" class="home-logo">
        </a>
        <div class="news-lang-switch">
            <a href="?lang=fr" class="<?= $lang === 'fr' ? 'active' : '' ?>">FR</a>
            <a href="?lang=en" class="<?= $lang === 'en' ? 'active' : '' ?>">EN</a>
        </div>
    </section>
            <div class="azeroth-hero-title">
                <span class="orange-shadow"><h1><u><?= htmlspecialchars($t['heading']) ?></u></h1></span>
            </div>
            <div class="news-list">
                <?php if (empty($newsList)) : ?>
                    <p style="text-align:center;"><?= htmlspecialchars($t['empty_list']) ?></p>
                <?php else : ?>
                    <?php foreach ($newsList as $news) : ?>
                        <div class="news-item">
                            <a href="/<?= $lang ?>/news/<?= (int) $news['id'] ?>" class="news-link">
                                <div class="news-image" style="background-image: url('../assets/images/news/<?= htmlspecialchars($news['image']) ?>');"></div>
                                <div class="news-content">
                                    <h2 class="news-title"><?= htmlspecialchars($news['title']) ?></h2>
                                    <p class="news-date">🕒<?= date('d M Y', (int) $news['date']) ?></p>
                                    <p class="news-description"><?= auc_news_preview($news['description'], 150) ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
<section class="footer-section">
    <p class="footer-text">
        <i class="far fa-copyright"></i> <?= date('Y'); ?>
        <a href="/<?= $lang ?>/" class="footer-link"><?= htmlspecialchars($t['copyright_name']) ?></a>. <?= htmlspecialchars($t['rights']) ?>
    </p>
    <p class="footer-small-text">
        <?= htmlspecialchars($t['trademark']) ?>
    </p>
</section>
</body>
</html>
<script type="text/javascript">
    var auc_devtools_msg = <?= json_encode($t['devtools_alert']) ?>;

    window.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    }, false);


    window.addEventListener('keydown', function (e) {
        if (e.keyCode === 123) {
            e.preventDefault();
            alert(auc_devtools_msg);
            return false;
        }
    }, false);


    window.addEventListener('keydown', function (e) {
        if ((e.ctrlKey && e.shiftKey && e.keyCode === 73) ||
            (e.ctrlKey && e.shiftKey && e.keyCode === 67) ||
            (e.ctrlKey && e.shiftKey && e.keyCode === 74) ||
            (e.ctrlKey && e.keyCode === 85)) {
            e.preventDefault();
            alert(auc_devtools_msg);
            return false;
        }
    }, false);
</script>
