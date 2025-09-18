<?php
include("includes/header.php");
include("includes/db.php");

// التحقق من وجود معرف الكتاب
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p style='text-align:center; color:red;'>❌ لم يتم العثور على الكتاب.</p>";
    include("includes/footer.php");
    exit;
}

// جلب بيانات الكتاب من قاعدة البيانات
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch();

if (!$book) {
    echo "<p style='text-align:center; color:red;'>❌ الكتاب غير موجود.</p>";
    include("includes/footer.php");
    exit;
}
?>

<div style="max-width: 900px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px; display: flex; gap: 30px;">
  <div style="flex: 1;">
    <img src="images/<?= htmlspecialchars($book['image']) ?>" alt="غلاف الكتاب" style="width:100%; height: auto; border-radius: 8px;">
  </div>
  <div style="flex: 2;">
    <h2><?= htmlspecialchars($book['title']) ?></h2>
    <p><strong>المؤلف:</strong> <?= htmlspecialchars($book['author']) ?></p>
    <p><strong>التصنيف:</strong> <?= htmlspecialchars($book['category']) ?: 'غير محدد' ?></p>
    <p><strong>الوصف:</strong></p>
    <p><?= nl2br(htmlspecialchars($book['description'])) ?></p>
    <p style="font-size: 20px; margin-top: 20px;"><strong>السعر:</strong> <?= number_format($book['price'], 2) ?> ر.س</p>

    <form action="cart.php" method="POST" style="margin-top: 20px;">
      <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
      <button type="submit" class="btn">إضافة إلى السلة 🛒</button>
    </form>
  </div>
</div>

<?php include("includes/footer.php"); ?>
