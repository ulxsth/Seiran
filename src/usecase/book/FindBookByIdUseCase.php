<?php
require_once dirname(__FILE__, 3) . "/repository/BookRepository.php";

function findBookById($id)
{
    $repository = new BookRepository();
    return $repository->findById($id);
}
