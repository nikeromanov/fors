<?





use AmoCRM\Collections\ContactsCollection;
use AmoCRM\Collections\CustomFieldsValuesCollection;
use AmoCRM\Collections\Leads\LeadsCollection;
use AmoCRM\Collections\TagsCollection;
use AmoCRM\Exceptions\AmoCRMApiException;
use AmoCRM\Models\CompanyModel;
use AmoCRM\Models\ContactModel;
use AmoCRM\Models\CustomFieldsValues\MultitextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\TextCustomFieldValuesModel;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\TextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueCollections\MultitextCustomFieldValueCollection;
use AmoCRM\Models\CustomFieldsValues\ValueModels\MultitextCustomFieldValueModel;
use AmoCRM\Models\CustomFieldsValues\ValueModels\TextCustomFieldValueModel;

use AmoCRM\Models\LeadModel;
use AmoCRM\Models\TagModel;
use AmoCRM\Models\Unsorted\FormsMetadata;
use League\OAuth2\Client\Token\AccessTokenInterface;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_REQUEST["action"]="addform"&&$_REQUEST["phone"]){
	CModule::IncludeModule('iblock'); 

	$nameForm = "Записаться на курс";
	$el = new CIBlockElement;
	$PROP=array();
        $PROP["PHONE"] = $_REQUEST["phone"];
        $PROP["NAME"] = $_REQUEST["name"];
        $PROP["EMAIL"] = $_REQUEST["email"];
        $PROP["URL"] = $_REQUEST["url"];
        if(!empty($_REQUEST["policy"])){
                $PROP["POLICY"] = "Y";
        }
        if($_REQUEST["service"]){
                $nameForm = $_REQUEST["service"];
        }
	if (!empty($_FILES['file']['tmp_name'])) {
		$PROP["FILE"] = $_FILES['file'];
	}
	$arLoadProductArray = Array(
	  "IBLOCK_SECTION_ID" => false,         
	  "IBLOCK_ID"      => 12,
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"=>$nameForm,
	  "DETAIL_TEXT"=>$_REQUEST["message"]
	);
	if($PRODUCT_ID = $el->Add($arLoadProductArray)){
		$externalData = [
                    [
                        'is_new' => true,
                        'price' => 0,
                        'name' => $nameForm ,
                        'contact' => [
                            'first_name' => ($PROP["NAME"]) ? $PROP["NAME"] :"Не указано имя",
                            'last_name' => '',
                            'phone' => $PROP["PHONE"],
                        ],
                        //        'company' => [
                        //            'name' => 'Qwerty LLC',
                        //        ],
                        'tag' => 'Новый клиент',
                        'external_id' => $PRODUCT_ID,
                    ],

                ];

                include_once($_SERVER["DOCUMENT_ROOT"] . "/local/amocrm/amocrm.php");



                $leadsCollection = new LeadsCollection();

//Создадим модели и заполним ими коллекцию
                foreach ($externalData as $externalLead) {
                    $lead = (new LeadModel())
						->setPipelineId(3756967)
						->setStatusId(36357457)
                        ->setName($externalLead['name'])
                        ->setPrice($externalLead['price'])
                        ->setTags(
                            (new TagsCollection())
                                ->add(
                                    (new TagModel())
                                        ->setName($externalLead['tag'])
                                )
                        )
                        ->setContacts(
                            (new ContactsCollection())
                                ->add(
                                    (new ContactModel())
                                        ->setFirstName($externalLead['contact']['first_name'])
                                        ->setLastName($externalLead['contact']['last_name'])
                                        ->setCustomFieldsValues(
                                            (new CustomFieldsValuesCollection())
                                                ->add(
                                                    (new MultitextCustomFieldValuesModel())
                                                        ->setFieldCode('PHONE')
                                                        ->setValues(
                                                            (new MultitextCustomFieldValueCollection())
                                                                ->add(
                                                                    (new MultitextCustomFieldValueModel())
                                                                        ->setValue($externalLead['contact']['phone'])
                                                                )
                                                        )
                                                )
                                        )
                                )
                        )
//        ->setCompany(
//            (new CompanyModel())
//                ->setName($externalLead['company']['name'])
//        )
                        ->setRequestId($externalLead['external_id']);
						
						if($_COOKIE["utm_source"]||$_COOKIE["utm_medium"]||$_COOKIE["utm_campaign"]||$_COOKIE["utm_content"]||$_COOKIE["utm_term"]){
							$leadCustomFieldsValues = new CustomFieldsValuesCollection();
							
							$lead->setCustomFieldsValues($leadCustomFieldsValues);
							
								if($_COOKIE["utm_source"]){
									$textCustomFieldValuesModel = new TextCustomFieldValuesModel();
									$textCustomFieldValuesModel->setFieldId(774865);
									$textCustomFieldValuesModel->setValues(
										(new TextCustomFieldValueCollection())
											->add((new TextCustomFieldValueModel())->setValue($_COOKIE["utm_source"]))
									);
									$leadCustomFieldsValues->add($textCustomFieldValuesModel);
								}
								if($_COOKIE["utm_medium"]){
									$textCustomFieldValuesModel = new TextCustomFieldValuesModel();
									$textCustomFieldValuesModel->setFieldId(774867);
									$textCustomFieldValuesModel->setValues(
										(new TextCustomFieldValueCollection())
											->add((new TextCustomFieldValueModel())->setValue($_COOKIE["utm_medium"]))
									);
									$leadCustomFieldsValues->add($textCustomFieldValuesModel);
								}
								if($_COOKIE["utm_campaign"]){
									$textCustomFieldValuesModel = new TextCustomFieldValuesModel();
									$textCustomFieldValuesModel->setFieldId(774869);
									$textCustomFieldValuesModel->setValues(
										(new TextCustomFieldValueCollection())
											->add((new TextCustomFieldValueModel())->setValue($_COOKIE["utm_campaign"]))
									);
									$leadCustomFieldsValues->add($textCustomFieldValuesModel);
								}
								if($_COOKIE["utm_term"]){
									$textCustomFieldValuesModel = new TextCustomFieldValuesModel();
									$textCustomFieldValuesModel->setFieldId(774871);
									$textCustomFieldValuesModel->setValues(
										(new TextCustomFieldValueCollection())
											->add((new TextCustomFieldValueModel())->setValue($_COOKIE["utm_term"]))
									);
									$leadCustomFieldsValues->add($textCustomFieldValuesModel);
								}
								if($_COOKIE["utm_content"]){
									$textCustomFieldValuesModel = new TextCustomFieldValuesModel();
									$textCustomFieldValuesModel->setFieldId(774873);
									$textCustomFieldValuesModel->setValues(
										(new TextCustomFieldValueCollection())
											->add((new TextCustomFieldValueModel())->setValue($_COOKIE["utm_content"]))
									);
									$leadCustomFieldsValues->add($textCustomFieldValuesModel);
								}
							
							$lead->setCustomFieldsValues($leadCustomFieldsValues);
						}
				
                    if ($externalLead['is_new']) {
                        $lead->setMetadata(
                            (new FormsMetadata())
                                ->setFormId('my_best_form')
                                ->setFormName('Обратная связь')
                                ->setFormPage('Форма на сайте')
                                ->setFormSentAt(mktime(date('h'), date('i'), date('s'), date('m'), date('d'), date('Y')))
                                ->setReferer($_SERVER["HTTP_REFERER"])
                                ->setIp($_SERVER["REMOTE_ADDR"])
                        );
                    }

                    $leadsCollection->add($lead);
                }


                try {
                    $addedLeadsCollection = $apiClient->leads()->addComplex($leadsCollection);
                } catch (AmoCRMApiException $e) {
                   echo json_encode(["result"=>"error","message"=>'Заявка отправилась, но произошли проблемы на стороне CRM']);
                }
			echo json_encode(["result"=>"success","message"=>'Спасибо, ваша заявка отправлена']);
		
	}else{
		echo json_encode(["result"=>"error","message"=>'<h3 style="color:red">'.$el->LAST_ERROR.'</h3>']);
		
	}
}

?>