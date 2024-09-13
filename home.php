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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
      /* General Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 20px;
    background-color: #333;
    color: white;
    position: relative;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.navbar-logo {
    width: 120px;
    transition: transform 0.5s ease-in-out;
}

.navbar-logo:hover {
    transform: scale(1.1);
}

.navbar-list {
    display: flex;
    list-style: none;
}

.navbar-list li {
    margin-left: 30px;
    position: relative;
}

.navbar-list li a {
    text-decoration: none;
    color: white;
    font-size: 16px;
    transition: color 0.3s ease;
}

.navbar-list li a:hover {
    color: #f0a500;
    transition: 0.3s ease;
}

.profile-dropdown {
    position: relative;
}

.profile-dropdown-btn {
    display: flex;
    align-items: center;
    cursor: pointer;
    color: white;
    padding: 10px;
    border-radius: 50px;
    transition: background-color 0.3s ease;
}

.profile-dropdown-btn:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.profile-img {
    width: 40px;
    height: 40px;
    background-color: #555;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    margin-right: 10px;
    transition: transform 0.3s ease;
}

.profile-img:hover {
    transform: rotate(360deg);
}

.profile-dropdown-list {
    display: none;
    position: absolute;
    top: 60px;
    right: 0;
    background-color: white;
    color: black;
    border-radius: 5px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    list-style: none;
    width: 200px;
    padding: 10px 0;
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(-10px);
}

.profile-dropdown-list.active {
    display: block;
    opacity: 1;
    transform: translateY(0);
}

.profile-dropdown-list-item {
    padding: 10px 20px;
    border-bottom: 1px solid #ddd;
    transition: background-color 0.3s ease;
}

.profile-dropdown-list-item:hover {
    background-color: #f0f0f0;
}

.profile-dropdown-list-item a {
    text-decoration: none;
    color: black;
    display: flex;
    align-items: center;
}

.profile-dropdown-list-item a i {
    margin-right: 10px;
}

/* Mobile Styles */
@media screen and (max-width: 768px) {
    .navbar-list {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 60px;
        right: 0;
        background-color: #333;
        width: 100%;
    }

    .navbar-list li {
        margin: 10px 0;
        text-align: center;
    }

    .navbar-list.active {
        display: flex;
    }

    .mobile-toggle {
        cursor: pointer;
        font-size: 24px;
        color: white;
    }
}


/* Category List */
.category-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
    margin: 1rem;
}

.category-button {
    padding: 10px 15px;
    background-color: #ddd;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

.category-button.active {
    background-color: #333;
    color: white;
}

/* Video List */
.video-list {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 columns for larger screens */
    gap: 15px;
    padding: 1rem;
}

.video-card {
    display: block;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    text-decoration: none;
    color: black;
}

.thumbnail-container {
    position: relative;
}

.thumbnail {
    width: 100%;
    height: auto;
}

.duration {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 12px;
}

.video-info {
    display: flex;
    padding: 1rem;
}

.icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 10px;
}

.video-details h2 {
    font-size: 1.2rem;
    margin: 0;
}

.video-details p {
    font-size: 0.9rem;
    color: #555;
}

/* Media Queries for Responsiveness */

/* For tablets and smaller devices */
@media screen and (max-width: 1024px) {
    .video-list {
        grid-template-columns: repeat(2, 1fr); /* 2 columns for medium screens */
    }

    .category-list {
        justify-content: flex-start;
        overflow-x: scroll;
        padding: 10px;
    }

    .category-button {
        flex: 0 0 auto;
    }
}

