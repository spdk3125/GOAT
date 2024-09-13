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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Greatest Of All Technology</title>
  <!-- Linking Unicons For Icons -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  <style>
    /* Importing Google Font - Open Sans */
@import url("https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Open Sans", sans-serif;
}

/* Color variables for light theme */
:root {
  --white-color: #fff;
  --black-color: #000;
  --light-white-color: #f0f0f0;
  --light-gray-color: #e5e5e5;
  --border-color: #ccc;
  --primary-color: #3b82f6;
  --secondary-color: #404040;
  --overlay-dark-color: rgba(0, 0, 0, 0.6);
}

/* Color variables for dark theme */
.dark-mode {
  --white-color: #171717;
  --black-color: #d4d4d4;
  --light-white-color: #333;
  --light-gray-color: #404040;
  --border-color: #808080;
  --secondary-color: #d4d4d4;
}

body {
  background: var(--white-color);
}

.container {
  display: flex;
  overflow: hidden;
  max-height: 100vh;
  flex-direction: column;
}

header, .sidebar .nav-left, .category-list {
  position: sticky;
  top: 0;
  z-index: 10;
  background: var(--white-color);
}

.navbar {
  display: flex;
  gap: 2rem;
  align-items: center;
  padding: 0.5rem 1rem;
  justify-content: space-between;
}

:where(.navbar, .sidebar) .nav-section {
  gap: 1rem;
}

:where(.navbar, .sidebar) :where(.nav-section, .nav-logo, .search-form) {
  display: flex;
  align-items: center;
}

:where(.navbar, .sidebar) :where(.logo-image, .user-image) {
  width: 32px;
  cursor: pointer;
  border-radius: 50%;
}

:where(.navbar, .sidebar) .nav-section .nav-button {
  border: none;
  height: 40px;
  width: 40px;
  cursor: pointer;
  background: none;
  border-radius: 50%;
}

:where(.navbar, .sidebar) .nav-section .nav-button:hover {
  background: var(--light-gray-color) !important;
}

:where(.navbar, .sidebar) .nav-button i {
  font-size: 1.5rem;
  display: flex;
  color: var(--black-color);
  align-items: center;
  justify-content: center;
}

:where(.navbar, .sidebar) .nav-logo {
  display: flex;
  gap: 0.5rem;
  text-decoration: none;
}

:where(.navbar, .sidebar) .nav-logo .logo-text {
  color: var(--black-color);
  font-size: 1.25rem;
}

.navbar .nav-center {
  gap: 0.5rem;
  width: 100%;
  display: flex;
  justify-content: center;
}

.navbar .search-form {
  flex: 1;
  height: 40px;
  max-width: 550px;
}

.navbar .search-form .search-input {
  width: 100%;
  height: 100%;
  font-size: 1rem;
  padding: 0 1rem;
  outline: none;
  color: var(--black-color);
  background: var(--white-color);
  border-radius: 3.1rem 0 0 3.1rem;
  border: 1px solid var(--border-color);
}

.navbar .search-form .search-input:focus {
  border-color: var(--primary-color);
}

.navbar .search-form .search-button {
  height: 40px;
  width: auto;
  padding: 0 1.25rem;
  border-radius: 0 3.1rem 3.1rem 0;
  border: 1px solid var(--border-color);
  border-left: 0;
}

.navbar .nav-center .mic-button {
  background: var(--light-white-color);
}

.navbar .nav-right .search-button {
  display: none;
}

.main-layout {
  display: flex;
  overflow-y: auto;
  scrollbar-color: #a6a6a6 transparent;
}

.main-layout .sidebar {
  width: 280px;
  overflow: hidden;
  padding: 0 0.7rem 0;
  background: var(--white-color);
}

.main-layout .sidebar .nav-left {
  display: none;
  padding: 0.5rem 0.3rem;
}

body.sidebar-hidden .main-layout .sidebar {
  width: 0;
  padding: 0;
}

.sidebar .links-container {
  padding: 1rem 0 2rem;
  overflow-y: auto;
  height: calc(100vh - 60px);
  scrollbar-width: thin;
  scrollbar-color: transparent transparent;
}

