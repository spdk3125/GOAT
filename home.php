<?php
session_start();
if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    session_write_close();
} else {
    session_unset();
    session_write_close();
    $url = "./index.php";
    header("Location: $url");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500&display=swap");

        :root {
            --primary: #eeeeee;
            --secondary: #227c70;
            --green: #82cd47;
            --secondary-light: rgb(34, 124, 112, 0.2);
            --secondary-light-2: rgb(127, 183, 126, 0.1);
            --white: #fff;
            --black: #393e46;
            --shadow: 0px 2px 8px 0px var(--secondary-light);
        }

        * {
            margin: 0;
            padding: 0;
            list-style-type: none;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            height: 100vh;
            width: 100%;
            background-color: var(--primary);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 70px;
            background-color: var(--white);
            padding: 0 8%;
            box-shadow: var(--shadow);
            z-index: 1000;
        }

        .navbar-logo {
            cursor: pointer;
            border-radius: 50%;
            width: 8%;
            height: 80%;
        }

        .navbar-list {
            width: 100%;
            text-align: right;
            padding-right: 2rem;
        }

        .navbar-list li {
            display: inline-block;
            margin: 0 1rem;
        }

        .navbar-list li a {
            font-size: 1rem;
            font-weight: 500;
            color: var(--black);
            text-decoration: none;
        }

        /* Profile dropdown */
        .profile-dropdown {
            position: relative;
            width: fit-content;
        }

        .profile-dropdown-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-right: 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            width: 150px;
            border-radius: 50px;
            color: var(--black);
            cursor: pointer;
            border: 1px solid var(--secondary);
            transition: box-shadow 0.2s ease-in, background-color 0.2s ease-in, border 0.3s;
        }

        .profile-dropdown-btn:hover {
            background-color: var(--secondary-light-2);
            box-shadow: var(--shadow);
        }

        .profile-img {
            position: relative;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background-color: var(--secondary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.5rem;
            font-weight: bold;
            background-color: var(--secondary);
        }

        .profile-dropdown-list {
            position: absolute;
            top: 68px;
            width: 220px;
            right: 0;
            background-color: var(--white);
            border-radius: 10px;
            max-height: 0;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: max-height 0.5s;
        }

        .profile-dropdown-list.active {
            max-height: 500px;
        }

        .profile-dropdown-list-item {
            padding: 0.5rem 0rem 0.5rem 1rem;
            transition: background-color 0.2s ease-in, padding-left 0.2s;
        }

        .profile-dropdown-list-item a {
            display: flex;
            align-items: center;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--black);
        }

        .profile-dropdown-list-item a i {
            margin-right: 0.8rem;
            font-size: 1.1rem;
            width: 2.3rem;
            height: 2.3rem;
            background-color: var(--secondary);
            color: var(--white);
            line-height: 2.3rem;
            text-align: center;
            border-radius: 50%;
            transition: margin-right 0.3s;
        }

        .profile-dropdown-list-item:hover {
            padding-left: 1.5rem;
            background-color: var(--secondary-light);
        }

        /* Responsive behavior */
        @media only screen and (max-width: 600px) {
            .navbar-list {
                display: none;
            }

            .profile-dropdown {
                display: block;
            }
        }

        /* Centered Welcome Text */
        .welcome-text {
            font-size: 2.2rem;
            color: var(--black);
            text-align: center;
            animation: fadeIn 3s ease-in-out forwards;
            margin-top: 80px;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

    </style>
    <title>Profile Dropdown</title>
</head>
<body>
    <nav class="navbar">
        <img src="logo.jpg" class="navbar-logo" alt="logo" />
        <ul class="navbar-list">
            <li><a href="#">Home</a></li>
            <li><a href="#">Playlists</a></li>
            <li><a href="#">Community</a></li>
            <li><a href="#">About</a></li>
            <li><a href="logout.php">Logout</a> </li>
        </ul>

        <div class="profile-dropdown">
            <div onclick="toggle()" class="profile-dropdown-btn">
                <div class="profile-img" id="profileImage">
                    <!-- JavaScript will dynamically add the first letter here -->
                </div>
                <span><?php echo $username; ?> <i class="fa-solid fa-angle-down"></i></span>
            </div>

            <ul class="profile-dropdown-list">
                <li class="profile-dropdown-list-item">
                    <a href="#">
                        <i class="fa-regular fa-user"></i>
                        Edit Profile
                    </a>
                </li>
                <li class="profile-dropdown-list-item">
                    <a href="#">
                        <i class="fa-regular fa-envelope"></i>
                        Inbox
                    </a>
                </li>
                <li class="profile-dropdown-list-item">
                    <a href="#">
                        <i class="fa-solid fa-chart-line"></i>
                        Analytics
                    </a>
                </li>
                <li class="profile-dropdown-list-item">
                    <a href="#">
                        <i class="fa-solid fa-sliders"></i>
                        Settings
                    </a>
                </li>
                <hr />
                <li class="profile-dropdown-list-item">
                    <a href="logout.php">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Log out
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Centered Welcome Text -->
    <div class="welcome-text">Welcome, <?php echo $username; ?>!</div>

    <script>
        function toggle() {
            document.querySelector('.profile-dropdown-list').classList.toggle('active');
        }

        // Function to set the first letter of the username as the profile image
        document.addEventListener("DOMContentLoaded", function() {
            const username = "<?php echo $username; ?>";
            const profileImage = document.getElementById("profileImage");
            const initial = username.charAt(0).toUpperCase(); // Get the first letter of the username
            profileImage.textContent = initial;
        });
    </script>
</body>
</html>
