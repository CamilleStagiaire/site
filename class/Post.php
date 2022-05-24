<?php


class Post
{
    public $id;

    public $name;

    public $content;

    public $created_at;


    public function __construct()
     {

          if (is_string($this->created_at)) {
            $this->created_at = new DateTime('@' . $this->created_at);
          }
    }

    public function getExcerpt(): string  //récupérer un extrait
    {
        return substr($this->content, 0, 150); //récupérer les 150 1er caractères
    }
}
