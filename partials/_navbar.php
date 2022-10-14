<?php
session_start();
if (isset($_SESSION['admin'])) {
    $admin = true;
} else {
    $admin = false;
}
?>
<div class="nav">
    <div class="items">
        <div class="logo">Logo</div>
        <div class="secondary-items">
            <div class="links">
                <a href="" class="home">Home</a>
                <a href="" class="about">About Us</a>
                <a href="" class="contact">Contact Us</a>
                <div class="dropdown">
                    <button class="services">Services</button>
                    <div class="dropdown-items">
                        <a href="">Trasnportation</a>
                        <a href="">Real Estate & Construction</a>
                        <a href="">Events Management</a>
                        <a href="">Custom Appraisment</a>
                        <a href="">Sports Management</a>
                        <a href="">Sawab Foundation</a>
                    </div>
                </div>
                <?php
                if ($admin) {
                    echo '<a href="logout.php" class="logout">Logout</a>';
                }
                ?>
            </div>
            <div class="title">
                <div class="main">IMRAN KHAN ENTERPRISES</div>
                <div class="slogan">COMMITMENT TO TRANSPARENCY</div>
            </div>
        </div>
    </div>
</div>