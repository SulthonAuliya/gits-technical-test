<?php
    function highestPalindrome(string $s, int $k): string {
        $chars = str_split($s);
        $n = strlen($s);
        $changed = array_fill(0, $n, false);

        // melakukan pengulangan dengan mengecek ujung kiri dan kanan dari string
        // selanjutnya mengecek inward 1 dari kiri dan 1 dari kanan
        for ($left = 0, $right = $n - 1; $left < $right; $left++, $right--) {
            if ($chars[$left] !== $chars[$right]) {
                if ($k <= 0) return "-1";
                $maxDigit = max($chars[$left], $chars[$right]);
                $chars[$left] = $chars[$right] = $maxDigit;
                $changed[$left] = $changed[$right] = true;
                $k--;
            }
        }

        // jika ada sisa k maka lakukan penaikan nilai palindrome
        for ($left = 0, $right = $n - 1; $left <= $right && $k > 0; $left++, $right--) {
            // mengecek jika jumlah string ganjil maka mengubah nilai tengah menjadi 9 jika k masih tersisa
            // karena ketika jumlah string ganjil maka di nilai array key tengah dia akan menjadi sama 
            if ($left == $right) {
                if ($k > 0) {
                    $chars[$left] = '9';
                    $k--;
                }
            } else {
                if ($chars[$left] !== '9') {
                    if (($changed[$left] || $changed[$right]) && $k > 0) {
                        $chars[$left] = $chars[$right] = '9';
                        // karena sudah melakukan perubahan disalah satu kiri dan kanan dan kesempatan k masih ada
                        // maka perubahan sebelumnya dan perubahan sisa digunakan untuk mengubah kiri dan kakan menjadi 9
                        $k--;
                    } elseif ($k > 1) {
                        $chars[$left] = $chars[$right] = '9';
                        // karena belum ada perubahan dan k masih lebih dari 1 maka mengubah keduanya dengan
                        // menggunakan dua slot dari k
                        $k -= 2;
                    }
                }
            }
        }

        return implode("", $chars);
    }
    $results = null;
    if (isset($_GET['string'], $_GET['k'])) {
        $results = highestPalindrome($_GET['string'], (int)$_GET['k']);
    }
?>


<!DOCTYPE html>
<html>
<body>

<h1>Highest Palindrome Test</h1>

<form action="">
    <label for="string">Input Number</label>
    <input type="text" name="string" id="string" 
           value="<?= htmlspecialchars($_GET['string'] ?? '') ?>"><br>

    <label for="k">Allowed Changes</label>
    <input type="number" name="k" id="k" 
           value="<?= htmlspecialchars($_GET['k'] ?? 0) ?>"><br>

    <button>Submit</button>
</form>

<?php if ($results !== null): ?>
    <h2>Result: <?= $results; ?></h2>
<?php endif; ?>

</body>
</html>
