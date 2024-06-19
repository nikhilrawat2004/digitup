<!DOCTYPE html>
<?php
    session_start();
    include("backend/dbconnect.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dishes</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <style>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .dish-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 30px;
        }

        .dish-group h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .dish-list {
            display: flex;
            overflow-x: auto;
            margin-bottom: 10px;
        }

        .dish {
            width: 300px;
            margin-right: 30px;
            text-align: center;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: 0.3s;
            border-radius: 5px;
            overflow: hidden;
            }

        .dish img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            }

        .dish h2 {
            margin: 10px 0;
            font-size: 24px;
            color: #333;
            }

        .dish p {
            margin: 10px 0;
            font-size: 16px;
            color: #666;
            }

        .dish:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
            }

        h1 {
            font-size: 36px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        p {
            font-size: 18px;
            color: #666;
            line-height: 1.5;
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
            width: auto; /* Add this line to maintain the aspect ratio */
        }
        .logo img {
            height: 40px;
            width: auto; /* Add this line to maintain the aspect ratio */
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

        nav ul li.dropdown ul {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #333;
            min-width: 100%;
        }

        nav ul li.dropdown:hover ul {
            display: block;
        }

        nav ul li.dropdown ul li a {
            padding: 5px 10px;
        }

        .sub-menu-wrap {
            position: relative;
        }

        .sub-menu {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background-color: #333;
            display: none;
        }

        .sub-menu-wrap:hover .sub-menu {
            display: block;
        }

        .sub-menu-link {
            display: flex;
            align-items: center;
            padding: 10px;
            color: #fff;
            text-decoration: none;
        }

        .sub-menu-link:hover {
            background-color: #555;
        }

        .sub-menu-link img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .sub-menu-link span {
            margin-left: auto;
        }

        .user-info {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #555;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .user-info h3 {
            color: #fff;
            margin-bottom: 0;
        }

        hr {
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(255, 255, 255, 0.7), rgba(0, 0, 0, 0));
            margin: 10px 0;
        }

        .button {
            background-color: #4CAF50;
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

        .button:hover {
            background-color: #3e8e41;
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
            <li><a href="./restaurants.php">Restaurents</a></li>
            <li><a href="./about.html">About</a></li>
            <li><a href="./contact.html">Contact us</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <h1>Dishes</h1>

<?php
// Include the database connection
require "backend/dbconnect.php";

// Fetch all dishes from the database
$sql = "SELECT d.rs_id, c.c_name, d.title, d.slogan, d.price, d.img FROM digitup.dishes d JOIN digitup.restaurant r ON d.rs_id = r.rs_id JOIN digitup.res_category c ON r.c_id = c.c_id";
$result = mysqli_query($conn, $sql);

// Group dishes by rs_id
$dishes_by_rs_id = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rs_id = $row["rs_id"];
    if (!isset($dishes_by_rs_id[$rs_id])) {
        $dishes_by_rs_id[$rs_id] = [];
    }
    $dishes_by_rs_id[$rs_id][] = $row;
}

// Display each dish group
foreach ($dishes_by_rs_id as $rs_id => $dishes) {
    echo "<div class='dish-group'>";
    echo "<h2>" . $dishes[0]["c_name"] . " Restaurant</h2>";
    echo "<div class='dish-list'>";
    foreach ($dishes as $dish) {
        echo "<div class='dish' id='dish-$rs_id'>";
        echo "<img src='./admin/img/dishes/" . $dish["img"] . "' alt='" . $dish["title"] . "'>";
        echo "<div class='dish-info'>";
        echo "<h2>" . $dish["title"] . "</h2>";
        echo "<p>" . $dish["slogan"] . "</p>";
        echo "<p>Price: ₹" . $dish["price"] . "</p>";
        echo "<button class='add-to-cart button' data-dish-id='" . $dish["rs_id"] . "'>Add to Cart</button>";
        echo "</div>";
        echo "</div>";
    }
    echo "</div>";
    echo "</div>";
}

// Close the database connection
mysqli_close($conn);
?>

</div>
<script>
    $(document).ready(function() {
        $(".add-to-cart").click(function() {
            var dishId = $(this).data("dish-id");
            // Add the dish to the cart using AJAX
            $.ajax({
                url: "add-to-cart.php",
                method: "POST",
                data: { dish_id: dishId },
                success: function(response) {
                    // Handle the response from the server
                    console.log(response);
                }
            });
        });
    });
</script>
</body>
</html>