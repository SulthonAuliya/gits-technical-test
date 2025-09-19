<?php
if (isset($_GET['string']) && $_GET['string'] !== '') {
    $string = $_GET['string'];

    function isBalanced(string $s): string {
        $pairs = [
            ')' => '(',
            ']' => '[',
            '}' => '{'
        ];
        $stack = [];

        foreach (str_split($s) as $char) {
            if ($char === ' ' || $char === "\t" || $char === "\n") {
                continue;  // melewatkan whitespace
            }

            if (in_array($char, ['(', '{', '['])) {
                // menyimpan open bracket kedalam array stack
                $stack[] = $char;  
            } elseif (in_array($char, [')', '}', ']'])) {
                if (empty($stack) || array_pop($stack) !== $pairs[$char]) {
                    return "NO";
                }
            }
        }

        return empty($stack) ? "YES" : "NO";
    }

    $results = isBalanced($string);
}

?>
<!DOCTYPE html>
<html>
<body>

<h1>Balanced Bracket Test</h1>

<form action="">
    <label for="string">Input Brackets</label>
    <input type="text" name="string" id="string" 
           value="<?= htmlspecialchars($_GET['string'] ?? '') ?>"> <br>

    <button>Submit</button>
</form>
</body>
</html>

<?php if (!empty($results)): ?>
    <h2>Results:</h2>
    <h2><?= $results; ?></h2>
<?php endif; ?>