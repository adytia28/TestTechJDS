<?php

namespace App\Http\Controllers\Api;

use App\Events\{NewsDeleteEvent, NewsStoreEvent, NewsUpdateEvent};
use App\Interfaces\NewsRepositoryInterface;
use App\Interfaces\RolesRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\IndexNewsRequest;
use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Requests\News\CommentNewsRequest;
use App\Services\FormatApi\Response;
use App\Http\Resources\NewsResource;
use App\Traits\LogActivity;
use Illuminate\Http\Request;

class NewsController extends Controller {
    use LogActivity;

    private NewsRepositoryInterface $newsRepository;
    private RolesRepositoryInterface $rolesRepository;

    public function __construct(NewsRepositoryInterface $newsRepository, RolesRepositoryInterface $rolesRepository) {
        $this->newsRepository = $newsRepository;
        $this->rolesRepository = $rolesRepository;
    }

    public function index(IndexNewsRequest $request) {
        return $this->newsRepository->getNewsPagination($request);
    }

    public function store(StoreNewsRequest $request) {
        $response = $this->newsRepository->createNews($request);

        if($response['success'])
        event(new NewsStoreEvent($this->log($request)));

        return new NewsResource($response);

    }

    public function show($slug) {
        $news = $this->newsRepository->getNewsDetail($slug);

        if($news) {
            return new NewsResource($news);
        } else {
            return new NewsResource(Response::errors('News not found'));
        }
    }

    public function update(UpdateNewsRequest $request, $slug) {
        $response = $this->newsRepository->updateNews($slug, $request);

        if($response['success'])
        event(new NewsUpdateEvent($this->log($request)));
        return new NewsResource($response);
    }

    public function delete($slug, Request $request) {
        $response = $this->newsRepository->deleteNews($slug);

        if($response['success'])
        event(new NewsDeleteEvent($this->log($request)));

        return new NewsResource($response);
    }

    public function comment($slug, CommentNewsRequest $request) {
        $response = $this->newsRepository->createCommentNews($slug, $request);
        return new NewsResource($response);
    }
}
