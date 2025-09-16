<?php
/**
 * API-Script für Forminator-Uploads
 *
 * Dieses Script liest die Daten aus der Tabelle `wp_1291191_frmt_form_entry_meta`
 * und gibt sie als JSON zurück.
 * Struktur des JSON:
 * [
 *   {
 *     "name": "jan",
 *     "beschrieb": "Headphone",
 *     "img": ["https://.../bild1.jpg", "https://.../bild2.jpg"]
 *   },
 *   ...
 * ]
 */

header('Content-Type: application/json; charset=utf-8');

// DB-Verbindung laden (db_config.php enthält $pdo)
require_once 'db_config.php';

try {
    // Hole alle relevanten Felder aus der Tabelle
    $sql = "
        SELECT entry_id, meta_key, meta_value
        FROM wp_1298607_frmt_form_entry_meta
        WHERE meta_key IN ('upload-1', 'name-1', 'textarea-1')
        ORDER BY entry_id ASC
    ";
    $stmt = $pdo->query($sql);

    // Array für Zwischenspeicherung nach entry_id
    $entries = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $entryId = $row['entry_id'];
        $key = $row['meta_key'];
        $value = $row['meta_value'];

        // Stelle sicher, dass für jede entry_id ein Objekt existiert
        if (!isset($entries[$entryId])) {
            $entries[$entryId] = [
                'name' => null,
                'beschrieb' => null,
                'img' => []
            ];
        }

        // Weiche auf die richtigen Felder um
        switch ($key) {
            case 'name-1':
                $entries[$entryId]['name'] = $value;
                break;

            case 'textarea-1':
                $entries[$entryId]['beschrieb'] = $value;
                break;

            case 'upload-1':
                // Upload-Info ist ein serialisiertes Array → deserialisieren
                $uploadData = @unserialize($value);

                if ($uploadData !== false && isset($uploadData['file']['file_url'])) {
                    $fileUrls = $uploadData['file']['file_url'];

                    // Wenn nur ein Eintrag → Array draus machen
                    if (!is_array($fileUrls)) {
                        $fileUrls = [$fileUrls];
                    }

                    $entries[$entryId]['img'] = $fileUrls;
                }
                break;
        }
    }

    // Index neu aufbauen, damit es ein Array von Objekten wird
    $result = array_values($entries);

    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Datenbankfehler',
        'details' => $e->getMessage()
    ]);
    exit;
}
