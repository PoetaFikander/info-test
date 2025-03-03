<?php

namespace App\Http\Controllers\Modals;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Reports\Agreement;
use App\Models\Reports\AltumUniversal;
use App\Models\Reports\Article;
use App\Models\Reports\Customer;
use App\Models\Reports\Device;
use App\Models\Reports\Document;
use App\Models\Reports\Technician;
use App\Models\Reports\WorkCard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ModalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ------------------------------------------------------------------------------
     * ---------------- methods called by AJAX --------------------------------------
     */

    public function getModalBlade(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = match ($input['modalName']) {
            'native-document' => view('modals.documents.native-document')->render(),
            'agreement' => view('modals.documents.agreement')->render(),
            'device' => view('modals.device.device')->render(),
            'work-card' => view('modals.documents.work-card')->render(),
            // ----
            'update-rate' => view('modals.updates.rate')->render(),
            'update-select' => view('modals.updates.select')->render(),
            'update-text' => view('modals.updates.text')->render(),
            'update-date' => view('modals.updates.date')->render(),
            'update-textarea' => view('modals.updates.textarea')->render(),
            // ----
            default => view('modals.default')->render(),
        };
        return response()->json($result, 200);
    }

    public function getModalData(Request $request): JsonResponse
    {
        $input = $request->all();
        $result = match ($input['modalName']) {
            'native-document' => self::getNativeDocumentData($input),
            'agreement' => self::getAgreementData($input),
            'device' => self::getDeviceData($input),
            'work-card' => self::getWorkCardData($input),
            // ----
            'update-rate' => self::getUpdateRateData($input),
            'update-text', 'update-date', 'update-select', 'update-textarea' => self::getUpdateData($input),
            default => $input,
        };
        return response()->json($result, 200);
    }

    /*
     * ----------------------------------------------------------------------------------------------------
     * ------------------------- helpers ----------------------------
     */
    static function getUpdateData(array $input): array
    {
        function getTechnicians(): array
        {
            $technicians = Technician::getTechnicians([])['technicians'];
            $result = [];
            foreach ($technicians as $technician) {
                $result[] = ['id' => $technician->technician_id, 'txt' => $technician->employee_name_surname];
            }
            return $result;
        }

        function getEmployees(): array
        {
            $employees = AltumUniversal::getAltumEmployees();
            $result = [];
            foreach ($employees as $employee) {
                $result[] = ['id' => $employee->id, 'txt' => $employee->name_surname];
            }
            return $result;
        }

        function getContacts(int $customerId): array
        {
            $contacts = AltumUniversal::getAltumContacts(['cust_id' => $customerId])['contacts'];
            $result = [];
            foreach ($contacts as $contact) {
                $result[] = ['id' => $contact->id, 'txt' => $contact->name_surname];
            }
            return $result;
        }

        function getAddresses(int $customerId): array
        {
            $addresses = Customer::getCustomerAddresses(['cust_id' => $customerId])['addresses'];
            $result = [];
            foreach ($addresses as $address) {
                $default = ((int)$address->cust_addr_is_default === 1) ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;===>&nbsp;&nbsp;(domyślny)" : '';
                $txt = $address->cust_addr_type_name . ':';
                for ($i = 0; $i < (18 - strlen($address->cust_addr_type_name)); $i++) {
                    $txt .= "&nbsp;";
                }
                $txt .= $address->cust_address . $default;
                $result[] = ['id' => $address->cust_addr_data_id, 'txt' => $txt];
            }
            return $result;
        }

        function getDepartments(): array
        {
            $departments = Department::all();
            $result = [];
            //dump($departments);
            foreach ($departments as $department) {
                $result[] = ['id' => $department->altum_id, 'txt' => $department->acronym];
            }
            return $result;
        }

        function getArticles(): array
        {
            // ---- tylko usługi które nie są licznikami
            $articles = Article::getArticles(['art_type_id' => 2, 'art_attr_is_counter' => 0])['articles'];
            $result = [];
            foreach ($articles as $article) {
                $result[] = ['id' => $article->art_id, 'txt' => $article->art_code];
            }
            return $result;
        }

        function getYesNo(): array
        {
            return [
                ['id' => 1, 'txt' => 'Tak'],
                ['id' => 2, 'txt' => 'Nie'],
            ];
        }

        function getDict($name): array
        {
            $dictionary = AltumUniversal::getAltumDictionary(['dictionary_name' => $name])['dictionary'];
            $result = [];
            foreach ($dictionary as $value) {
                $result[] = ['id' => $value->value_id, 'txt' => $value->value_txt, 'default' => $value->value_is_default];
            }
            return $result;
        }

        function getDeviceModels(): array
        {
            $models = Device::getDeviceModels([])['models'];
            $result = [];
            foreach ($models as $model) {
                $result[] = ['id' => $model->dev_model_id, 'txt' => $model->dev_model_name];
            }
            return $result;
        }

        $customerId = isset($input['currentData']['dev_cust_id']) ? (int)$input['currentData']['dev_cust_id'] : 0;

        $result = match ($input['updateData']['columnName']) {
            // ---- ai
            'ai_dks_tech_person_txt' => getTechnicians(),
            'ai_dks_person_txt' => getEmployees(),
            'ai_service_company_unit_txt' => getDepartments(),
            'ai_extra_value_service_txt' => getArticles(),
            'ai_client_person_txt', 'ai_client_person_pickup_txt' => getContacts($customerId),
            'ai_billing_if_no_counter_txt' => getYesNo(),
            'ai_installation_status_txt' => getDict('Status instalacji urządzenia'),
            'ai_counters_check_type_txt' => getDict('Sposób odczytu liczników'),
            'ai_replacement_parts_kind_txt' => getDict('Części zamienne'),
            'ai_installation_address', 'ai_toner_address' => getAddresses($customerId),
            // ---- device
            'dev_model_name' => getDeviceModels(),
            default => [],
        };

        return [
            'result' => $result,
            '$input' => $input,
        ];
    }

    static function getUpdateRateData(array $input): array
    {
        $result = [];
        $result['companyUnits'] = AltumUniversal::getAltumCompanyUnits();
        $result['rates'] = [];
        $aiId = (int)$input['ai']['ai_id'];
        $rates = Agreement::getAgreementItemRates(['ai_id' => $aiId])['itemRates'];
        foreach ($rates as $rate) {
            $result['rates'][$rate->rate_id] = $rate;
        }
        // ---- tylko usługi które nie są licznikami
        $articles = Article::getArticles(['art_type_id' => 2, 'art_attr_is_counter' => 0])['articles'];
        $art = [];
        foreach ($articles as $article) {
            $art[] = ['id' => $article->art_id, 'txt' => $article->art_code];
        }
        return [
            'result' => $result,
            'art' => $art,
            '$input' => $input,
        ];
    }

    static function getNativeDocumentData(array $input): array
    {
        $header = Document::getDocumentHeader($input)['header'];
        $header = count($header) ? $header[0] : $header;
        return [
            'header' => $header,
            'items' => Document::getDocumentItems($input)['items'],
        ];
    }

    static function getAgreementData(array $input): array
    {
        $header = Agreement::getAgreementHeader($input)['header'];
        $header = count($header) ? $header[0] : $header;
        $itemParams = Agreement::getAgreementItemParametersDefault($input)['itemParams'];
        $itemParams = count($itemParams) ? $itemParams[0] : $itemParams;
        $itemRates = Agreement::getAgreementItemRatesDefault($input)['itemRates'];
        $items = Agreement::getAgreementItems($input)['items'];
        $invoices = Agreement::getAgreementInvoices($input)['invoices'];
        $history = Agreement::getAgreementHistory($input)['history'];
        return [
            'header' => $header,
            'itemParams' => $itemParams,
            'itemRates' => $itemRates,
            'items' => $items,
            'invoices' => $invoices,
            'history' => $history,
        ];

    }

    static function getDeviceData(array $input): array
    {
        $device = Device::getDevice($input)['device'];
        $device = count($device) ? $device[0] : $device;
        $counters = Device::getDeviceCounters($input)['counters'];
        $workCards = Device::getDeviceWorkCards($input)['wc'];
        // ----  dane aktywnej umowy
        $agrId = (int)$device->current_agr_id ?? 0;
        $input['agr_id'] = $agrId;
        $input['ai_id'] = (int)$device->current_ai_id ?? 0;
        // ----
        $agrHeader = [];
        $itemRates = [];
        // ----
        if ($agrId > 0) {
            $agrHeader = Agreement::getAgreementHeader($input)['header'][0];
            $itemRates = Agreement::getAgreementItemRates($input)['itemRates'];
        }
        // ----
        return [
            'device' => $device,
            'counters' => $counters,
            'workCards' => $workCards,
            'agrHeader' => $agrHeader,
            'itemRates' => $itemRates,
            'input' => $input,
        ];

    }

    static function getWorkCardData(array $input): array
    {
        $header = WorkCard::getWorkCardHeader($input)['header'];
        $header = count($header) ? (array)$header[0] : [];
        $history = [];
        $actions = [];
        $materials = [];
        $services = [];
        $documents = [];
        $agrCurrent = [];
        $agrItem = [];
        if (isset($header['dev_id'])) {
            $input['dev_id'] = (int)$header['dev_id'];
            $input['date_from'] = $header['sh_register_date'];
            $input['date_to'] = $header['sh_register_date'];
            // ---- todo
            //$history = Device::getDeviceHistory($input)['history'];
            //$history = count($history) ? (array)$history[0] : [];
            //if (isset($history['agr_id'])) {
            //    $input['agr_id'] = (int)$history['agr_id'];
            //}
            // ----
            $actions = WorkCard::getWorkCardActions($input)['actions'];
            $materials = WorkCard::getWorkCardMaterials($input)['materials'];
            $services = WorkCard::getWorkCardServices($input)['services'];
            $documents = WorkCard::getWorkCardDocuments($input)['documents'];
            $agrCurrent = Device::getDeviceAgreementCurrent($input)['agrCurrent'];
            $agrCurrent = count($agrCurrent) ? (array)$agrCurrent[0] : [];
            if (isset($agrCurrent['ai_id'])) {
                $agrItemAddresses = Agreement::getAgreementItemAddresses(['ai_id' => (int)$agrCurrent['ai_id']])['itemAddresses'][0];
                $agdItemBasic =  Agreement::getAgreementItemBasic(['ai_id' => (int)$agrCurrent['ai_id']])['itemBasic'][0];
                $agrItem = array_merge((array)$agrItemAddresses, (array)$agdItemBasic);
            }
        }
        return [
            'header' => $header,
            'history' => $history,
            'actions' => $actions,
            'materials' => $materials,
            'services' => $services,
            'documents' => $documents,
            '$input' => $input,
            'agrCurrent' => $agrCurrent,
            'agrItem' => $agrItem,
        ];
    }

}
