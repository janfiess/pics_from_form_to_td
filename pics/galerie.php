
<?php
/**
 * Galerie-Seite für Forminator-Uploads
 * 
 * - Holt die Einträge aus der Tabelle wp_1291191_frmt_form_entry_meta
 * - Zeigt jedes Bild mit Name und Beschrieb in einem flexiblen Galerie-Layout
 * - Mehrere Bilder zu einem Eintrag = mehrere Kacheln mit denselben Infos
 */

require_once 'db_config.php'; // enthält $pdo für DB-Verbindung

// HTML-Header
header("Content-Type: text/html; charset=utf-8");

try {
  // Hole relevante Felder
  $sql = "
    SELECT entry_id, meta_key, meta_value
    FROM wp_frmt_form_entry_meta
    WHERE meta_key IN ('upload-1', 'name-1', 'textarea-1')
    ORDER BY entry_id ASC
  ";

  $stmt = $pdo->query($sql);
  // $mydata = $stmt->fetchAll();
  // print_r(json_encode($mydata));
  // echo "<br>______<br>";

  // Zwischenspeicher nach entry_id
  $entries = [];

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $entryId = $row['entry_id'];
    $key     = $row['meta_key'];
    $value   = $row['meta_value'];

    if (!isset($entries[$entryId])) {
      $entries[$entryId] = [
        'name' => null,
        'beschrieb' => null,
        'img' => []
      ];
    }

    
    switch ($key) {
      case 'name-1':
        $entries[$entryId]['name'] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        break;
        
      case 'textarea-1':
        $entries[$entryId]['beschrieb'] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        break;
          
      case 'upload-1':
        $uploadData = @unserialize($value);
        if ($uploadData !== false && isset($uploadData['file']['file_url'])) {
          $fileUrls = $uploadData['file']['file_url'];
          if (!is_array($fileUrls)) {
            $fileUrls = [$fileUrls];
          }
          $entries[$entryId]['img'] = $fileUrls;
        }
        break;
    }
  }
// echo "<br>______<br>";      
// print_r($entries);

} catch (PDOException $e) {
  die("<p>Fehler bei der Datenbankabfrage: " . htmlspecialchars($e->getMessage()) . "</p>");
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Galerie</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #373f43;
      margin: 0;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #c3e5ce;
    }
    .gallery {
  margin-top: 50px;
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* Standard: 4 Spalten */
    gap: 20px;
    justify-content: center;
    }

    /* Tablet und kleiner: nur 2 Spalten */
    @media (max-width: 768px) {
    .gallery {
        grid-template-columns: repeat(2, 1fr);
    }
    }

 

    .card {
    background: #485054;
    border-radius: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: transform 0.2s ease;
    }

    @media (max-width: 768px) {
        .card {
        aspect-ratio: 1 / 1;
        }
    }

    .card:hover {
      transform: scale(1.05);
    }
    .card img {
      width: 100%;
      height: 88%;
      object-fit: cover;
    }
    @media (max-width: 768px) {
        .card img {
        height: 68%;
        }
    }
    .card-content {
      padding: 5px;
    }
    .card-content h2 {
      font-size: 1rem;
      margin: 0 0 0 0;
      color: #c3e5ce;
        text-align: center;
    }
    .card-content p {
      margin: 0;
      font-size: 0.9rem;
      color: #c3e5ce;
        text-align: center;
    }
    #formularlink {
      text-align: center;
        color: #c3e5ce; /* ocean blue */
        text-decoration: none;
    }
  </style>
</head>
<body>
  <h1>Upload-Galerie</h1>
  <a id="formularlink" href="https://bday.fiessling.ch/"> <h3> Bilder hochladen </h3></a>
  <div class="gallery">
    <?php foreach ($entries as $entry): ?>
        <?php foreach ($entry['img'] as $imgUrl): ?>
            <div class="card">
              <img src="<?php echo htmlspecialchars($imgUrl, ENT_QUOTES, 'UTF-8'); ?>" alt="Upload Bild">
              <div class="card-content">
                <h2><?php echo "von " . $entry['name']; ?></h2>
                <p><?php echo $entry['beschrieb']; ?></p>
              </div>
            </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
  </div>
</body>
</html>
