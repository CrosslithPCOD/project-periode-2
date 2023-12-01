<?php 
include 'header.php';
?>
<head>
    <title>Lamborghini</title>
</head>
        <h1>Welcome to Lamborghini - Where luxury meets performance</h1>
        <p>
        Are you ready to experience automotive excellence like never before?
        <br>
        Step into the world of Lamborghini, where precision engineering, breathtaking design, 
        and unparalleled performance converge to create the ultimate driving experience.
        <br>
        At Lamborghini, we are passionate about these Italian masterpieces on wheels. Our showroom boasts the latest and most iconic Lamborghini models, each representing the pinnacle of automotive artistry. Whether you're an enthusiast, a collector, or someone looking to turn dreams into reality, you've come to the right place.
        </p>
        <br><br><br>
        <button id="theme-toggle" onclick="toggleTheme()">Toggle Theme</button>
<form id="theme-form" style="display: none;" method="post">
    <input type="hidden" name="theme" id="theme-input" value="">
</form>
    <?php include 'footer.php'; ?>