<?php

namespace App\Interfaces;

interface NewsRepositoryInterface {
    public function createNews($newsDetails);
    public function updateNews($newsId, $newsDetail);
    public function deleteNews($newsId);
    public function getNewsPagination($data);
    public function getNewsDetail($slug);
    public function createCommentNews($slug, $comment);
}

?>
