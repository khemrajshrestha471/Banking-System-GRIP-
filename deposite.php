<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/deposite_favicon.jpg">
    <title>Deposite - Banking System</title>

    <!-- including bootstrat -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    require "navbar.php";
    require "connection.php";

    // check weather the method is post and name is submit

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $balance = $_POST['balance'];

        // selecting data from the table

        $sql = "SELECT * from intern where username = '$username' AND email = '$email'";

        // executing query

        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        // check if the username and email exists in the databse or not

        if ($num == 1) {
            $sql2 = "SELECT current_balance FROM intern where email = '$email'";
            $result2 = mysqli_query($conn, $sql2);
            $data = mysqli_fetch_assoc($result2);

            // perform required calculation

            $current_balance = $data['current_balance'];
            $current_balance = $current_balance + $balance;

            $amount_added = "UPDATE `intern` SET `current_balance`='$current_balance' WHERE email = '$email'";
            $query_amount = mysqli_query($conn, $amount_added);

    ?>
        <!-- display the necessary result and I have used javascript library for this -->
            <script>
                swal({
                    title: "Success!",
                    text: "Amount deposited successfully...!",
                    icon: "success",
                    button: "OK!",
                });
            </script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="deposite_success.js"></script>

        <?php
        } else {
        ?>
            <script>
                swal("Error...!", "Credentials did not match!");
            </script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="info_notmatch.js"></script>
    <?php
        }
    }
    ?>

    <img class="backgroundtrans" src="images/deposite_background.jpg" alt="Aleq">
    <h3>Welcome Back, Deposite your money here.!!!</h3>
    <div class="container mt-4">
        <form method="post" autocomplete="off">

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" title="Username" placeholder="Firstly, You have to add user from 'add user' section if not yet...!" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" title="Email" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Deposite Amount</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="balance" title="Deposite Amount" required>
            </div>

            <button type="submit" class="btn btn-success" name="submit">Deposite</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>