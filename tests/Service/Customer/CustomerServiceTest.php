<?php

namespace Speicher210\Fastbill\Test\Api\Service\Customer;

use Speicher210\Fastbill\Api\Model\Customer;
use Speicher210\Fastbill\Api\Model\CustomerTrait;
use Speicher210\Fastbill\Api\Service\Customer\AddCredits\ApiResponse as AddCreditsApiResponse;
use Speicher210\Fastbill\Api\Service\Customer\AddCredits\Response as AddCreditsResponse;
use Speicher210\Fastbill\Api\Service\Customer\Create\ApiResponse as CreateApiResponse;
use Speicher210\Fastbill\Api\Service\Customer\Create\Response as CreateResponse;
use Speicher210\Fastbill\Api\Service\Customer\CreateSecureLink\ApiResponse as CreateSecureLinkApiResponse;
use Speicher210\Fastbill\Api\Service\Customer\CreateSecureLink\Response as CreateSecureLinkResponse;
use Speicher210\Fastbill\Api\Service\Customer\CustomerService;
use Speicher210\Fastbill\Api\Service\Customer\Delete\ApiResponse as DeleteApiResponse;
use Speicher210\Fastbill\Api\Service\Customer\Delete\Response as DeleteResponse;
use Speicher210\Fastbill\Api\Service\Customer\Get\ApiResponse as GetApiResponse;
use Speicher210\Fastbill\Api\Service\Customer\Get\RequestData as GetRequestData;
use Speicher210\Fastbill\Api\Service\Customer\Get\Response as GetResponse;
use Speicher210\Fastbill\Api\Service\Customer\Update\ApiResponse as UpdateApiResponse;
use Speicher210\Fastbill\Api\Service\Customer\Update\RequestData as UpdateRequestData;
use Speicher210\Fastbill\Api\Service\Customer\Update\Response as UpdateResponse;
use Speicher210\Fastbill\Test\Api\Service\AbstractServiceTest;

/**
 * Test for the customer service.
 */
class CustomerServiceTest extends AbstractServiceTest
{

    public function testGetCustomers()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getServiceToTest();

        $data = new GetRequestData();
        $data->setCustomerId(995443);
        $apiResponse = $customerService->getCustomers($data);

        $this->assertInstanceOf(GetApiResponse::class, $apiResponse);
        /** @var GetResponse $response */
        $response = $apiResponse->getResponse();

