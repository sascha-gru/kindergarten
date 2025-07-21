<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <title>Mitarbeiter-Kalender</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php
        
            date_default_timezone_set('Europe/Berlin');

            // Monat und Jahr aus URL oder aktuell
            $monat = isset($_GET['monat']) ? (int)$_GET['monat'] : date('n');
            $jahr = isset($_GET['jahr']) ? (int)$_GET['jahr'] : date('Y');

            // Vorheriger / nächster Monat berechnen
            $vorherigerMonat = $monat - 1;
            $naechsterMonat = $monat + 1;
            $vorherigesJahr = $jahr;
            $naechstesJahr = $jahr;

            if ($vorherigerMonat < 1) {
            $vorherigerMonat = 12;
            $vorherigesJahr--;
            }
            if ($naechsterMonat > 12) {
            $naechsterMonat = 1;
            $naechstesJahr++;
            }

            // Monatsnamen auf Deutsch (ohne strftime)
            $deutscheMonate = [
            1 => 'Januar', 2 => 'Februar', 3 => 'März',
            4 => 'April', 5 => 'Mai', 6 => 'Juni',
            7 => 'Juli', 8 => 'August', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Dezember'
            ];
            $monatName = $deutscheMonate[$monat];

            // Wochentage auf Deutsch (Start: Montag)
            $wochentage = ['Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So'];

            // Anzahl der Tage im Monat
            $tageImMonat = cal_days_in_month(CAL_GREGORIAN, $monat, $jahr);

            // Erster Wochentag des Monats (1 = Montag, 7 = Sonntag)
            $ersterWochentag = date('N', mktime(0, 0, 0, $monat, 1, $jahr));

            // Aktuelles Datum
            $heute = date('Y-m-d');
        ?>

        <h1>Mitarbeiter-Kalender</h1>

        <div class="kopf">
            <h2 class="month"><?= "$monatName $jahr" ?></h2>
            <a href="?monat=<?= $vorherigerMonat ?>&jahr=<?= $vorherigesJahr ?>" class="back">vorheriger Monat</a>
            <a href="?monat=<?= $naechsterMonat ?>&jahr=<?= $naechstesJahr ?>"class="forward">nächster Monat</a>
        </div>

        <table>
            <tr>
                <?php foreach ($wochentage as $tag): ?>
                <th><?= $tag ?></th>
                <?php endforeach; ?>
            </tr>
            <tr>
                <?php
                // Leere Zellen vor dem 1. Tag (falls nicht Montag)
                $leereZellen = $ersterWochentag - 1;
                for ($i = 0; $i < $leereZellen; $i++) {
                echo "<td></td>";
                }

                // Tage einfügen
                for ($tag = 1; $tag <= $tageImMonat; $tag++) {
                $datum = sprintf('%04d-%02d-%02d', $jahr, $monat, $tag);
                $klasse = ($datum === $heute) ? 'heute' : '';

                    if ($datum === $heute) {
                        echo "<td class='heute'><a href='mitarbeiter_db.php?datum=$datum'>$tag</a></td>";
                    } else {
                        echo "<td>$tag</td>";
                    }


                if ((($tag + $leereZellen) % 7) === 0) {
                    echo "</tr><tr>";
                }
                }

                // Leere Zellen am Monatsende
                while ((($tag + $leereZellen - 1) % 7) !== 0) {
                echo "<td></td>";
                $tag++;
                }
                ?>
            </tr>
        </table>

    </body>
    <a href="mitarbeiter_dashboard.php" class="back2">Zurück zur Übersicht</a>
</html>