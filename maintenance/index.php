<?php
session_start();

$maintenance_status = 'off';

$file = 'maintenance_start.txt';
$maintenance_duration = 32400; // 9 heures

if ($maintenance_status === 'on') {
    if (!file_exists($file)) {
        file_put_contents($file, time());
    }
    $maintenance_start = file_get_contents($file);
    $elapsed_time = time() - $maintenance_start;
    $progress = min(100, ($elapsed_time / $maintenance_duration) * 100);

    if ($progress >= 100) {
        unlink($file);
    }
} else {
    $progress = 0;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azeroth Universe</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            text-align: center;
            background: linear-gradient(135deg, #1f1c2c, #928DAB);
            color: #fff;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: rgba(20, 20, 20, 0.9);
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.6);
        }
        h1 {
            font-size: 36px;
            color: #f39c12;
        }
        p {
            font-size: 18px;
            color: #bdc3c7;
        }
        .progress-bar {
            width: 100%;
            background: #333;
            border-radius: 15px;
            margin-top: 20px;
            height: 20px;
        }
        .progress {
            height: 100%;
            width: <?php echo $progress; ?>%;
            background: #3498db;
            border-radius: 15px;
            transition: width 0.5s ease-in-out;
        }
        .status {
            margin-top: 20px;
            font-size: 22px;
            font-weight: bold;
            color: #ecf0f1;
        }
        .completed {
            color: #2ecc71;
        }
    </style>
    <script>
        function refreshProgress() {
            setTimeout(() => {
                window.location.reload();
            }, 5000);
        }
    </script>
</head>
<body onload="refreshProgress()">
    <div class="container">
        <?php if ($maintenance_status === 'on') : ?>
            <h1>🔧 Maintenance Azeroth Universe...</h1>
            <p>Nous travaillons pour améliorer Azeroth Universe. Merci de votre patience !</p>
            <div class="progress-bar">
                <div class="progress" style="width: <?php echo $progress; ?>%;"></div>
            </div>
            <p class="status">Progression : <?php echo round($progress, 2); ?>%</p>
            <?php if ($progress >= 100) echo "<p class='status completed'>✅ Maintenance terminée ! Le royaume est opérationnel.</p>"; ?>
        <?php else : ?>
            <h1>✅ Azeroth Universe est en ligne !</h1>
            <p>Le serveur est opérationnel. Profitez du jeu !</p>
        <?php endif; ?>
    </div>
</body>
</html>
