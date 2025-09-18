<?php
include("includes/header.php");
include("includes/db.php");

$stmt = $pdo->query("SELECT * FROM books ORDER BY created_at DESC LIMIT 6");
$books = $stmt->fetchAll();
?>

<div class="hero-section">
  <h1>مرحبًا بك في متجر الكتب 📚</h1>
  <p>اكتشف أحدث الكتب وأكثرها مبيعًا في مكتبتنا الرقمية!</p>
</div>

<div class="book-list">
  <h2>📖 الكتب المضافة حديثًا</h2>
  <div class="books-grid">
    <?php foreach ($books as $book): ?>
      <div class="book-card">
        <img src="images/<?= htmlspecialchars($book['image']) ?>" alt="غلاف الكتاب">
        <h3><?= htmlspecialchars($book['title']) ?></h3>
        <p>السعر: <?= number_format($book['price'], 2) ?> ر.س</p>
        <a href="book-details.php?id=<?= $book['id'] ?>" class="btn">عرض التفاصيل</a>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php include("includes/footer.php"); ?>
