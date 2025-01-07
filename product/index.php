<?php
include 'db.php';

// Ambil semua produk
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Catalog</title>
    <style>
        .catalog-card { 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            padding: 15px; 
            text-align: center; 
            width: 250px;
            margin: 10px;
            display: inline-block;
        }
        .image-container img { 
            width: 100%; 
            height: auto; 
        }
        .product-info h2 { 
            color: #333; 
            font-size: 1.5rem; 
        }
        .product-title {
            color: #555;
            font-size: 1rem;
        }
        .shop-now button {
            background-color: #ff7f50;
            border: none;
            color: white;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Product Catalog</h1>
    <a href="create.php">tambah</a><br><br>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <div class="catalog-card">
                <div class="image-container">
                    <img src="' . $row["image_path"] . '" alt="' . $row["name"] . '">
                </div>
                <div class="product-info">
                    <h2>$' . $row["price"] . '</h2>
                </div>
                <p class="product-title">' . $row["name"] . '</p>
                <div class="shop-now">
                    <a href="update.php?id=' . $row["id"] . '"><button>Edit</button></a>
                    <a href="delete.php?id=' . $row["id"] . '" onclick="return confirm(\'Are you sure?\')"><button>Delete</button></a>
                </div>
            </div>';
        }
    } else {
        echo "<p>No products available</p>";
    }
    $conn->close();
    ?>
</body>
</html>
