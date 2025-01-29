<!-- navigation.php -->
<link rel="stylesheet" href="../css/nav.css">
<nav>
      <a href="./home.php">
        <img id="logo" src='../assets/logo.png' alt="logo" />
      </a>
      <input type="checkbox" id="sidebar-active" />
      <label for="sidebar-active" class="open-sidebar-button">
        <img class="icons" src="../assets/nav/menu.svg" />
      </label>
      <label for="sidebar-active" id="overlay"></label>
      <div class="links-container">
        <label for="sidebar-active" class="close-sidebar-button">
          <img class="icons" src='../assets/nav/close.svg' />
        </label>
        
        <a href="./food.php">Foods</a>
        <a href="./history.php">Order History</a>
        <a href="./contact.php">Contact</a>
        <a href="./logout.php">
          <img class='logout' src="../assets/nav/logout.svg" alt="logout">
        </a>
      </div>
    </nav>