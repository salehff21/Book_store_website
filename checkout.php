<?php
session_start();
include("includes/header.php");
include("includes/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];

    if (!empty($_SESSION['cart'])) {
        // في مشروع حقيقي: يتم حفظ الطلب هنا في قاعدة بيانات الطلبات

        // إفراغ السلة
        $_SESSION['cart'] = [];

        echo "<p style='color:green; text-align:center;'>✅ تم استلام طلبك بنجاح! سيتم التواصل معك قريبًا.</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>❌ السلة فارغة، لا يمكن إتمام الطلب.</p>";
    }
}
?>

<div style="max-width: 600px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px;">
  <h2 style="text-align:center;">📦 إتمام الطلب</h2>
  <form action="" method="POST">
    <label>الاسم الكامل:</label>
    <input type="text" name="name" required style="width:100%; padding:10px;"><br><br>

    <label>البريد الإلكتروني:</label>
    <input type="email" name="email" required style="width:100%; padding:10px;"><br><br>

    <label>العنوان:</label>
    <textarea name="address" rows="3" required style="width:100%; padding:10px;"></textarea><br><br>

    <label>طريقة الدفع:</label>
    <select name="payment" style="width:100%; padding:10px;" required>
      <option value="cash">الدفع عند الاستلام</option>
      <option value="credit">بطاقة ائتمانية</option>
    </select><br><br>

    <button type="submit" style="padding: 10px 20px; background:#5a189a; color:white; border:none; border-radius: 5px;">تأكيد الطلب</button>
  </form>
</div>

<?php include("includes/footer.php"); ?>
