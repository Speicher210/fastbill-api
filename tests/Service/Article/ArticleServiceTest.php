<?php

namespace Speicher210\Fastbill\Test\Api\Service\Article;

use Speicher210\Fastbill\Api\Model\Article;
use Speicher210\Fastbill\Api\Model\Customer;
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

    public function testGetArticles()
    {
        /** @var ArticleService $articleService */
        $articleService = $this->getServiceToTest();
        $apiResponse = $articleService->getArticles(1);

        $this->assertInstanceOf(GetApiResponse::class, $apiResponse);
        /** @var GetResponse $response */
        $response = $apiResponse->getResponse();

        $this->assertEquals(array($this->getExpectedArticle()), $response->getArticles());
    }

    public function testGetArticle()
    {
        /** @var ArticleService $articleService */
        $articleService = $this->getServiceToTest();

        $actualArticle = $articleService->getArticle(1);
        $expectedArticle = $this->getExpectedArticle();

        $this->assertEquals($expectedArticle, $actualArticle);
    }

    public function testGetCheckoutURLThrowsExceptionIfArticleIsNotFound()
    {
        /** @var ArticleService $articleService */
        $articleService = $this->getServiceToTest();

        $this->setExpectedException('\OutOfBoundsException', 'Article not found.');

        $articleService->getCheckoutURL('NON-EXISTING');
    }

    public function testGetCheckoutURLReturnsTheURLIfNoCustomerPassed()
    {
        /** @var ArticleService $articleService */
        $articleService = $this->getServiceToTest();

        $this->assertSame(
            'https://automatic.fastbill.com/purchase/aa9122707e4baf2090e23babe7473a79/1',
            $articleService->getCheckoutURL(1)
        );
    }

    public function testGetCheckoutURLReturnsTheURLForACustomer()
    {
        /** @var ArticleService $articleService */
        $articleService = $this->getServiceToTest();

        $customer = new Customer();
        $customer->setHash('customer-hash');


        $this->assertSame(
            'https://automatic.fastbill.com/checkout/0/account-has/customer-hash/1',
            $articleService->getCheckoutURL('1', $customer)
        );
    }

    /**
     * Get an article for expected.
     *
     * @return Article
     */
    private function getExpectedArticle()
    {
        $expectedArticle = new Article();
        $expectedArticle->setArticleNumber(1);
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
        $expectedArticle->setCheckoutUrl(
            'https://automatic.fastbill.com/purchase/aa9122707e4baf2090e23babe7473a79/1'
        );
        $expectedArticle->addFeature(
            new Feature('code', 2, 'value')
        );

        return $expectedArticle;
    }

    /**
     * {@inheritdoc}
     */
    protected function getClassUnderTest()
    {
        return ArticleService::class;
    }
}
