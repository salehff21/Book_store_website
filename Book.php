<?php
include("includes/header.php");
include("includes/db.php");

// استعلام جميع الكتب
$stmt = $pdo->query("SELECT * FROM books ORDER BY created_at DESC");
$books = $stmt->fetchAll();
?>

<div style="padding: 30px;">
  <h2 style="text-align:center;">📚 جميع الكتب المتوفرة</h2>

  <div class="books-grid">
    <?php foreach ($books as $book): ?>
      <div class="book-card">
        <img src="images/<?= htmlspecialchars($book['image']) ?>" alt="غلاف الكتاب">
        <h3><?= htmlspecialchars($book['title']) ?></h3>
        <p>بواسطة: <?= htmlspecialchars($book['author']) ?></p>
        <p>السعر: <?= number_format($book['price'], 2) ?> ر.س</p>
        <a href="book-details.php?id=<?= $book['id'] ?>" class="btn">عرض التفاصيل</a>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include("includes/footer.php"); ?>