.sidebar .links-container:hover {
  scrollbar-color: #a6a6a6 transparent;
}

.sidebar .link-section .link-item {
  display: flex;
  color: var(--black-color);
  white-space: nowrap;
  align-items: center;
  font-size: 0.938rem;
  padding: 0.37rem 0.75rem;
  margin-bottom: 0.25rem;
  border-radius: 0.5rem;
  text-decoration: none;
}

.sidebar .link-section .link-item:hover {
  background: var(--light-gray-color);
}

.sidebar .link-section .link-item i {
  font-size: 1.4rem;
  margin-right: 0.625rem;
}

.sidebar .link-section .section-title {
  color: var(--black-color);
  font-weight: 600;
  font-size: 0.938rem;
  margin: 1rem 0 0.5rem 0.5rem;
}

.sidebar .section-separator {
  height: 1px;
  margin: 0.64rem 0;
  background: var(--light-gray-color);
}

.main-layout .content-wrapper {
  padding: 0 1rem;
  overflow-x: hidden;
  width: 100%;
}

.content-wrapper .category-list {
  display: flex;
  overflow-x: auto;
  gap: 0.75rem;
  padding: 0.75rem 0 0.7rem;
  scrollbar-width: none;
}

.category-list .category-button {
  border: none;
  cursor: pointer;
  font-weight: 500;
  font-size: 0.94rem;
  border-radius: 0.5rem;
  white-space: nowrap;
  color: var(--black-color);
  padding: 0.4rem 0.75rem;
  background: var(--light-gray-color);
}

.category-list .category-button.active {
  color: var(--white-color);
  background: var(--black-color);
  pointer-events: none;
}

.dark-mode .category-list .category-button.active {
  filter: brightness(120%);
}

.category-list .category-button:not(.active):hover {
  background: var(--border-color);
}

.content-wrapper .video-list {
  display: grid; 
  gap: 1rem;
  padding: 1.25rem 0 4rem;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
}

.video-list .video-card {
  text-decoration: none;
}

.video-list .video-card .thumbnail-container {
  position: relative;
}

.video-list .video-card .thumbnail {
  width: 100%;
  object-fit: contain;
  border-radius: 0.5rem;
  aspect-ratio: 16 / 9;
  background: var(--light-white-color);
}

.video-list .video-card .duration {
  position: absolute;
  right: 0.65rem;
  bottom: 0.8rem;
  color: #fff;
  font-size: 0.875rem;
  padding: 0 0.3rem;
  border-radius: 0.3rem;
  background: var(--overlay-dark-color);
}

.video-list .video-card .video-info {
  display: flex;
  gap: 0.7rem;
  padding: 0.7rem 0.5rem;
}

.video-list .video-card .icon {
  width: 36px;
  height: 36px;
  border-radius: 50%;
}

.video-list .video-card .title {
  font-size: 1rem;
  color: var(--black-color);
  font-weight: 600;
  line-height: 1.375;
  overflow: hidden;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
}

.video-list .video-card:hover .title {
  color: var(--primary-color);
}

.video-list .video-card p {
  font-size: 0.875rem;
  color: var(--secondary-color);
}

.video-list .video-card .channel-name {
  margin: 0.25rem 0 0.15rem;
}

/* Responsive media code for small devices */
@media (max-width: 768px) {
  .navbar .nav-center {
    display: none;
  }

  .navbar .nav-right .search-button {
    display: block;
  }

  .main-layout .screen-overlay {
    position: absolute;
    left: 0;
    top: 0;
    z-index: 15;
    width: 100%;
    height: 100vh;
    background: var(--overlay-dark-color);
    transition: 0.2s ease;
  }

  body.sidebar-hidden .main-layout .screen-overlay {
    opacity: 0;
    pointer-events: none;
  }

  .main-layout .sidebar {
    position: absolute;
    left: 0;
    top: 0;
    z-index: 20;
    height: 100vh;
    transition: 0.2s ease;
  }

  body.sidebar-hidden .main-layout .sidebar {
    left: -280px;
  }

  .main-layout .sidebar .nav-left {
    display: flex;
  }
}
  </style>
