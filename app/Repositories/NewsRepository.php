<?php

namespace App\Repositories;

use App\Interfaces\NewsRepositoryInterface;
use App\Models\News;
use App\Models\NewsComments;
use App\Models\NewsImage;
use App\Services\FormatApi\Response;
use Illuminate\Support\Facades\DB;
use APP\Traits\Authorization;

class NewsRepository implements NewsRepositoryInterface {
    Use Authorization;

    public function getNewsPagination($data) {
        $page = $data['page'] - 1;
        $news = DB::table('news')->select('id')->orderBy('id')->get()->pluck('id')->toArray();

        $total = count($news);

        if($total > 0) {
            $split = array_chunk($news, $data['show']);
            $splitKeys = array_keys($split);
            $latestKeys = end($splitKeys);

            if($page <= $latestKeys) {

                $listPage = [];

                foreach($splitKeys as  $list) {
                    if(count($listPage) < 5 && $list >= $page - 2) {
                        $listPage[] = $list + 1;
                    }

                    if(count($listPage) < 5 && $list >= $page  && $list <= $page - 1) {
                        $listPage[] = $list + 1;
                    }
                }

                $news = $split[$page] ?? [];
                $result = News::with(['newsImage', 'newsComment'])->whereIn('id', $news)->get();
            } else {
                return Response::errors('Your pagination page is not found');
            }

            $news = [
                'result'        => $result,
                'first'         => $page + 1,
                'latest'        => $latestKeys  + 1,
                'total'         => $total,
                'pagination'    => $listPage ?? [],
            ];
        } else {
            $news = [];
        }

        return Response::success($news);
    }

    public function getNewsDetail($slug) {
        return News::with('newsImage', 'newsComment')->where('slug', $slug)->first();
    }

    public function createNews($data) {
        try {
            $news = new News;
            $news = $this->storeNewsReusable($news, $data);

            $images = new NewsImage;
            $image = $this->storeNewsImageReusable($news->id,  $images, $data['thumbnail']);

            return Response::success([
                'news'  => $news,
                'image' => $image,
            ]);
        } catch(\Exception $e) {
            return Response::errors($e->getMessage());
        }
    }

    public function updateNews($slug, $data) {
        try {
            $news = News::where('slug', $slug)->first();

            if(isset($news)) {
                $news = $this->storeNewsReusable($news, $data);

                $images = NewsImage::where('news_id', $news->id)->first();

                if($images)
                $image = $this->storeNewsImageReusable($news->id,  $images, $data['thumbnail']);

                return Response::success([
                    'news'  => $news,
                    'image' => $image ?? [],
                ]);
            } else {
                return Response::errors('News not found');
            }
        } catch(\Exception $e) {
            return Response::errors($e->getMessage());
        }
    }

    public function deleteNews($slug) {
        $news = News::where('slug', $slug)->first();

        if($news) {
            News::destroy($news->id);
            return Response::delete('News success delete');
        } else {
            return Response::errors('News not found');
        }
    }

    public function createCommentNews($slug, $data) {
        $news = News::with('newsComment')->where('slug', $slug)->first();

        if($news) {
            $comment = new NewsComments;
            $comment->users_id = $this->me($data)->id;
            $comment->comments = $data['comment'];
            $comment->news_id = $news->id;
            $comment->save();

            return $comment;
        } else {
            return Response::errors('News not found');
        }
    }

    public function storeNewsReusable($news, $data) {
        $news->users_id = $this->me($data)->id;
        $news->news_category_id =  $data['news_category_id'];
        $news->title =  $data['title'];
        $news->slug = $data['title'];
        $news->content =  $data['content'];

        if(!isset($news->created_by))
        $news->created_by =  $this->me($data)->id;

        $news->updated_by =  $this->me($data)->id;
        $news->save();

        return $news;
    }

    public function storeNewsImageReusable($newsId, $images, $image) {
        $images->news_id = $newsId;

        if(gettype($image) == 'object')
        $images->thumbnail = $image->store('news', 'public');
        else
        $images->thumbnail = $image;

        $images->save();

        return $images;
    }
}
