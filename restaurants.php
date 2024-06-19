<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
 <meta name="" content="width=-width, initialscale=1.">
    <title>Restaurants</title>
 <style>
        .view-menu-button {
            background-color: #2E8B57;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 5px;
        }

        .view-menu-button:hover {
            background-color: #1B7A40;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e6f5ea;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin: 20px;
        }

        .card {
            background-color: #f2f2f2;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            flex-basis: calc(32% - 20px);
            margin-bottom: 20px;
            overflow: hidden;
            transition: transform 0.3s;
            width: 100%;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card-image {
            height: 200px;
            overflow: hidden;
            width: 100%;
        }

        .card-image img {
            height: 100%;
            object-fit: cover;
            width: 100%;
        }

        .card-content {
            padding: 15px;
        }

        .card-title {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .card-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: #666;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #093131;
            padding: 10px 20px;
        }

        .logo {
            height: 40px;
            width: auto;
        }

        .logo img {
            height: 40px;
            width: auto;
        }

        nav {
            display: flex;
            align-items: center;
            background-color: #093131;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            position: relative;
        }

        nav ul li a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
        }

        nav ul li a:hover {
            color: #e6f5ea;
        }

    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="./img/DIGitUp.png" alt="Logo">
    </div>
    <nav>
        <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./dishes.php">Dishes</a></li>
            <li><a href="./about.html">About</a></li>
            <li><a href="./contact.html">Contact us</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <?php
    // Include the database connection
    require "backend/dbconnect.php";

    // Fetch all restaurants from the database
    $sql = "SELECT * FROM restaurant";
    $result = mysqli_query($conn, $sql);

    // Display the cards of restaurants
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card'>";
        echo "<div class='card-image'><img src='./admin/img/restaurants/" . $row["image"] . "' alt='" . $row["title"] . "'></div>";
        echo "<div class='card-content'>";
        echo "<h2 class='card-title'>" . $row["title"] . "</h2>";
        echo "<p class='card-text'><strong>Email:</strong> " . $row["email"] . "</p>";
        echo "<p class='card-text'><strong>Phone:</strong> " . $row["phone"] . "</p>";
        echo "<p class='card-text'><strong>URL:</strong> <a href='" . $row["url"] . "'>" . $row["url"] . "</a></p>";
        echo "<p class='card-text'><strong>Opening Hour:</strong> " . $row["o_hr"] . "</p>";
        echo "<p class='card-text'><strong>Closing Hour:</strong> " . $row["c_hr"] . "</p>";
        echo "<p class='card-text'><strong>Opening Days:</strong> " . $row["o_days"] . "</p>";
        echo "<p class='card-text'><strong>Address:</strong> " . $row["address"] . "</p>";

        // Add the "View Menu" button
        echo "<a href='./menu.php?id=" . $row["rs_id"] . "' class='view-menu-button'>View Menu</a>";

        echo "</div>";
        echo "</div>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</div>
</body>
</html>