</head>
<body class="sidebar-hidden">
  <div class="container">
    <!-- Header / Navbar -->
    <header>
      <nav class="navbar">
        <div class="nav-section nav-left">
          <button class="nav-button menu-button">
            <i class="uil uil-bars"></i>
          </button>
          <a href="#" class="nav-logo">
            <img src="logo.jpg" alt="Logo" class="logo-image">
            <h2 class="logo-text">G.O.A.T</h2>
          </a>
        </div>
        
        <div class="nav-section nav-center">
          <form action="#" class="search-form">
            <input type="search" placeholder="Search" class="search-input" required>
            <button class="nav-button search-button">
              <i class="uil uil-search"></i>
            </button>
          </form>
          <button class="nav-button mic-button">
            <i class="uil uil-microphone"></i>
          </button>
        </div>
        
        <div class="nav-section nav-right">
          <button class="nav-button search-button">
            <i class="uil uil-search"></i>
          </button>
          <button class="nav-button theme-button">
            <i class="uil uil-moon"></i>
          </button>
          <img src="" alt="User Image" class="user-image" id="userImage" width="150" height="150">
        </div>
      </nav>
    </header>
    
    <!-- Main Layout -->
    <main class="main-layout">
      <div class="screen-overlay"></div>

      <!-- Sidebar -->
      <aside class="sidebar">
        <div class="nav-section nav-left">
          <button class="nav-button menu-button">
            <i class="uil uil-bars"></i>
          </button>
          <a href="#" class="nav-logo">
            <img src="images/logo.png" alt="Logo" class="logo-image">
            <h2 class="logo-text">CnTube</h2>
          </a>
        </div>
  
        <div class="links-container">
          <div class="link-section">
            <a href="#" class="link-item">
              <i class="uil uil-estate"></i> Home
            </a>
            <a href="#" class="link-item">
              <i class="uil uil-video"></i> Shorts
            </a>
            <a href="#" class="link-item">
              <i class="uil uil-tv-retro"></i> Subscriptions
            </a>
          </div>
          <div class="section-separator"></div>
  
          <div class="link-section">
            <h4 class="section-title">You</h4>
            <a href="#" class="link-item">
              <i class="uil uil-user-square"></i> Your channel
            </a>
            <a href="#" class="link-item">
              <i class="uil uil-history"></i> History
            </a>
            <a href="#" class="link-item">
              <i class="uil uil-clock"></i> Watch later
            </a>
          </div>
          <div class="section-separator"></div>
          
          <div class="link-section">
            <h4 class="section-title">Explore</h4>
            <a href="#" class="link-item">
              <i class="uil uil-fire"></i> Trending
            </a>
            <a href="#" class="link-item">
              <i class="uil uil-music"></i> Music
            </a>
            <a href="#" class="link-item">
              <i class="uil uil-basketball"></i> Gaming
            </a>
            <a href="#" class="link-item">
              <i class="uil uil-trophy"></i> Sports
            </a>
          </div>
          <div class="section-separator"></div>
  
          <div class="link-section">
            <h4 class="section-title">More from YouTube</h4>
            <a href="#" class="link-item">
              <i class="uil uil-shield-plus"></i> YouTube Plus
            </a>
            <a href="#" class="link-item">
              <i class="uil uil-headphones-alt"></i> YouTube Music
            </a>
            <a href="#" class="link-item">
              <i class="uil uil-airplay"></i> YouTube Kids
            </a>
          </div>
          <div class="section-separator"></div>
  
          <div class="link-section">
            <a href="#" class="link-item">
              <i class="uil uil-setting"></i> Settings
            </a>
            <a href="#" class="link-item">
              <i class="uil uil-file-medical-alt"></i> Report
            </a>
            <a href="#" class="link-item">
              <i class="uil uil-question-circle"></i> Help
            </a>
            <a href="#" class="link-item">
              <i class="uil uil-exclamation-triangle"></i> Feedback
            </a>
          </div>
        </div>
      </aside>
  
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
              <img src="https://i.ytimg.com/vi/OORUHkgg4IM/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">10:03</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/DRtVBjk2Noax94hHqr8yCcEjhNUhHRvyzBE3qS9WWilnE1-uQQNVnQd8mdG9h_IvNZCRApZSQw=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Top 10 Easy To Create JavaScript Games For Beginners</h2>
                <p class="channel-name">CodingNepal</p>
                <p class="views">27K Views • 4 months ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="https://i.ytimg.com/vi/qOO6lVMhmGc/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">23:45</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/uITV5E7auiZMDD_BwhVRJMHXXY6qQc0GqBgVyP5LWYTmeRlUP2Dc945UlIbODvztd96ReOts=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">How to make Responsive Card Slider in HTML CSS & JavaScript</h2>
                <p class="channel-name">CodingLab</p>
                <p class="views">42K Views • 1 year ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="https://i.ytimg.com/vi/YEloDYy3DTg/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">29:43</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/DRtVBjk2Noax94hHqr8yCcEjhNUhHRvyzBE3qS9WWilnE1-uQQNVnQd8mdG9h_IvNZCRApZSQw=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Create A Responsive Website with Login & Registration Form in HTML CSS and JavaScript</h2>
                <p class="channel-name">CodingNepal</p>
                <p class="views">68K Views • 9 months ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="https://i.ytimg.com/vi/hSSdc8vKP1I/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">38:45</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/DRtVBjk2Noax94hHqr8yCcEjhNUhHRvyzBE3qS9WWilnE1-uQQNVnQd8mdG9h_IvNZCRApZSQw=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Build Hangman Game in HTML CSS and JavaScript</h2>
                <p class="channel-name">CodingNepal</p>
                <p class="views">57K Views • 11 months ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="https://i.ytimg.com/vi/coj-l7IrwGU/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">19:27</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/DRtVBjk2Noax94hHqr8yCcEjhNUhHRvyzBE3qS9WWilnE1-uQQNVnQd8mdG9h_IvNZCRApZSQw=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">How to Make Chrome Extension in HTML CSS & JavaScript</h2>
                <p class="channel-name">CodingNepal</p>
                <p class="views">24K Views • 1 year ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="https://i.ytimg.com/vi/6QE8dXq9SOE/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">16:24</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/DRtVBjk2Noax94hHqr8yCcEjhNUhHRvyzBE3qS9WWilnE1-uQQNVnQd8mdG9h_IvNZCRApZSQw=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Create A Draggable Card Slider in HTML CSS and Vanilla JavaScript</h2>
                <p class="channel-name">CodingNepal</p>
                <p class="views">14.2K Views • 4 days ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="https://i.ytimg.com/vi/q4RgxiDM6v0/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">37:13</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/uITV5E7auiZMDD_BwhVRJMHXXY6qQc0GqBgVyP5LWYTmeRlUP2Dc945UlIbODvztd96ReOts=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">How to make Responsive Image Slider in HTML CSS and JavaScript</h2>
                <p class="channel-name">CodingLab</p>
                <p class="views">1M Views • 1 year ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="https://i.ytimg.com/vi/DLs1X9T1GcY/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">9:27</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/DRtVBjk2Noax94hHqr8yCcEjhNUhHRvyzBE3qS9WWilnE1-uQQNVnQd8mdG9h_IvNZCRApZSQw=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Create Text Typing Effect in HTML CSS & Vanilla JavaScript</h2>
                <p class="channel-name">CodingNepal</p>
                <p class="views">17K Views • 10 months ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="https://i.ytimg.com/vi/PsNaoDhzQm0/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">25:27</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/DRtVBjk2Noax94hHqr8yCcEjhNUhHRvyzBE3qS9WWilnE1-uQQNVnQd8mdG9h_IvNZCRApZSQw=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Create Responsive Image Slider in HTML CSS and JavaScript</h2>
                <p class="channel-name">CodingNepal</p>
                <p class="views">157K Views • 9 months ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="https://i.ytimg.com/vi/20Qb7pNMv-4/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">12:24</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/uITV5E7auiZMDD_BwhVRJMHXXY6qQc0GqBgVyP5LWYTmeRlUP2Dc945UlIbODvztd96ReOts=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Make A Flipping Card UI Design in HTML & CSS</h2>
                <p class="channel-name">CodingLab</p>
                <p class="views">85K Views • 2 months ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="https://i.ytimg.com/vi/_RSaI2CxlXU/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">30:20</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/DRtVBjk2Noax94hHqr8yCcEjhNUhHRvyzBE3qS9WWilnE1-uQQNVnQd8mdG9h_IvNZCRApZSQw=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Easy way to do Multiple File Uploading using HTML CSS and JavaScript</h2>
                <p class="channel-name">CodingNepal</p>
                <p class="views">7.4K Views • 3 weeks ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="https://i.ytimg.com/vi/cHkN82X3KNU/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">11:13</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/uITV5E7auiZMDD_BwhVRJMHXXY6qQc0GqBgVyP5LWYTmeRlUP2Dc945UlIbODvztd96ReOts=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Build A Responsive Calculator in HTML CSS & JavaScript</h2>
                <p class="channel-name">CodingLab</p>
                <p class="views">30K Views • 2 years ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="https://i.ytimg.com/vi/0_Lwi5ucGwM/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">39:43</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/DRtVBjk2Noax94hHqr8yCcEjhNUhHRvyzBE3qS9WWilnE1-uQQNVnQd8mdG9h_IvNZCRApZSQw=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Build A Currency Converter using ReactJS</h2>
                <p class="channel-name">CodingNepal</p>
                <p class="views">7.2K • 2 weeks ago</p>
              </div>
            </div>
          </a>
          <a href="#" class="video-card">
            <div class="thumbnail-container">
              <img src="https://i.ytimg.com/vi/AyV954yKRSw/maxresdefault.jpg" alt="Video Thumbnail" class="thumbnail">
              <p class="duration">1:37:13</p>
            </div>
            <div class="video-info">
              <img src="https://yt3.googleusercontent.com/uITV5E7auiZMDD_BwhVRJMHXXY6qQc0GqBgVyP5LWYTmeRlUP2Dc945UlIbODvztd96ReOts=s176-c-k-c0x00ffffff-no-rj" alt="Channel Logo" class="icon">
              <div class="video-details">
                <h2 class="title">Responsive Admin Dashboard Panel in HTML CSS and JavaScript</h2>
                <p class="channel-name">CodingLab</p>
                <p class="views">161K Views • 1 year ago</p>
              </div>
            </div>
          </a>
        </div>
      </div>
    </main>
  </div>

  <!-- Linking custom script -->
  <script>
    const menuButtons = document.querySelectorAll(".menu-button");
