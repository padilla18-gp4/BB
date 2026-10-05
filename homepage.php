<?php

session_start();


// ========================================
// CHECK IF USER IS LOGGED IN
// ========================================

if (!isset($_SESSION["studentID"])) {

    header("Location: login.php");
    exit();

}


// ========================================
// GET USER INFORMATION
// ========================================

$studentID = $_SESSION["studentID"];
$fullName = $_SESSION["full_name"];
$email = $_SESSION["email"];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Dashboard - Scheduling System</title>

    <link
        rel="stylesheet"
        href="homepage.css"
    >

</head>


<body>


<div class="dashboard">


    <!-- ================================= -->
    <!-- SIDEBAR -->
    <!-- ================================= -->

    <aside class="sidebar">

        <div class="school-logo">

            <div class="logo-circle">
                NCST
            </div>

            <div>
                <h2>NCST</h2>

                <p>
                    NATIONAL COLLEGE OF<br>
                    SCIENCE & TECHNOLOGY
                </p>
            </div>

        </div>


        <!-- NAVIGATION -->

        <nav class="navigation">

            <a href="homepage.php" class="nav-item active">

                <span>⌂</span>

                Dashboard

            </a>


            <a href="#" class="nav-item">

                <span>▣</span>

                My Appointments

            </a>


            <a href="#" class="nav-item">

                <span>▤</span>

                Schedule Appointment

            </a>


            <a href="#" class="nav-item">

                <span>⚙</span>

                Services

            </a>


            <a href="#" class="nav-item">

                <span>♙</span>

                Profile

            </a>

        </nav>


        <!-- LOGOUT -->

        <div class="logout-section">

            <a href="logout.php" class="logout">

                <span>↪</span>

                Logout

            </a>

        </div>

    </aside>



    <!-- ================================= -->
    <!-- MAIN CONTENT -->
    <!-- ================================= -->

    <main class="main-content">


        <!-- TOP BAR -->

        <header class="topbar">

            <h2>
                Dashboard
            </h2>


            <div class="user-menu">

                <div class="user-icon">
                    👤
                </div>

                <div class="user-information">

                    <strong>
                        <?php echo htmlspecialchars($fullName); ?>
                    </strong>

                    <small>
                        Student ID:
                        <?php echo htmlspecialchars($studentID); ?>
                    </small>

                </div>

                <span class="arrow">
                    ▼
                </span>

            </div>

        </header>



        <!-- ================================= -->
        <!-- WELCOME CARD -->
        <!-- ================================= -->

        <section class="welcome-card">

            <div class="profile-icon">

                👤

            </div>


            <div class="welcome-text">

                <p>
                    Welcome back,
                </p>

                <h2>
                    <?php echo htmlspecialchars($fullName); ?>!
                </h2>

                <small>

                    Student ID:
                    <?php echo htmlspecialchars($studentID); ?>

                    &nbsp; | &nbsp;

                    BS Computer Engineering - 2nd Year

                </small>

            </div>

        </section>



        <!-- ================================= -->
        <!-- STATISTICS -->
        <!-- ================================= -->

        <section class="statistics">


            <!-- TOTAL -->

            <div class="stat-card blue">

                <div class="stat-number">
                    1
                </div>

                <div class="stat-text">

                    <strong>
                        Total Appointments
                    </strong>

                </div>

            </div>



            <!-- CONFIRMED -->

            <div class="stat-card green">

                <div class="stat-number">
                    1
                </div>

                <div class="stat-text">

                    <strong>
                        Confirmed
                    </strong>

                    <span>
                        Appointments
                    </span>

                </div>

            </div>



            <!-- PENDING -->

            <div class="stat-card yellow">

                <div class="stat-number">
                    0
                </div>

                <div class="stat-text">

                    <strong>
                        Pending
                    </strong>

                    <span>
                        Appointments
                    </span>

                </div>

            </div>



            <!-- CANCELLED -->

            <div class="stat-card red">

                <div class="stat-number">
                    0
                </div>

                <div class="stat-text">

                    <strong>
                        Cancelled
                    </strong>

                    <span>
                        Appointments
                    </span>

                </div>

            </div>


        </section>


    </main>

</div>


</body>

</html>