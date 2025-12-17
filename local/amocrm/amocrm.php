<?php

define('DOCUMENT_ROOT', $_SERVER["DOCUMENT_ROOT"]);
require(DOCUMENT_ROOT . "/bitrix/modules/main/include/prolog_before.php");


$clientId     = '22286323-54b3-458b-8105-c10eddad182d';
$clientSecret = 'h7WUyulM0vYmEJXG1yPUa9v6IYzyXUzsEALGeYxeM42BFKxRCV0z0ROjl7DWNb2k';
$redirectUri  = 'https://www.fors36.ru/local/amocrm/index.php';

$apiClient = new \AmoCRM\Client\AmoCRMApiClient($clientId, $clientSecret, $redirectUri);

include_once __DIR__ . '/token_actions.php';
include_once __DIR__ . '/error_printer.php';



use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Collections\Leads\LeadsCollection;
use AmoCRM\Collections\TagsCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Models\CompanyModel;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use AmoCRM\Models\LeadModel;
use AmoCRM\Models\TagModel;
use AmoCRM\Models\Unsorted\FormsMetadata;
use League\OAuth2\Client\Token\AccessTokenInterface;


$accessToken = getToken();

$apiClient->setAccessToken($accessToken)
    ->setAccountBaseDomain($accessToken->getValues()['baseDomain'])
    ->onAccessTokenRefresh(
        function (AccessTokenInterface $accessToken, string $baseDomain) {
            saveToken(
                [
                    'accessToken' => $accessToken->getToken(),
                    'refreshToken' => $accessToken->getRefreshToken(),
                    'expires' => $accessToken->getExpires(),
                    'baseDomain' => $baseDomain,
                ]
            );
        }
    );

//Представим, что у нас есть данные, полученные из сторонней системы
//$externalData = [
//    [
//        'is_new' => true,
//        'price' => 0,
//        'name' => 'Lead name',
//        'contact' => [
//            'first_name' => 'Ivan',
//            'last_name' => 'Zinoviev',
//            'phone' => '+79129876543',
//        ],
////        'company' => [
////            'name' => 'Qwerty LLC',
////        ],
//        'tag' => 'Новый клиент',
//        'external_id' => '0752a617-c834-4bde-b4a6-76ff0fe268711',
//    ],
//
//];

//$leadsCollection = new LeadsCollection();
//
////Создадим модели и заполним ими коллекцию
//foreach ($externalData as $externalLead) {
//    $lead = (new LeadModel())
//        ->setName($externalLead['name'])
//        ->setPrice($externalLead['price'])
//        ->setTags(
//            (new TagsCollection())
//                ->add(
//                    (new TagModel())
//                        ->setName($externalLead['tag'])
//                )
//        )
//        ->setContacts(
//            (new ContactsCollection())
//                ->add(
//                    (new ContactModel())
//                        ->setFirstName($externalLead['contact']['first_name'])
//                        ->setLastName($externalLead['contact']['last_name'])
//                        ->setCustomFieldsValues(
//                            (new CustomFieldsValuesCollection())
//                                ->add(
//                                    (new MultitextCustomFieldValuesModel())
//                                        ->setFieldCode('PHONE')
//                                        ->setValues(
//                                            (new MultitextCustomFieldValueCollection())
//                                                ->add(
//                                                    (new MultitextCustomFieldValueModel())
//                                                        ->setValue($externalLead['contact']['phone'])
//                                                )
//                                        )
//                                )
//                        )
//                )
//        )
////        ->setCompany(
////            (new CompanyModel())
////                ->setName($externalLead['company']['name'])
////        )
//        ->setRequestId($externalLead['external_id']);
//
//    if ($externalLead['is_new']) {
//        $lead->setMetadata(
//            (new FormsMetadata())
//                ->setFormId('my_best_form')
//                ->setFormName('Обратная связь')
//                ->setFormPage('https://example.com/form')
//                ->setFormSentAt(mktime(date('h'), date('i'), date('s'), date('m'), date('d'), date('Y')))
//                ->setReferer('https://google.com/search')
//                ->setIp('192.168.0.1')
//        );
//    }
//
//    $leadsCollection->add($lead);
//}
//
////Создадим сделки
//try {
//    $addedLeadsCollection = $apiClient->leads()->addComplex($leadsCollection);
//} catch (AmoCRMApiException $e) {
//    printError($e);
//    die;
//}
//
///** @var LeadModel $addedLead */
//foreach ($addedLeadsCollection as $addedLead) {
//    //Пройдемся по добавленным сделкам и выведем результат
//    $leadId = $addedLead->getId();
//    $contactId = $addedLead->getContacts()->first()->getId();
//    $companyId = $addedLead->getCompany()->getId();
//
//    $externalRequestIds = $addedLead->getComplexRequestIds();
//    foreach ($externalRequestIds as $requestId) {
//        $action = $addedLead->isMerged() ? 'обновлены' : 'созданы';
//        $separator = PHP_SAPI === 'cli' ? PHP_EOL : "<br>";
//        echo "Для сущности с ID {$requestId} были {$action}: сделка ({$leadId}), контакт ({$contactId}), компания ({$companyId})" . $separator;
//    }
//}
//




/*
session_start();

if (isset($_GET['referer'])) {
    $apiClient->setAccountBaseDomain($_GET['referer']);
}


if (!isset($_GET['code'])) {
    $state = bin2hex(random_bytes(16));
    $_SESSION['oauth2state'] = $state;
    if (isset($_GET['button'])) {
        echo $apiClient->getOAuthClient()->getOAuthButton(
            [
                'title' => 'Установить интеграцию',
                'compact' => true,
                'class_name' => 'className',
                'color' => 'default',
                'error_callback' => 'handleOauthError',
                'state' => $state,
            ]
        );
        die;
    } else {
        $authorizationUrl = $apiClient->getOAuthClient()->getAuthorizeUrl([
            'state' => $state,
            'mode' => 'post_message',
        ]);
        header('Location: ' . $authorizationUrl);
        die;
    }
} elseif (empty($_GET['state']) || empty($_SESSION['oauth2state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
}

/**
 * Ловим обратный код
 * /
try {
    $accessToken = $apiClient->getOAuthClient()->getAccessTokenByCode($_GET['code']);

    if (!$accessToken->hasExpired()) {
        saveToken([
            'accessToken' => $accessToken->getToken(),
            'refreshToken' => $accessToken->getRefreshToken(),
            'expires' => $accessToken->getExpires(),
            'baseDomain' => $apiClient->getAccountBaseDomain(),
        ]);
    }
} catch (Exception $e) {
    die((string)$e);
}

$ownerDetails = $apiClient->getOAuthClient()->getResourceOwner($accessToken);

printf('Hello, %s!', $ownerDetails->getName());
*/