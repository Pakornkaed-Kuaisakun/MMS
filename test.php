<?php
include("server/connection/conn.php");
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = sha1(md5($_POST['password']));
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $lasted_login = date("Y-m-d h:i:s", time());

    $insert = "INSERT INTO userdata (email, password, Firstname, Lastname, lasted_login) VALUES ('$email', '$password', '$firstname', '$lastname', '$lasted_login')";
    $result = mysqli_query($conn, $insert);

    header("Login.php");
}

$test = "NaN";
if (isset($_POST['test'])) {
    $test = $_POST['1'] . $_POST['2'] . $_POST['3'] . $_POST['4'] . $_POST['5'] . $_POST['6'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>

<body>
    <!-- <form action="send.php" method="post">
        <label for="">Email</label>
        <input type="email" name="email" required>
        <br>
        <textarea name="message" cols="30" rows="10" placeholder="Message"></textarea>
        <br>
        <button type="submit" name="send">Send</button>
    </form>-->
    <h4>Register</h4>
    <form method="post">
        <input type="text" name="email" placeholder="Email">
        <br>
        <input type="password" name="password" placeholder="password">
        <br>
        <input type="text" name="Firstname" placeholder="Firstname">
        <br>
        <input type="text" name="Lastname" placeholder="Lastname">
        <button type="submit" name="submit">Register</button>
    </form>
    <br><br>
    <h4>test: String + String in multiple input</h4>
    <form method="post">
        <div class="inputfield" id="inputfield">
            <input type="text" inputmode="numeric" maxlength="1" class="OTP-input" name="1" />
            <input type="text" inputmode="numeric" maxlength="1" class="OTP-input" name="2" />
            <input type="text" inputmode="numeric" maxlength="1" class="OTP-input" name="3" />
            <input type="text" inputmode="numeric" maxlength="1" class="OTP-input" name="4" />
            <input type="text" inputmode="numeric" maxlength="1" class="OTP-input" name="5" />
            <input type="text" inputmode="numeric" maxlength="1" class="OTP-input" name="6" />
            <style>
                .inputfield {
                    width: 100%;
                    display: flex;
                    justify-content: space-around;
                }

                .OTP-input {
                    height: 2em;
                    width: 2em;
                    border: 2px solid #dad9df;
                    outline: none;
                    text-align: center;
                    font-size: 1.5em;
                    border-radius: 0.3em;
                    background-color: #ffffff;
                    outline: none;
                    /*Hide number field arrows*/
                    -moz-appearance: textfield;
                }

                input[type="number"]::-webkit-outer-spin-button,
                input[type="number"]::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                    margin: 0;
                }
            </style>
        </div>
        <button type="submit" name="test">test</button>
        <span>
            <?php echo $test ?>
        </span>
    </form>
    <a href="main/dashboard.php">back</a>
    <script>
        // script.js 
        const inputs = document.getElementById("inputfield");

        inputs.addEventListener("input", function (e) {
            const target = e.target;
            const val = target.value;

            if (isNaN(val)) {
                target.value = "";
                return;
            }

            if (val != "") {
                const next = target.nextElementSibling;
                if (next) {
                    next.focus();
                }
            }
        });

        inputs.addEventListener("keyup", function (e) {
            const target = e.target;
            const key = e.key.toLowerCase();

            if (key == "backspace" || key == "delete") {
                target.value = "";
                const prev = target.previousElementSibling;
                if (prev) {
                    prev.focus();
                }
                return;
            }
        });

    </script>
</body>

</html>