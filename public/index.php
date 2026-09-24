<?php
session_start();
use Dotenv\Dotenv;
use Nishanrahman\UserManagement\Database\Database;
use Nishanrahman\UserManagement\Repositories\UserRepository;
use Nishanrahman\UserManagement\Services\UserService;

require_once __DIR__ . "/../vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

$database = new Database();
$pdo = $database->getConnection();

$userRepository = new UserRepository($pdo);
$userService = new UserService($userRepository);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $age = (int) $_POST["age"];

    $_SESSION["old_input"]=[
        'name' => $name,
        'email' => $email,
        'age' => $age
    ];

    $newUserId = $userService->createUser($name, $email, $age);

    if (is_numeric($newUserId)) {

        $_SESSION['message'] = "User created successfully. User ID: " . $newUserId;
        $_SESSION['messageType'] = "success";

    } else {

        $_SESSION['message'] = $newUserId;
        $_SESSION['messageType'] = "danger";
    }
    header("Location: index.php");
    exit;
}

require_once __DIR__ . "/includes/header.php";



?>
<div class="container mt-5">

    <h1 class="text-primary">
        User Management
    </h1>

    <p class="text-secondary">
        Manage your users easily.
    </p>

    <hr>

    <h2 class="mb-4">
        Create New User
    </h2>


    <form method="POST">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?= $_SESSION['messageType'] ?>" role="alert">
                <?= htmlspecialchars($_SESSION['message'])
                    ?>
            </div>
            <?php
            unset($_SESSION['message']);
            unset($_SESSION['messageType']);
            ?>
        <?php endif; ?>
        <div class="mb-3">
            <label for="name" class="form-label">
                Name
            </label>

            <input
             type="text" 
             id="name" 
             name="name" 
             class="form-control" 
             placeholder="Enter your name"
             value="<?=  htmlspecialchars($_SESSION['old_input']['name'] ?? "") ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">
                Email
            </label>

            <input 
            type="email" 
            id="email" 
            name="email" 
            class="form-control" 
            placeholder="Enter your email"
            value="<?= htmlspecialchars($_SESSION['old_input']['email'] ?? "") ?>"
            >
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">
                Age
            </label>

            <input 
            type="number" 
            id="age" 
            name="age" 
            class="form-control" 
            placeholder="Enter your age"
            value="<?= htmlspecialchars($_SESSION['old_input']['age'] ?? "") ?>"
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Create User
        </button>
            <?php unset($_SESSION['old_input']); ?>
    </form>

</div>

<?php
require_once __DIR__ . "/includes/footer.php";