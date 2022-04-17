<header>
    <nav>
        <ul class="navbar">
            <li class="home <?= ($activePage === "index")? "active" : "" ?>">
                <a href="index.php"><div>Suli</div></a>
            </li>
            <li class="navbar-toggle"><i class="fa fa-bars"></i></li>
            <?php if(empty($_SESSION["user_id"]) && empty($_COOKIE["login"])): ?>
            <li class="navbar-link first <?= ($activePage === "registration")? "active" : "" ?>">
                <a href="registration.php"><div>Regisztráció</div></a>
            </li>
            <li class="navbar-link last <?= ($activePage === "login")? "active" : "" ?>">
                <a href="login.php"><div>Bejelentkezés</div></a>
            </li>
            <?php else: ?>
                <li class="navbar-link first <?= ($activePage === "reporting")? "active" : "" ?>">
                    <a href="reporting.php"><div>Hibabejelentés</div></a>
                </li>
                <li class="navbar-link <?= ($activePage === "reports")? "active" : "" ?>" >
                    <a href="reports.php"><div>Hibák</div></a>
                </li>
                <li class="navbar-link last">
                <a href="profile.php"><div>Profile</div></a>
            </li>
            <li class="navbar-link last">
                <a href="logout.php"><div>Kijelentkezés</div></a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