const screenOverlay = document.querySelector(".main-layout .screen-overlay");
const themeButton = document.querySelector(".navbar .theme-button i");

// Toggle sidebar visibility when menu buttons are clicked
menuButtons.forEach(button => {
  button.addEventListener("click", () => {
    document.body.classList.toggle("sidebar-hidden");
  });
});

// Toggle sidebar visibility when screen overlay is clicked
screenOverlay.addEventListener("click", () => {
  document.body.classList.toggle("sidebar-hidden");
});

// Initialize dark mode based on localStorage
if (localStorage.getItem("darkMode") === "enabled") {
  document.body.classList.add("dark-mode");
  themeButton.classList.replace("uil-moon", "uil-sun");
} else {
  themeButton.classList.replace("uil-sun", "uil-moon");
}

// Toggle dark mode when theme button is clicked
themeButton.addEventListener("click", () => {
  const isDarkMode = document.body.classList.toggle("dark-mode");
  localStorage.setItem("darkMode", isDarkMode ? "enabled" : "disabled");
  themeButton.classList.toggle("uil-sun", isDarkMode);
  themeButton.classList.toggle("uil-moon", !isDarkMode);
});

// Show sidebar on large screens by default
if (window.innerWidth >= 768) {
  document.body.classList.remove("sidebar-hidden");
}

  </script>
</body>
</html>























