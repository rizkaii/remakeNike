<?php
include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM product WHERE id=$id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Cek jika file baru diunggah
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $image_path = $target_file;
    } else {
        $image_path = $product['image_path']; // Pertahankan gambar lama
    }

    // Update data ke database
    $update = "UPDATE product SET name='$name', price='$price', image_path='$image_path' WHERE id=$id";
    if ($conn->query($update) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Product</title>
</head>
<body>
    <h1>Update Product</h1>
    <form method="POST" enctype="multipart/form-data">
        Name: <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>
        Price: <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required><br>
        Current Image: <br>
        <img src="<?php echo $product['image_path']; ?>" width="100" alt="Current Image"><br>
        New Image: <input type="file" name="image" accept="image/*"><br><br>
        <input type="submit" value="Update Product">
    </form>
    <a href="index.php">Back to Catalog</a>
</body>
</html>
