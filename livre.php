<?php
session_start();
require_once 'class/Message.php';
require_once 'class/GuestBook.php';

use App\Guestbook\GuestBook;
use App\Guestbook\Message;
$errors = null;
$success = false;
$guestbook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');
if (isset($_POST['username'], $_POST['message'])) {
    $message = new Message($_POST['username'], $_POST['message']);
    if ($message->isValid()) {
        $guestbook->addMessage($message);
        $success = true;
        $_POST = [];  // permet de vider les information (avec $success)

    } else {
        $errors = $message->getErrors();
    }
}
$messages = $guestbook->getMessages();


$titre = "livre d'or";
include "pages/header.php";
?>

<main class="container text-center mt-3">
    <h1>Livre d'or</h1>

    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger col-md-4 offset-4">
            Formulaire invalide
        </div>
    <?php endif ?>

    <?php if ($success) : ?>
        <div class="alert alert-success col-md-4 offset-4">
            Merci pour votre message
        </div>
    <?php endif ?>

    <div class="text-center col-md-4 offset-4">
            <form action="" method="post">
                <div class="md-3">
                    <label class="form-label">Pseudo</label>
                    <input value="<?= htmlentities($_POST['username'] ?? '')  ?>" class="form-control <?= isset($errors['username']) ? 'is-invalid' : ''?>" type="text" name="username" placeholder="Votre pseudo">
                    <?php if (!empty($errors['username'])) : ?>
                        <div class="invalid-feedback"><?= $errors['username'] ?></div>
                    <?php endif ?>
                </div>
                <div class="md-3">
                    <label class="form-label">Message</label>
                    <textarea class="form-control <?= isset($errors['message']) ? 'is-invalid' : ''?>" name="message" placeholder="Votre message"><?= htmlentities($_POST['message'] ?? '') ?></textarea>
                    <?php if (!empty($errors['message'])) : ?>
                        <div class="invalid-feedback"><?= $errors['message'] ?></div>
                    <?php endif ?>
                </div>

                <button class="btn btn-primary mt-3">Envoyer</button>
            </form>
            
            <?php if(!empty($messages)): ?>
            <h1 class="mt-3">Vos messages</h1>

            <?php foreach($messages as $message): ?>
                <?= $message->toHTML()?>
           <?php endforeach ?>
            <?php endif ?>
            

        </div>

</main>

<?php include "pages/footer.php" ?>