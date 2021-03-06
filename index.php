<?php
session_start();
?>
<!DOCTYPE html>
<html lang="hu">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="mediafiles/debugging.png" type="image/icon" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="./css/genericStyle.css" />
    <link rel="stylesheet" href="./css/navbar.css" />
    <link rel="stylesheet" href="./css/index.css" />
    <title>Suli hibabejelentő</title>
  </head>
  <body>
<?php $activePage = "index"; include 'navbar.php' ?>
    <main>
      <section id="floating">
        <h1>Az alkalmazás ismertetése</h1>
        <p>
          A SZSZC Gábor Dénes Szakgimnáziuma és Szakközépiskolája részére
          készült, amelynek segítségével a tanároknak lehetőségük van a
          rendszergazda felé jelenteni az oktatás során keletkezett
          <strong> szoftveres vagy hardveres hibákat </strong>, és az esetleges
          rongálást is. Csak felhasználói fiókkal lehet belépni amely
          elkészítése az oktatási intézmény rendszergazdájának a feladata. Az
          alkalmazás célja a rendszergazda munkájának megkönnyítése, valamint a
          gyors hibaelhárítás.
        </p>
        <h1>Az iskola ismertetése és interjúk</h1>
        <iframe
          width="350"
          height="250"
          src="https://www.youtube.com/embed/W6Iu4rRI7xI"
        >
        </iframe>
        <audio src="./mediafiles/gd.mp3" controls></audio>
      </section>
    </main>
  <?php include 'footer.html';?>
  </body>
</html>
