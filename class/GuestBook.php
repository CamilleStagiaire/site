<?php
namespace App\Guestbook;

require_once 'Message.php';


class GuestBook {

    private $file;

    public function __construct(string $file)
    {
        $directory = dirname($file);
        if (!is_dir($directory)) { // permet de vérifier si un chemin est un dossier
          mkdir($directory, 0777, true);  // créer un dossier
        }
        if (!file_exists($file)) { // savoir si un fichier existe
            touch($file);// pour créer un fichier
        }
        $this->file = $file;
    }

    public function addMessage (Message $message): void // quand ca ne renvoit rien
    {
    file_put_contents($this->file, $message->toJSON() . PHP_EOL, FILE_APPEND);  // rajouter un message dans un fichier
    }

    public function getMessages() : array
    {
        $content = trim(file_get_contents($this->file)); // trim pour supprimer la dernière ligne qui est tjrs vide file_get_contents pourn récupérer le contenu du fichier
        $lines = explode(PHP_EOL, $content);  // pour récupérer chaque ligne exploser à chaque fin de ligne
        $messages = [];
        foreach ($lines as $line) {
            $messages[] = Message::fromJSON($line);
        }
        return array_reverse($messages);
    }
   
}



?>
