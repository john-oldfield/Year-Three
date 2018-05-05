<html>
    <head>
        <title>VisitHampshire</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div id="wrapper">
            <header><h1>Visit Hampshire!</h1></header>
            <?php $accID = $_GET["accID"];?>
            <div id="form-container">
                <form id="loginForm" method="POST" action="handleBooking.php">
                    <p>Booking Form</p>
                        <?php echo "<input type='hidden' name='accID' value='$accID'>"; ?>
                    <input type="text" name="username" placeholder="Username"><br/>
                    <input type="password" name="password"placeholder="Password"><br/>
                    <input type="text" name="nPeople" placeholder="Number of People" required><br/>
                    <input type="date" name="date" required><br/>
                    <input type="submit" value="Book">
                </form>
            </div>
        </div>
    </body>
</html>