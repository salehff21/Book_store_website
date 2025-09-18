<?php
session_start();
include("includes/header.php");
include("includes/db.php");

// إنشاء السلة إذا لم تكن موجودة
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// إضافة كتاب للسلة
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];
    if (!isset($_SESSION['cart'][$book_id])) {
        $_SESSION['cart'][$book_id] = 1;
    } else {
        $_SESSION['cart'][$book_id]++;
    }
}

// حذف عنصر من السلة
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    unset($_SESSION['cart'][$remove_id]);
}

// جلب تفاصيل الكتب من قاعدة البيانات
$cartBooks = [];
$total = 0;

if (!empty($_SESSION['cart'])) {
    $ids = array_keys($_SESSION['cart']);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id IN ($placeholders)");
    $stmt->execute($ids);
    $cartBooks = $stmt->fetchAll();

    foreach ($cartBooks as $book) {
        $total += $book['price'] * $_SESSION['cart'][$book['id']];
    }
}
?>

<div style="padding: 30px;">
  <h2 style="text-align:center;">🛒 السلة</h2>

  <?php if (empty($cartBooks)): ?>
    <p style="text-align:center;">السلة فارغة حاليًا.</p>
  <?php else: ?>
    <table style="width:100%; border-collapse: collapse;">
      <thead>
        <tr style="background-color: #eee;">
          <th>الكتاب</th>
          <th>السعر</th>
          <th>الكمية</th>
          <th>الإجمالي</th>
          <th>إجراء</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cartBooks as $book): ?>
          <tr style="border-bottom: 1px solid #ccc; text-align: center;">
            <td><?= htmlspecialchars($book['title']) ?></td>
            <td><?= number_format($book['price'], 2) ?> ر.س</td>
            <td><?= $_SESSION['cart'][$book['id']] ?></td>
            <td><?= number_format($book['price'] * $_SESSION['cart'][$book['id']], 2) ?> ر.س</td>
            <td><a href="cart.php?remove=<?= $book['id'] ?>" style="color: red;">🗑 حذف</a></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <h3 style="text-align:right; margin-top: 20px;">المجموع الكلي: <?= number_format($total, 2) ?> ر.س</h3>

    <div style="text-align:center; margin-top: 20px;">
      <a href="checkout.php" class="btn" style="padding: 10px 20px;">إتمام الطلب ✅</a>
    </div>
  <?php endif; ?>
</div>

<?php include("includes/footer.php"); ?>
