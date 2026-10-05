<?php

// ========================================
// MYSQL DATABASE CONNECTION
// ========================================

require_once "database.php";


// ========================================
// REGISTRATION
// ========================================

$message = "";
$messageType = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $studentId = trim($_POST["studentId"]);
    $fullName = trim($_POST["fName"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["tel"]);

    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];


    // ========================================
    // CHECK PASSWORD
    // ========================================

    if ($password !== $confirmPassword) {

        $message = "Passwords do not match!";
        $messageType = "error";

    } else {

        // ========================================
        // CHECK IF USER ALREADY EXISTS
        // ========================================

        $check = $conn->prepare("
            SELECT id
            FROM users
            WHERE student_id = ?
            OR email = ?
        ");

        $check->bind_param(
            "ss",
            $studentId,
            $email
        );

        $check->execute();

        $result = $check->get_result();


        if ($result->num_rows > 0) {

            $message = "Student ID or Email already exists!";
            $messageType = "error";

        } else {

            // ========================================
            // HASH PASSWORD
            // ========================================

            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );


            // ========================================
            // SAVE TO MYSQL DATABASE
            // ========================================

            $insert = $conn->prepare("
                INSERT INTO users
                (
                    student_id,
                    full_name,
                    email,
                    phone,
                    password
                )
                VALUES (?, ?, ?, ?, ?)
            ");

            $insert->bind_param(
                "sssss",
                $studentId,
                $fullName,
                $email,
                $phone,
                $hashedPassword
            );


            if ($insert->execute()) {

            header("Location: login.php");
            exit;

          } else {

            $message = "Registration failed!";
            $messageType = "error";

        }

        }

    }

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration</title>

    <link rel="stylesheet" href="register.css">

</head>


<body>

    <form method="POST" action="">

        <div class="name-container">

            <h1>REGISTRATION</h1>


            <!-- MESSAGE -->

            <?php if ($message != ""): ?>

                <p
                    style="
                        text-align:center;
                        color:
                        <?php
                        echo ($messageType == "success")
                            ? "green"
                            : "red";
                        ?>;
                    "
                >

                    <?php echo htmlspecialchars($message); ?>

                </p>

            <?php endif; ?>


            <div class="sub">


                <!-- ================================ -->
                <!-- LEFT SIDE -->
                <!-- ================================ -->

                <div class="left">

                    <label for="studentId">
                        Student ID:
                    </label>

                    <input
                        type="Text"
                        id="studentId"
                        name="studentId"
                        placeholder="2026-12345"
                        maxlength="10"
                        required
                    >

                    <br>


                    <label for="fName">
                        Full Name:
                    </label>

                    <input
                        type="text"
                        id="fName"
                        name="fName"
                        placeholder="Ex. Mark PJ"
                        required
                    >

                    <br>


                    <label for="email">
                        Email Address:
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="NCST@edu.ph"
                        required
                    >

                    <br>

                </div>


                <!-- ================================ -->
                <!-- RIGHT SIDE -->
                <!-- ================================ -->

                <div class="right">

                    <label for="tel">
                        Phone Number:
                    </label>

                    <input
                        type="tel"
                        id="tel"
                        name="tel"
                        placeholder="098765432123"
                        maxlength="11"
                        required
                    >

                    <br>


                    <label for="password">
                        Password:
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="****"
                        required
                    >

                    <br>


                    <label for="confirm_password">
                        Confirm Password:
                    </label>

                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        placeholder="****"
                        required
                    >

                    <br>

                </div>

            </div>


            <!-- ================================ -->
            <!-- SUBMIT BUTTON -->
            <!-- ================================ -->

            <div class="btn">

                <button type="submit">
                    Submit
                </button>

            </div>


        </div>

    </form>

</body>
<script src="register.js"></script>

</html>