<?php
require_once dirname(__FILE__, 2) . "/repository/BookRepository.php";

function findBookById($id)
{
    $repository = new BookRepository();
    return $repository->findById($id);
}
