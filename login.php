<?php
session_start();
include("includes/header.php");
include("includes/db.php");

$mode = $_GET['mode'] ?? 'login';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($mode === 'register') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = "البريد الإلكتروني مسجل مسبقًا.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $password]);
            $_SESSION['user'] = $name;
            header("Location: index.php");
            exit;
        }
    } else { // تسجيل الدخول
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['name'];
            header("Location: index.php");
            exit;
        } else {
            $errors[] = "بيانات الدخول غير صحيحة.";
        }
    }
}
?>

<div style="max-width: 400px; margin: 40px auto; background: white; padding: 30px; border-radius: 10px;">
  <h2 style="text-align:center;"><?= $mode === 'register' ? '📝 تسجيل حساب جديد' : '🔐 تسجيل الدخول' ?></h2>

  <?php foreach ($errors as $error): ?>
    <p style="color:red; text-align:center;"><?= $error ?></p>
  <?php endforeach; ?>

  <form action="?mode=<?= $mode ?>" method="POST">
    <?php if ($mode === 'register'): ?>
      <label>الاسم:</label>
      <input type="text" name="name" required style="width:100%; padding:10px;"><br><br>
    <?php endif; ?>

    <label>البريد الإلكتروني:</label>
    <input type="email" name="email" required style="width:100%; padding:10px;"><br><br>

    <label>كلمة المرور:</label>
    <input type="password" name="password" required style="width:100%; padding:10px;"><br><br>

    <button type="submit" style="width:100%; padding:10px; background:#5a189a; color:white; border:none; border-radius: 5px;">
      <?= $mode === 'register' ? 'تسجيل' : 'دخول' ?>
    </button>
  </form>

  <p style="text-align:center; margin-top: 15px;">
    <?= $mode === 'register' ? 'هل لديك حساب؟' : 'ليس لديك حساب؟' ?>
    <a href="?mode=<?= $mode === 'register' ? 'login' : 'register' ?>">
      <?= $mode === 'register' ? 'تسجيل الدخول' : 'إنشاء حساب' ?>
    </a>
  </p>
</div>

<?php include("includes/footer.php"); ?>
