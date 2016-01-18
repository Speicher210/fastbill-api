<?php

namespace Speicher210\Fastbill\Api\Service\Article;

use Speicher210\Fastbill\Api\AbstractService;

/**
 * Service for articles.
 */
class ArticleService extends AbstractService
{
    /**
     * Get the articles.
     *
     * @param string $articleNumber Article number to filter on.
     * @return Get\ApiResponse
     */
    public function getArticles($articleNumber = null)
    {
        $requestData = new Get\RequestData();
        $requestData->setArticleNumber($articleNumber);

        $request = new Get\Request($requestData);

        return $this->sendRequest($request, Get\ApiResponse::class);
    }
}
