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
    <link rel="stylesheet" href="../assets/css/main.css">
    <style>
        .container { max-width: 600px; margin: 0 auto; }
        .level-entry { margin: 15px 0; }
        .level-number { font-size: 1.2em; font-weight: bold; }
        .level-info h2, .creator, .verifier { font-family: Arial, sans-serif; margin: 5px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1 align="center">GDPS_Name List_Name</h1>
        
        <div class="jump-section">
            <h1>Teleporter</h1>
            <p>Jumps to a selected level.</p>
            <label for="levelInput">Go to level</label>
            <input type="number" id="levelInput" min="0" max="<?= count($list) ?>" placeholder="Placement">
            <button onclick="jumpToLevel()">Go</button>
        </div>

        <br>

        <div class="jump-section">
            <h1>Roulette</h1>
            <p>Jumps to a random level on the list.<p>
            <button onclick="jumpToRandomLevel()">Go</button>
        </div>

        <?php
        $index = 0;
        foreach ($list as $level) {
            $index++;
            ?>
            <section id="<?= $index ?>">
            <div class="level-entry">
                <div class="level-number">#<?= $index ?></div>
                <div class="level-info">
                    <h2><?= htmlspecialchars($level['level_name']) ?></h2>
                    <p>ID: <?= htmlspecialchars($level['level_id']) ?></p>
                    <p>Creators: <?= htmlspecialchars($level['level_creators']) ?></p>
                    <p>Verifier: <?= htmlspecialchars($level['level_verifier']) ?></p>
                </div>
            </div>
            </section>
            <?php
        }
        ?>
    </div>

    <script>
        function jumpToLevel() {
            const level = document.getElementById('levelInput').value;
            const max = <?= count($list) ?>;
            
            if (level && level >= 1 && level <= max) {
                window.location.hash = level;
            }
            else {
                alert('Err: inputted level does not exist. Input a level by its placement.');
                console.log("Error");
            }
        }
        
        document.getElementById('levelInput').addEventListener('keypress', function(x) {
            if (x.key === 'Enter') {
                jumpToLevel();
            }
        });

        function jumpToRandomLevel() {
            const maxLevel = <?= count($list) ?>;
            const level = Math.floor(Math.random() * maxLevel) + 1;
            const percent = Math.floor(Math.random() * 100) + 1;
            
            window.location.hash = level;

            alert("Get " + percent + "% on level #" + level + ".");
            
            console.log("Jumped to Level: #" + level + ".");
            console.log("Required percent: " + percent + ".")
        }
    </script>
</body>
</html>