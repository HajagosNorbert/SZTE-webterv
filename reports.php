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
    <link rel="stylesheet" href="./css/reports.css" />
    <title>Suli hibabejelentő</title>
</head>
<body>
<?php $activePage = "reports"; include 'navbar.php' ?>
<main>
    <table>
        <caption>
            Eddig bejelentett hibák adatai
        </caption>
        <thead>
        <tr>
            <th id="th_name">Név</th>
            <th id="th_type">Jellege</th>
            <th id="th_blocking">Sürgős</th>
            <th id="th_started_at">Kezdődött</th>
            <th id="th_classroom">Terem</th>
            <th id="th_description">Leírás</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td headers="th_name">Minta probléma</td>
            <td headers="th_type">Digitális</td>
            <td headers="th_blocking">Igen</td>
            <td headers="th_started_at">2021-03-18 20:00</td>
            <td headers="th_classroom">217</td>
            <td headers="th_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum,
                soluta expedita distinctio quam quos a illo sapiente odio, sequi
                tempore cumque. In corporis consequatur sed, accusamus velit
                facilis officiis dolore autem ipsam impedit, id harum quas aut
                adipisci expedita architecto atque iste commodi nostrum ipsa modi!
                Officiis, aut dolor odit, quis ex mollitia ea alias illum quia
                ullam iure saepe! Dolor sunt accusamus distinctio, fugit debitis
                consequuntur adipisci corporis corrupti aut impedit neque fuga
                suscipit, quis unde quo placeat modi vel autem pariatur nisi
                dolore maiores omnis libero numquam? Rerum expedita id error dicta
                maiores eveniet necessitatibus, quas deserunt atque!
            </td>
        </tr>
        <tr>
            <td headers="th_name">Minta probléma</td>
            <td headers="th_type">Digitális</td>
            <td headers="th_blocking">Igen</td>
            <td headers="th_started_at">2021-03-18 20:00</td>
            <td headers="th_classroom">217</td>
            <td headers="th_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum,
                soluta expedita distinctio quam quos a illo sapiente odio, sequi
                tempore cumque. In corporis consequatur sed, accusamus velit
                facilis officiis dolore autem ipsam impedit, id harum quas aut
                adipisci expedita architecto atque iste commodi nostrum ipsa modi!
                Officiis, aut dolor odit, quis ex mollitia ea alias illum quia
                ullam iure saepe! Dolor sunt accusamus distinctio, fugit debitis
                consequuntur adipisci corporis corrupti aut impedit neque fuga
                suscipit, quis unde quo placeat modi vel autem pariatur nisi
                dolore maiores omnis libero numquam? Rerum expedita id error dicta
                maiores eveniet necessitatibus, quas deserunt atque!
            </td>
        </tr>
        <tr>
            <td headers="th_name">Minta probléma</td>
            <td headers="th_type">Digitális</td>
            <td headers="th_blocking">Igen</td>
            <td headers="th_started_at">2021-03-18 20:00</td>
            <td headers="th_classroom">217</td>
            <td headers="th_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum,
                soluta expedita distinctio quam quos a illo sapiente odio, sequi
                tempore cumque. In corporis consequatur sed, accusamus velit
                facilis officiis dolore autem ipsam impedit, id harum quas aut
                adipisci expedita architecto atque iste commodi nostrum ipsa modi!
                Officiis, aut dolor odit, quis ex mollitia ea alias illum quia
                ullam iure saepe! Dolor sunt accusamus distinctio, fugit debitis
                consequuntur adipisci corporis corrupti aut impedit neque fuga
                suscipit, quis unde quo placeat modi vel autem pariatur nisi
                dolore maiores omnis libero numquam? Rerum expedita id error dicta
                maiores eveniet necessitatibus, quas deserunt atque!
            </td>
        </tr>
        <tr>
            <td headers="th_name">Minta probléma</td>
            <td headers="th_type">Digitális</td>
            <td headers="th_blocking">Igen</td>
            <td headers="th_started_at">2021-03-18 20:00</td>
            <td headers="th_classroom">217</td>
            <td headers="th_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum,
                soluta expedita distinctio quam quos a illo sapiente odio, sequi
                tempore cumque. In corporis consequatur sed, accusamus velit
                facilis officiis dolore autem ipsam impedit, id harum quas aut
                adipisci expedita architecto atque iste commodi nostrum ipsa modi!
                Officiis, aut dolor odit, quis ex mollitia ea alias illum quia
                ullam iure saepe! Dolor sunt accusamus distinctio, fugit debitis
                consequuntur adipisci corporis corrupti aut impedit neque fuga
                suscipit, quis unde quo placeat modi vel autem pariatur nisi
                dolore maiores omnis libero numquam? Rerum expedita id error dicta
                maiores eveniet necessitatibus, quas deserunt atque!
            </td>
        </tr>
        <tr>
            <td headers="th_name">Minta probléma</td>
            <td headers="th_type">Digitális</td>
            <td headers="th_blocking">Igen</td>
            <td headers="th_started_at">2021-03-18 20:00</td>
            <td headers="th_classroom">217</td>
            <td headers="th_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum,
                soluta expedita distinctio quam quos a illo sapiente odio, sequi
            </td>
        </tr>
        </tbody>
    </table>
</main>
<?php include 'footer.html';?>
</body>
</html>
