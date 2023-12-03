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
        return [$game_total["red"], $game_total["green"], $game_total["blue"]];
    }

    function getCurrentGame($game) {
        return intval(explode(" ", $game)[1]);
    }

    function multiplyList($list) {
        $sum = 1;
        $length = count($list);
        for ($i = 0; $i < $length; $i++) {
            $sum *= $list[$i];
        }
        return $sum;
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

        $largest = [0, 0, 0];

        $gamesets = explode(";", $blocks);
        for ($j = 0; $j < count($gamesets); $j++) {
            $game_total = getGameRes($gamesets[$j]);

            for ($c = 0; $c < 3; $c++) {
                $game_total[$c] > $largest[$c] ? $largest[$c] = $game_total[$c] : null;
            }
        }
        $power = multiplyList($largest);
        $SUM += $power;
    }
    echo $SUM;
?>