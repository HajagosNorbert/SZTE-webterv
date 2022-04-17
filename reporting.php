<?php
if(empty($_SESSION["user_id"]) && empty($_COOKIE["login"])){
    header("location: login.php");
}
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
    <link rel="stylesheet" href="./css/reporting.css" />
    <title>Hibabejelentő - regisztráció</title>
  </head>
  <body>
<?php $activePage = "reporting"; include 'navbar.php' ?>
    <main>
      <div class="login">
        <form action="reporting.php" method="post">
          <div class="row">
            <input
              class="generic-input"
              type="text"
              name="name"
              placeholder="Probléma megnevezése"
              required
            />
          </div>
          <div class="row ta-left">
            <fieldset>
              <legend>Hiba jellege:</legend>

              <div>
                <input
                  type="radio"
                  name="problem_type"
                  value="technical"
                  id="technical"
                  required
                />
                <label for="technical">Műszaki berendezés </label>
              </div>
              <div>
                <input
                  type="radio"
                  name="problem_type"
                  value="non_technical"
                  id="non_technical"
                  required
                />
                <label for="non_technical">Nem műszaki berendezés</label>
              </div>

              <div>
                <input
                  type="radio"
                  name="problem_type"
                  value="digital"
                  id="digital"
                  required
                />
                <label for="digital">Digitális rendszer</label>
              </div>

              <div>
                <input
                  type="radio"
                  name="problem_type"
                  id="other"
                  value="other"
                  required
                />
                <label for="other">Egyéb</label>
              </div>
            </fieldset>
          </div>
          <div class="row ta-left">
            <input
              type="checkbox"
              id="blocking"
              name="blocking"
              value="blocking"
              required
            />
            <label for="blocking">Megakadályoz a munkában </label>
          </div>
          <div class="row ta-left">
            <label for="started_at">Kezdődött:</label>
            <input
              class="generic-input"
              type="datetime-local"
              id="started_at"
              name="started_at"
              required
            />
          </div>
          <div class="row">
            <input
              class="generic-input"
              type="number"
              name="classroom"
              placeholder="Terem száma"
            />
          </div>
          <div class="row">
            <textarea
              class="generic-input"
              placeholder="Probléma leírása"
              name="description"
              rows="5"
              cols="60"
              required
            ></textarea>
          </div>

          <div class="row button">
            <input
              type="submit"
              class="generic-input"
              name="reporting"
              value="Küldés"
            />
          </div>
          <div class="row button">
            <input
              id="reset"
              type="reset"
              class="generic-input"
              name="reset"
              value="Visszaállít"
            />
          </div>
        </form>
      </div>
    </main>
  <?php include 'footer.html';?>
  </body>
</html>
