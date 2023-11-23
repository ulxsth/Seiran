<?php
require_once dirname(__FILE__, 2) . "/repository/BookRepository.php";

function findById($id) {
    $repository = new BookRepository();
    return $repository->findById($id);
}
?>