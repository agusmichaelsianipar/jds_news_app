<?php

namespace App\Repositories\Comment;


Interface CommentRepositoryInterface{

    public function getCommentById($id);

    public function storeComment($data, $guest);
}

?>