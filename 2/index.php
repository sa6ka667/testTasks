<?php
require_once 'Class/Word.php';
$colorsAndWords = array('red', 'blue', 'green', 'yellow', 'lime', 'magenta', 'black', 'gold', 'gray', 'tomato');
?>
<table>
<?php for($i=0; $i<=5; $i++): ?>
    <tr>
    <?php for($j=0; $j<=5; $j++): ?>
        <td><?php echo Word::getWord($colorsAndWords); ?></td>
    <?php endfor; ?>
    </tr>
    <?php endfor; ?>
</table>
