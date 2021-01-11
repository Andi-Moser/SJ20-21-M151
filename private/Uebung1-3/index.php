<?php
    session_start();

    $anzahl_aufrufe = 1;
    if (isset($_SESSION['anzahl_aufrufe'])) {
        $anzahl_aufrufe = $_SESSION['anzahl_aufrufe'];
    }

    echo "Die Seite wurde {$anzahl_aufrufe}x aufgerufen.";

    $_SESSION['anzahl_aufrufe'] = ++$anzahl_aufrufe;
?>