/* For mobile devices */
@media screen and (max-width: 600px) {
    nav {
        flex-direction: column;
        align-items: flex-start;
    }

    .video-list {
        grid-template-columns: 1fr; /* 1 column for mobile */
    }

    .category-list {
        display: flex;
        justify-content: flex-start;
        overflow-x: auto;
        padding: 10px;
    }

    .category-button {
        padding: 8px 12px;
        font-size: 14px;
        white-space: nowrap;
    }

    .video-info {
        flex-direction: column;
    }

    .icon {
        width: 40px;
        height: 40px;
        margin-bottom: 10px;
    }

    .video-details h2 {
        font-size: 1rem;
    }
}


    </style>
      <nav class="navbar">
        <img src="logo.jpeg" class="navbar-logo" alt="logo" />
        <ul class="navbar-list">
            <li>Greatest Of All Technology</li>
        </ul>

        <div class="profile-dropdown">
            <div onclick="toggleDropdown()" class="profile-dropdown-btn">
                <div class="profile-img" id="profileImage">
                    <!-- JavaScript will dynamically add the first letter here -->
                </div>
                <span><?php echo $username; ?> <i class="fas fa-angle-down"></i></span>
            </div>

            <ul class="profile-dropdown-list">
                <hr />
                <li class="profile-dropdown-list-item">
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i>
                        Log out
                    </a>
                </li>
            </ul>
        </div>

    </nav>


    <div class="content-wrapper">
        <!-- Category List -->
        <div class="category-list">
          <button class="category-button active">All</button>
          <button class="category-button">Website</button>
          <button class="category-button">Music</button>
          <button class="category-button">Gaming</button>
          <button class="category-button">Node.js</button>
          <button class="category-button">JavaScript</button>
          <button class="category-button">React.js</button>
          <button class="category-button">TypeScript</button>
          <button class="category-button">Coding</button>
          <button class="category-button">Next.js</button>
          <button class="category-button">Data analysis</button>
          <button class="category-button">Web design</button>
          <button class="category-button">HTML</button>
          <button class="category-button">Tailwind</button>
          <button class="category-button">CSS</button>
          <button class="category-button">Express.js</button>
        </div>
        
        <!-- Video List -->
        <div class="video-list">
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="logo2.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">10:03</p>
            </div>
            <div class="video-info">
              <img src="logo2.jpeg" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Greatest Of All Technology</h2>
                <p class="channel-name">G.O.A.T</p>
                <p class="views">27K Views • 4 months ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="logo2.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">23:45</p>
            </div>
            <div class="video-info">
              <img src="logo2.jpeg" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Greatest Of All Technology</h2>
                <p class="channel-name">G.O.A.T</p>
                <p class="views">42K Views • 1 year ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="logo2.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">29:43</p>
            </div>
            <div class="video-info">
              <img src="logo2.jpeg" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Greatest Of All Technology</h2>
                <p class="channel-name">G.O.A.T</p>
                <p class="views">68K Views • 9 months ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="logo2.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">30:43</p>
            </div>
            <div class="video-info">
              <img src="logo2.jpeg" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Greatest Of All Technology</h2>
                <p class="channel-name">G.O.A.T</p>
                <p class="views">68K Views • 9 months ago</p>
              </div>
            </div>
          </a>

          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="logo2.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">35:83</p>
            </div>
            <div class="video-info">
              <img src="logo2.jpeg" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Greatest Of All Technology</h2>
                <p class="channel-name">G.O.A.T</p>
                <p class="views">68K Views • 9 months ago</p>
              </div>
            </div>
          </a>

          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="logo2.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">7:43</p>
            </div>
            <div class="video-info">
              <img src="logo2.jpeg" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Greatest Of All Technology</h2>
                <p class="channel-name">G.O.A.T</p>
                <p class="views">68K Views • 9 months ago</p>
              </div>
            </div>
          </a>


          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="logo2.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">8:43</p>
            </div>
            <div class="video-info">
              <img src="logo2.jpeg" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Greatest Of All Technology</h2>
                <p class="channel-name">G.O.A.T</p>
                <p class="views">68K Views • 9 months ago</p>
              </div>
            </div>
          </a>


          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="logo2.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">16:43</p>
            </div>
            <div class="video-info">
              <img src="logo2.jpeg" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Greatest Of All Technology</h2>
                <p class="channel-name">G.O.A.T</p>
                <p class="views">68K Views • 9 months ago</p>
              </div>
            </div>
          </a>


          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="logo2.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">13:43</p>
            </div>
            <div class="video-info">
              <img src="logo2.jpeg" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Greatest Of All Technology</h2>
                <p class="channel-name">G.O.A.T</p>
                <p class="views">68K Views • 9 months ago</p>
              </div>
            </div>
          </a>

          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="logo2.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">29:43</p>
            </div>
            <div class="video-info">
              <img src="logo2.jpeg" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Greatest Of All Technology</h2>
                <p class="channel-name">G.O.A.T</p>
                <p class="views">68K Views • 9 months ago</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </main>
  </div>

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


<script>
   function toggleDropdown() {
    document.querySelector('.profile-dropdown-list').classList.toggle('active');
}

</script>
</body>
</html>