        $expectedCustomer = new Customer();
        $expectedCustomer = $this->getCustomerForTesting($expectedCustomer);
        $expectedCustomer->setChangeDataUrl('https://test.com/change-data');
        $expectedCustomer->setDashboardUrl('https://test.com/dashboard');
        $this->assertEquals(array($expectedCustomer), $response->getCustomers());
    }

    public function testGetCustomerWithDateFieldsEmptyString()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getServiceToTest();

        $data = new GetRequestData();
        $data->setCustomerId(995443);
        $apiResponse = $customerService->getCustomers($data);

        $this->assertInstanceOf(GetApiResponse::class, $apiResponse);
        /** @var GetResponse $response */
        $response = $apiResponse->getResponse();

        $expectedCustomer = new Customer();
        $expectedCustomer->setCustomerId(995443);
        $this->assertEquals(array($expectedCustomer), $response->getCustomers());
    }

    public function testCreateCustomer()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getServiceToTest();

        /** @var Customer $data */
        $data = new Customer();
        $data = $this->getCustomerForTesting($data);
        $apiResponse = $customerService->createCustomer($data);

        $this->assertInstanceOf(CreateApiResponse::class, $apiResponse);
        /** @var CreateResponse $response */
        $response = $apiResponse->getResponse();

        $expectedCreateResponse = new CreateResponse();
        $expectedCreateResponse->setStatus('success');
        $expectedCreateResponse->setCustomerId(998898);
        $expectedCreateResponse->setHash('a88a4e7e2024e308cbecbee931b1d40a');
        $expectedCreateResponse->setDashboardUrl('https://test.com/dashboard');
        $expectedCreateResponse->setChangeDataUrl('https://test.com/change-data');
        $this->assertEquals($expectedCreateResponse, $response);
    }

    public function testUpdateCustomer()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getServiceToTest();

        /** @var UpdateRequestData $data */
        $object = new UpdateRequestData(995443);
        $data = $this->getCustomerForTesting($object);
        $apiResponse = $customerService->updateCustomer($data);

        $this->assertInstanceOf(UpdateApiResponse::class, $apiResponse);
        /** @var UpdateResponse $response */
        $response = $apiResponse->getResponse();

        $expectedUpdateResponse = new UpdateResponse();
        $expectedUpdateResponse->setStatus('success');
        $expectedUpdateResponse->setCustomerId(998898);
        $this->assertEquals($expectedUpdateResponse, $response);
    }

    public function testDeleteCustomer()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getServiceToTest();

        $apiResponse = $customerService->deleteCustomer('996423');
        $this->assertInstanceOf(DeleteApiResponse::class, $apiResponse);

        /** @var DeleteResponse $response */
        $response = $apiResponse->getResponse();

        $expectedDeleteResponse = new DeleteResponse();
        $expectedDeleteResponse->setStatus(DeleteResponse::STATUS_SUCCESS);
        $this->assertEquals($expectedDeleteResponse, $response);
    }

    public function testAddCredits()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getServiceToTest();

        $apiResponse = $customerService->addCredits(995434, 1.5);
        $this->assertInstanceOf(AddCreditsApiResponse::class, $apiResponse);

        /** @var AddCreditsResponse $response */
        $response = $apiResponse->getResponse();
        // There is no response from the Fastbill API.
        $this->assertNull($response);
    }

    public function testCreateSecureLink()
    {
        /** @var CustomerService $customerService */
        $customerService = $this->getServiceToTest();

        $apiResponse = $customerService->createSecureLink('996423');
        $this->assertInstanceOf(CreateSecureLinkApiResponse::class, $apiResponse);

        /** @var CreateSecureLinkResponse $response */
        $response = $apiResponse->getResponse();

        $expectedCreateSecureLinkResponse = new CreateSecureLinkResponse();
        $expectedCreateSecureLinkResponse
            ->setDashboardUrl('https://create-secure-link.test.com/dashboard')
            ->setAccountDataUrl('https://create-secure-link.test.com/account');
        $this->assertEquals($expectedCreateSecureLinkResponse, $response);
    }

    /**
     * Get a customer model with data for testing.
     *
     * @param mixed $customer The class of the object to instantiate.
     * @return object
     */
    private function getCustomerForTesting($customer)
    {
        /** @var CustomerTrait $customer */
        $customer->setCustomerId(995443)
            ->setCustomerNumber(16)
            ->setDaysForPayment(14)
            ->setCustomerExternalUid(333)
            ->setCreated(new \DateTime("2015-10-23 12:17:13"))
            ->setLastUpdate(new \DateTime('2015-10-24 13:18:14'))
            ->setFirstName('Testing')
            ->setLastName('Tester')
            ->setTitleAcademic('Prof.')
            ->setSalutation('Salut')
            ->setBirthday(new \DateTime('1983-04-27'))
            ->setCustomerType(Customer::CUSTOMER_TYPE_BUSINESS)
            ->setOrganization('Test 11')
            ->setPaymentType(Customer::CUSTOMER_PAYMENT_TYPE_TRANSFER)
            ->setAffiliate('together')
            ->setBankAccountMandateReferenceDate(new \DateTime('2015-11-06 00:15:00'))
            ->setTaxId('tax_id')
            ->setVatId('vat_id')
            ->setBankName('Banky')
            ->setBankCode('BKY')
            ->setBankIBAN('WBKY123456')
            ->setBankBIC('WBKY')
            ->setBankAccountOwnerAddress('Bank owner address')
            ->setBankAccountOwnerCity('Bank owner city')
            ->setBankAccountOwnerZipCode('Bank owner zip')
            ->setBankAccountOwnerEmail('Bank owner email')
            ->setBankAccountMandateReference('man_ref')
            ->setShowPaymentNotice(false)
            ->setPaymentMailAddress('pay address')
            ->setAddress('Spaldingstrasse 210')
            ->setAddress2('Et.4')
            ->setSecondaryAddress('Second address')
            ->setCountryCode('DE')
            ->setZipCode('20097')
            ->setState('State')
            ->setCity('Hamburg')
            ->setPhone('phone')
            ->setFax('fax')
            ->setNewsletterOptIn(false)
            ->setHash('8f2cb48d081fa6e01a7a06714008f734')
            ->setBankAccountOwner('World')
            ->setBankAccountNumber('123456')
            ->setCurrencyCode('EUR')
            ->setLanguageCode('de')
            ->setEmail('test@test.com')
            ->setEmailCC('test_cc@test.com')
            ->setCreditBalance('1,00')
            ->setInvoiceDeliveryMethod(Customer::INVOICE_DELIVERY_METHOD_MAIL)
            ->setComment('are you talking to me?')
            ->setTags(array('tag1', 'tag2'));

        return $customer;
    }

    /**
     * {@inheritdoc}
     */
    protected function getClassUnderTest()
    {
        return CustomerService::class;
    }
}
