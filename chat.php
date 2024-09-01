<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


$messages = [];
try {
    $stmt = $conn->prepare("SELECT messages.*, users.username FROM messages JOIN users ON messages.user_id = users.id ORDER BY messages.created_at ASC");
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Messages could not be transfered: " . $e->getMessage();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $conn->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
        $stmt->execute([$user_id, $message]);
    } catch (PDOException $e) {
        echo "Message could not be saved: " . $e->getMessage();
    }


    try {
        $stmt = $conn->prepare("SELECT messages.*, users.username FROM messages JOIN users ON messages.user_id = users.id ORDER BY messages.created_at ASC");
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Messages could not be transfered: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Live Chat</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function fetchMessages() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_messages.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('chat').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
        setInterval(fetchMessages, 2000);
    </script>
</head>
<body>
    <div class="container">
        <h2>Live Chat</h2>
        <div id="chat">
            <?php if ($messages): ?>
                <?php foreach ($messages as $message): ?>
                    <p><strong><?php echo htmlspecialchars($message['username']); ?>:</strong> <?php echo htmlspecialchars($message['message']); ?></p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Keine Nachrichten vorhanden.</p>
            <?php endif; ?>
        </div>
        <form method="post">
            <input type="text" name="message" required>
            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>
