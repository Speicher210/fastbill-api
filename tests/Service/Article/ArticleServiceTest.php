<?php

namespace Speicher210\Fastbill\Test\Api\Service\Article;

use Speicher210\Fastbill\Api\Model\Article;
use Speicher210\Fastbill\Api\Model\Feature;
use Speicher210\Fastbill\Api\Model\Translation;
use Speicher210\Fastbill\Api\Model\TranslationText;
use Speicher210\Fastbill\Api\Service\Article\ArticleService;
use Speicher210\Fastbill\Api\Service\Article\Get\ApiResponse as GetApiResponse;
use Speicher210\Fastbill\Api\Service\Article\Get\Response as GetResponse;
use Speicher210\Fastbill\Test\Api\Service\AbstractServiceTest;

/**
 * Test for the article service.
 */
class ArticleServiceTest extends AbstractServiceTest
{

    public function testGetArticle()
    {
        /** @var ArticleService $articleService */
        $articleService = $this->getServiceToTest();
        $apiResponse = $articleService->getArticles(666);

        $this->assertInstanceOf(GetApiResponse::class, $apiResponse);
        /** @var GetResponse $response */
        $response = $apiResponse->getResponse();
        $this->assertFalse($response->hasErrors());

        $expectedArticle = new Article();
        $expectedArticle->setArticleNumber(666);
        $expectedArticle->setTitle('Article test');
        $expectedArticle->setDescription('Article test description');
        $expectedArticle->setTags(array('tag1', 'tag2'));
        $expectedArticle->setIsAddon(false);
        $expectedArticle->setTranslation(
            (new Translation())
                ->setEnglish(
                    new TranslationText('Translation title', 'Translation description')
                )
        );
        $expectedArticle->setUnitPrice(27.0);
        $expectedArticle->setSetupFee(83.0);
        $expectedArticle->setAllowMultiple(true);
        $expectedArticle->setCurrencyCode('EUR');
        $expectedArticle->setVatPercent(19.0);
        $expectedArticle->setSubscriptionInterval('1 month');
        $expectedArticle->setSubscriptionNumberEvents(0);
        $expectedArticle->setSubscriptionTrial('2 day');
        $expectedArticle->setSubscriptionDuration('1 month');
        $expectedArticle->setSubscriptionDurationFollow('2 month');
        $expectedArticle->setSubscriptionCancellationPeriod('1 day');
        $expectedArticle->setReturnUrlSuccess('https://test.com/success');
        $expectedArticle->setReturnUrlCancel('https://test.com/cancel');
        $expectedArticle->setCheckoutUrl('https://automatic.fastbill.com/purchase/aa9122707e4baf2090e23babe7473a79/666');
        $expectedArticle->addFeature(
            new Feature('code', 2, 'value')
        );
        $this->assertEquals(array($expectedArticle), $response->getArticles());
    }

    /**
     * {@inheritdoc}
     */
    protected function getClassUnderTest()
    {
        return ArticleService::class;
    }
}
