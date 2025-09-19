<?php
if (isset($_GET['string'], $_GET['array']) && $_GET['string'] !== '' && $_GET['array'] !== '') {
    $string = $_GET['string'];
    $array = $_GET['array'];

    $queryArray = array_map('intval', explode(',', $array));
    
    function getWeights($s) {
        $weights = [];
        $prevChar = '';
        $currentWeight = 0;
        
        for ($i = 0; $i < strlen($s); $i++) {
            $char = $s[$i];
            $range = range('a', 'z');
            $alphabet = array_flip($range);

            $charWeight = $alphabet[$char] + 1;
            
            // jika characater sama dengan sebelumnya
            if ($char === $prevChar) {
                $currentWeight += $charWeight;
            } else {
                // mengubah kembali nilai jika tidak sama
                $currentWeight = $charWeight;
                $prevChar = $char;
            }
            
            $weights[$currentWeight] = true;
        }
        
        return $weights;
    }
    
    
    $weights = getWeights($string);
    
    $results = [];
    foreach ($queryArray as $index => $q) {
        $results[$queryArray[$index]] = isset($weights[$q]) ? "Yes" : "No";
    }
}

?>
<!DOCTYPE html>
<html>
<body>

<h1>Weighted Strings Test</h1>

<form action="">
    <label for="string">Input String</label>
    <input type="text" name="string" id="string" 
           value="<?= htmlspecialchars($_GET['string'] ?? '') ?>"> <br>

    <label for="array">Input Number Queries (use comma (,) as separator)</label>
    <input type="text" name="array" id="array" 
           value="<?= htmlspecialchars($_GET['array'] ?? '') ?>"> <br>
    <button>Submit</button>
</form>
</body>
</html>

<?php if (!empty($results)): ?>
    <h2>Results:</h2>
    <ul>
        <?php foreach ($results as $query => $answer): ?>
            <li><?= htmlspecialchars($query) ?> = <strong><?= $answer ?></strong></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>