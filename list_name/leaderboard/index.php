<?php
$json = file_get_contents("./data.json");
$list = json_decode($json, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDPS_Name List_Name</title>
    <link rel="stylesheet" href="../../assets/css/main.css">
    <style>
        .container { max-width: 600px; margin: 0 auto; }
        .level-entry { margin: 15px 0; }
        .level-number { font-size: 1.2em; font-weight: bold; }
        .level-info h2, .creator, .verifier { font-family: Arial, sans-serif; margin: 5px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1 align="center">GDPS_Name List_Name Leaderboard</h1>
        
        <div class="jump-section">
            <h1>Teleporter</h1>
            <p>Jumps to a selected player.</p>
            <label for="playerInput">Go to player</label>
            <input type="number" id="playerInput" min="0" max="<?= count($list) ?>" placeholder="Placement">
            <button onclick="jumpToPlayer()">Go</button>
        </div>

        <?php
        $index = 0;
        foreach ($list as $player) {
            $index++;
            ?>
            <section id="<?= $index ?>">
            <div class="level-entry">
                <div class="level-number">#<?= $index ?></div>
                <div class="level-info">
                    <h2><?= htmlspecialchars($player['player_name']) ?></h2>
                    <p><?= htmlspecialchars($player['player_points']) ?></p>
                    <p><?= htmlspecialchars($player['player_hardest']) ?></p>
                    <p><?= htmlspecialchars($player['player_count']) ?></p>
                </div>
            </div>
            </section>
            <?php
        }
        ?>
    </div>
    <script>
        function jumpToPlayer() {
            const player = document.getElementById('playerInput').value;
            const max = <?= count($list) ?>;
            
            if (player && player >= 1 && player <= max) {
                window.location.hash = player;
            }
            else {
                alert('Err: inputted player does not exist. Input a player by their placement.');
                console.log("Error");
            }
        }
        
        document.getElementById('playerInput').addEventListener('keypress', function(x) {
            if (x.key === 'Enter') {
                jumpToPlayer();
            }
        });
    </script>
</body>
</html>