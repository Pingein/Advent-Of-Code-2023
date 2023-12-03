<?php
    // https://adventofcode.com/2023/day/2
    // The Elf would first like to know which games would have been possible if 
    // the bag contained only 12 red cubes, 13 green cubes, and 14 blue cubes?
?>

<?php // fns
    function getGameRes($game) {
        $game_total = ["red" => 0, "green" => 0, "blue" => 0];
        $colors = explode(",", $game);
        for ($k = 0; $k < count($colors); $k++) {
            $split = explode(" ", $colors[$k]);
            $count = trim($split[1]);
            $color = trim($split[2]);
            $game_total[$color] = intval($count);
        }
        return $game_total;
    }

    function isValidGame($game_total): bool {
        if (
            $game_total["red"] > 12 || 
            $game_total["green"] > 13 ||
            $game_total["blue"] > 14
            ) {
            return false;
        }
        return true;
    }

    function getCurrentGame($game) {
        return intval(explode(" ", $game)[1]);
    }
?>

<?php
    $filename = "input.txt";
    $file = fopen($filename, "r");
    
    if (!$file) {
        echo "file not found\n";
    }
    
    $contents = fread($file, filesize($filename));
    fclose($file);
    
    $lines = explode("\n", $contents);
    $linecount = count($lines);

    $SUM = 0;

    for ($i = 0; $i<$linecount; $i++) {
        $line = $lines[$i];
        
        $info = explode(":", $line);
        $game = getCurrentGame($info[0]);
        $blocks = $info[1];

        $isValid = true;

        $gamesets = explode(";", $blocks);
        for ($j = 0; $j < count($gamesets); $j++) {
            $game_total = getGameRes($gamesets[$j]);

            if (!isValidGame($game_total)) {
                $isValid = false;
            }
        }

        if ($isValid) {
            $SUM += $game;
        }
    }
    echo $SUM;
?>