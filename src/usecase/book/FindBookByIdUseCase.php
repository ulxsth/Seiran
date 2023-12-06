<?php
require_once dirname(__FILE__, 3) . "/repository/BookRepository.php";

function findBookById($id, $includePrivate = false)
{
    $repository = new BookRepository();
    return $repository->findById($id, $includePrivate);
}
?>
