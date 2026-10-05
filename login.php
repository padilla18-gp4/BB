<?php

session_start();

$error = "";


// ========================================
// MYSQL DATABASE CONNECTION
// ========================================

$host = "localhost";
$dbname = "scheduling_system";
$dbuser = "root";
$dbpass = "";

try {

    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $dbuser,
        $dbpass
    );

    $conn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {

    die("Database connection failed: " . $e->getMessage());

}


// ========================================
// LOGIN
// ========================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $studentID = trim($_POST["username"]);
    $password = $_POST["password"];


    // ========================================
    // FIND USER
    // ========================================

    $sql = "
        SELECT *
        FROM users
        WHERE student_id = :student_id
        LIMIT 1
    ";

    $stmt = $conn->prepare($sql);

    $stmt->execute([
        ":student_id" => $studentID
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    // ========================================
    // CHECK LOGIN
    // ========================================

    if ($user && password_verify($password, $user["password"])) {

        // Login successful

        $_SESSION["studentID"] = $user["student_id"];
        $_SESSION["full_name"] = $user["full_name"];
        $_SESSION["email"] = $user["email"];


        // Go to homepage

        header("Location: homepage.php");
        exit();

    } else {

        // Login failed

        $error = "Invalid Student ID or Password.";

    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <link
        rel="stylesheet"
        href="login.css"
    >

    <title>Login - Scheduling System</title>

</head>


<body>

    <h1>SCHEDULING SYSTEM</h1>


    <form method="POST" action="">

        <div class="name-container">

            <h1>Welcome Back!</h1>

            <h3>Login to your account</h3>


            <!-- ERROR MESSAGE -->

            <?php if ($error != ""): ?>

                <p style="color: red;">

                    <?php echo htmlspecialchars($error); ?>

                </p>

            <?php endif; ?>


            <!-- STUDENT ID -->

            <label for="username">
                Student ID:
            </label>

            <input
                type="text"
                id="username"
                name="username"
                placeholder="Student ID"
                maxlength="10"
                required
            >

            <br>


            <!-- PASSWORD -->

            <label for="password">
                Password:
            </label>

           <label for="password">
             Password:
            </label>

            <div class="password-container">

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="****"
                    required
                >

                <button
                    type="button"
                    id="togglePassword"
                    class="eye-button"
                >
                    👁
                </button>

            </div>
            <br>


            <!-- REMEMBER ME -->

            <input
                type="checkbox"
                id="remember"
                name="remember"
            >

            <label for="remember">
                Remember me
            </label>

            <br><br>


            <!-- LOGIN BUTTON -->

            <input
                type="submit"
                value="Login"
                id="login"
            >

            <br><br>


            <!-- REGISTER -->

            <span>
                Don't have an account?
            </span>

            <a
                href="register.php"
                id="register"
            >
                Register here
            </a>

        </div>

    </form>
<script>

const password = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");

togglePassword.addEventListener("click", function () {

    if (password.type === "password") {

        password.type = "text";
        togglePassword.textContent = "🙈";

    } else {

        password.type = "password";
        togglePassword.textContent = "👁";

    }

});

</script>

</body>

</html>