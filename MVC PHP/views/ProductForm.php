<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Produk</title>
</head>
<body>
    <h1><?= isset($product) ? 'Edit' : 'Tambah' ?> Produk</h1>
    <form method="POST" action="index.php?action=<?= isset($product['id']) ? 'update&id=' . $product['id'] : 'store' ?>">
    
    <label>Nama:</label>
    <input type="text" name="name" value="<?= isset($product['name']) ? $product['name'] : '' ?>" required>

    <label>Harga:</label>
    <input type="number" name="price" value="<?= isset($product['price']) ? $product['price'] : '' ?>" required>
    
    <button type="submit">Simpan</button>
</form>

    <a href="index.php">Kembali</a>
</body>
</html>