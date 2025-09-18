<?php
include("includes/header.php");
include("includes/db.php");

// معالجة النموذج بعد الإرسال
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $image = '';

    // التعامل مع الصورة
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = "images/" . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image = $imageName;
        }
    }

    // إدخال البيانات في قاعدة البيانات
    $stmt = $pdo->prepare("INSERT INTO books (title, author, price, category, description, image) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $author, $price, $category, $description, $image]);

    echo "<p style='color:green; text-align:center;'>✅ تم إضافة الكتاب بنجاح!</p>";
}
?>

<div class="book-form" style="max-width: 600px; margin: 40px auto; background: #fff; padding: 30px; border-radius: 10px;">
  <h2 style="text-align:center;">📘 إضافة كتاب جديد</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <label>اسم الكتاب:</label>
    <input type="text" name="title" required style="width:100%; padding:10px;"><br><br>

    <label>اسم المؤلف:</label>
    <input type="text" name="author" required style="width:100%; padding:10px;"><br><br>

    <label>السعر (ر.س):</label>
    <input type="number" name="price" step="0.01" required style="width:100%; padding:10px;"><br><br>

    <label>التصنيف:</label>
    <input type="text" name="category" style="width:100%; padding:10px;"><br><br>

    <label>وصف مختصر:</label>
    <textarea name="description" rows="4" style="width:100%; padding:10px;"></textarea><br><br>

    <label>غلاف الكتاب (صورة):</label>
    <input type="file" name="image" accept="image/*" style="width:100%; padding:10px;"><br><br>

    <button type="submit" style="padding: 10px 20px; background:#5a189a; color:white; border:none; border-radius: 5px;">إضافة</button>
  </form>
</div>

<?php include("includes/footer.php"); ?>
