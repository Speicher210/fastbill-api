<?php

namespace Speicher210\Fastbill\Api\Service\Article;

use Speicher210\Fastbill\Api\AbstractService;
use Speicher210\Fastbill\Api\Model\Article;
use Speicher210\Fastbill\Api\Model\Customer;

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

    /**
     * Get one article by article number.
     *
     * @param string $articleNumber Article number of the article to get.
     * @return Article|null
     */
    public function getArticle($articleNumber)
    {
        $requestData = new Get\RequestData();
        $requestData->setLimit(1);
        $requestData->setArticleNumber($articleNumber);

        $request = new Get\Request($requestData);

        /** @var Get\ApiResponse $apiResponse */
        $apiResponse = $this->sendRequest($request, Get\ApiResponse::class);
        $articles = $apiResponse->getResponse()->getArticles();

        return isset($articles[0]) ? $articles[0] : null;
    }

    /**
     * Get the checkout URL for an article.
     *
     * @param string $articleNumber Article number of the article to get the checkout URL.
     * @param Customer $customer The customer for witch the checkout URL should be created.
     * @return string
     */
    public function getCheckoutURL($articleNumber, Customer $customer = null)
    {
        $article = $this->getArticle($articleNumber);
        if ($article === null) {
            throw new \OutOfBoundsException('Article not found.');
        }

        if ($customer === null) {
            return $article->getCheckoutUrl();
        }

        return sprintf(
            'https://automatic.fastbill.com/checkout/0/%s/%s/%s',
            $this->transport->getCredentials()->getAccountHash(),
            $customer->getHash(),
            $articleNumber
        );
    }
}
