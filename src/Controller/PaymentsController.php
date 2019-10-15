<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
/**
 * Payments Controller
 *
 * @property \App\Model\Table\PaymentsTable $Payments
 *
 * @method \App\Model\Entity\Payment[] paginate($object = null, array $settings = [])
 */
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

const MERCHANT_LOGIN_ID = "7qEm2H8j";
const MERCHANT_TRANSACTION_KEY = "6686Eg3p63TnUY86";
const RESPONSE_OK = "Ok";

class PaymentsController extends AppController {

    public function barcode($bookingId=null) {
        $this->autoRender = false;
        include(ROOT . DS . 'vendor' . DS . 'tcpdf' . DS . 'examples' . DS . 'example_027.php');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Nicola Asuni');
        $pdf->SetTitle('TCPDF Example 027');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->setPrintHeader(false);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // ---------------------------------------------------------

        $pdf->setFontSubsetting(true);
        // set font
        $pdf->SetFont('helvetica', '', 11, '', true);

        // add a page
        $pdf->AddPage();
        /* NOTE:
         * *********************************************************
         * You can load external XHTML using :
         *
         * $html = file_get_contents('/path/to/your/file.html');
         *
         * External CSS files will be automatically loaded.
         * Sometimes you need to fix the path of the external CSS.
         * *********************************************************
         */

        // define some HTML content with style
        $html = '
<!-- EXAMPLE OF CSS STYLE -->
<style> 
    table {border-collapse: collapse;}
    table td {padding: 0px}
</style>

<table style="position:absolute;bottom:100px; "><tr>
        <td style="width:120px;">
<img style="position:absolute;top:0.25in;left:0.23in;" src="http://minorities.news-gossips.com/OutDocument/logo.png" />
        </td>

        <td style="position:absolute;top:0.53in;left:1.73in;width:400px;line-height:0.24in; ">
        </td>

</tr>
</table>';
        $pdf->SetY(10);
        $pdf->writeHTML($html, true, false, true, false, '');
        //$txt = "You can also export 1D barcodes in other formats (PNG, SVG, HTML). Check the examples inside the barcodes directory.\n";
        //$pdf->MultiCell(150, 50, $txt, 0, 'J', false, 1, 125, 30, true, 0, false, true, 0, 'T', false);
        $html = '<p style="font-size:18px;color:black;"><b style="font-size:40px; color:black; font-family:Times New Roman, Times, serif ">Ticket Information</b></p>';

        $pdf->SetY(25);
        $pdf->SetX(60);
        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        $style = array(
            'position' => 'C',
            'align' => 'T',
            'stretch' => true,
            'fitwidth' => false,
            'cellfitalign' => '',
            'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'helvetica',
            'fontsize' => 20,
            'stretchtext' => 4,

        );

        $pdf->SetY(50);
        $this->loadModel('Bookings');
        $ticketDetail = $this->Bookings->get($bookingId, [
            'contain' => [
                'Routeterminals' => ['Routes' => ['Buses'], 'DepartureCities', 'ArrivalCities','ArrivalTerminals','DepartureTerminals']
            ],
            'conditions' => ['Bookings.id' => $bookingId]
        ]);

        $ticketNumber = $ticketDetail->booking_number;
        $dCity = $ticketDetail->routeterminal->departure_city->names;
        $aCity = $ticketDetail->routeterminal->arrival_city->names;
        $dTerminal = $ticketDetail->routeterminal->departure_terminal->name;
        $aTerminal = $ticketDetail->routeterminal->arrival_terminal->name;
        $dtime = date('h:i A', strtotime($ticketDetail->routeterminal->departure_time));
        $atime = date('h:i A', strtotime($ticketDetail->routeterminal->arrival_time));
        $bus = $ticketDetail->routeterminal->route->bus->bus_number;
        $amount = $ticketDetail->amount;
        $adults = $ticketDetail->adults;
        $children = $ticketDetail->children;

        $pdf->write1DBarcode($ticketNumber, 'EAN13', '', '', 100, 40, 0.8, $style, 'N');

        $html = '
                <style>
                table {
                  font-family: arial, sans-serif;
                  font-size: 18px;
                  border-collapse: collapse;
                }

                td, th {
                  border: 1px solid grey;
                  text-align: left;
                  padding: 30px;
                  display:inline;

                }

                tr:nth-child(odd) {
                  background-color: #dddddd;
                }
                </style>

                  <table border="0" cellpadding="20">
  <tr style="background-color: #dddddd;">
    <td>'.$dCity.' ('.$dTerminal.') - '.$aCity.' ('.$aTerminal.')</td>
    <td>'.$dtime.' – '.$atime.'</td>

  </tr>
  <tr>
    <td>Bus# ('.$bus.')</td>
    <td>'.$adults.' Adults, '.$children.' Children</td>

  </tr>

  <tr style="background-color: #dddddd;">
    <td colspan="2" style="text-align: right;">Paid Amount: $ '.$amount.'</td>

  </tr>

</table>

 ';


        $html .= ' ';

        $pdf->SetY(100);

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        // ---------------------------------------------------------
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
        //Close and output PDF document
        $fileName = $bookingId.'.pdf';
        //$location = '/bus/bustickets/webroot/customer_booking';
        $location = ROOT . DS . 'webroot' . DS . 'customer_booking' . DS .$fileName;

        $pdf->Output($location, 'F');

        //============================================================+
        // END OF FILE
        //============================================================+
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $this->viewBuilder()->setLayout('backend');
        $this->paginate = [
            'contain' => ['Users']
        ];
        $payments = $this->paginate($this->Payments);

        $this->set(compact('payments'));
        $this->set('_serialize', ['payments']);
    }

    /**
     * View method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $this->viewBuilder()->setLayout('backend');
        $payment = $this->Payments->get($id, [
            'contain' => ['Users', 'Bookings', 'SightseeingPayments', 'TourPayments']
        ]);

        $this->set('payment', $payment);
        $this->set('_serialize', ['payment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $this->viewBuilder()->setLayout('backend');
        $payment = $this->Payments->newEntity();
        if ($this->request->is('post')) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());

            if ($this->Payments->save($payment)) {
                //STORE LOGS
                $this->loadModel('Logs');

                $userId = $this->request->session()->read('Auth.User.id');
                $role = $this->request->session()->read('Auth.User.role_id');
                $activity = 'Payment Type Added';
                $paymentType = $this->request->data['payment_type'];

                if ($role == 1) {
                    $newRole = "Super Admin";
                } else if ($role == 2) {
                    $newRole = "Admin";
                } else if ($role == 3) {
                    $newRole = "Customer";
                }

                $note = 'Payment Type (' . $paymentType . ') stored by ' . $newRole;

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The payment has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            if ($payment->errors()) {
                $model_error = $payment->errors();
                if ($model_error['payment_type']['_isUnique'] != "") {
                    $this->Flash->error(__($model_error['payment_type']['_isUnique']));
                }
            } else {
                $this->Flash->error(__('The payment could not be saved. Please, try again.'));
            }
        }
        $users = $this->Payments->Users->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'users'));
        $this->set('_serialize', ['payment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->viewBuilder()->setLayout('backend');
        $payment = $this->Payments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payment = $this->Payments->patchEntity($payment, $this->request->getData());

            if ($this->Payments->save($payment)) {
                //STORE LOGS
                $this->loadModel('Logs');

                $userId = $this->request->session()->read('Auth.User.id');
                $role = $this->request->session()->read('Auth.User.role_id');
                $activity = 'Payment Type Updated';
                $paymentType = $this->request->data['payment_type'];

                if ($role == 1) {
                    $newRole = "Super Admin";
                } else if ($role == 2) {
                    $newRole = "Admin";
                } else if ($role == 3) {
                    $newRole = "Customer";
                }

                $note = 'Payment type (' . $paymentType . ') updated by ' . $newRole;

                $logs = $this->Logs->newEntity();
                $this->request->data['Log']['user_id'] = $userId;
                $this->request->data['Log']['activity'] = $activity;
                $this->request->data['Log']['note'] = $note;

                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                if ($this->Logs->save($logs)) {
                    $this->Flash->success(__('The payment has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->success(__('The payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment could not be saved. Please, try again.'));
        }
        $users = $this->Payments->Users->find('list', ['limit' => 200]);
        $this->set(compact('payment', 'users'));
        $this->set('_serialize', ['payment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete', 'get']);
        $payment = $this->Payments->get($id);
        if ($this->Payments->delete($payment)) {
            //STORE LOGS
            $this->loadModel('Logs');

            $userId = $this->request->session()->read('Auth.User.id');
            $role = $this->request->session()->read('Auth.User.role_id');
            $activity = 'Payment Type Deleted';
            $paymentType = $payment->payment_type;

            if ($role == 1) {
                $newRole = "Super Admin";
            } else if ($role == 2) {
                $newRole = "Admin";
            } else if ($role == 3) {
                $newRole = "Customer";
            }

            $note = 'Payment type (' . $paymentType . ') deleted by ' . $newRole;

            $logs = $this->Logs->newEntity();
            $this->request->data['Log']['user_id'] = $userId;
            $this->request->data['Log']['activity'] = $activity;
            $this->request->data['Log']['note'] = $note;

            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

            if ($this->Logs->save($logs)) {
                $this->Flash->success(__('The seat has been deleted.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->success(__('The payment has been deleted.'));
        } else {
            $this->Flash->error(__('The payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function barcode2($id=null) {
        $barcode=$_GET['value'];


        $this->set(compact('barcode'));





    }

    public function checkout() {

        if ($this->request->is('post') && $this->request->data['is_booking'] == 0) {

            /*
             * Code to check if same user have paid for the payment type withing 6 or 9 months
             * Will be moved to start test page with message of already payment done
             */

            $currentDateTime = date('Y-m-d H:i:s');


            $oneWayRouteId =  $this->request->data['one_way_route_id'];
            $oneWayRouteTerminalId =  $this->request->data['one_way_route_terminal_id'];
            $oneWayAmount =  $this->request->data['one_way_amount'];
            $oneWayDepartureTime =  $this->request->data['one_way_departure_time'];
            $oneWayBookingNumber =  $this->request->data['one_way_booking_number'];

            $departureDate = date('Y-m-d', strtotime($this->request->session()->read('departure_date')));
            $returnDate = $this->request->session()->read('return_date');
            $isTour = $this->request->session()->read('is_tour');
            $tourId = $this->request->session()->read('tour_id');

            $oneWayCheckinDateTime = $departureDate.' '.$oneWayDepartureTime;

            $oneWayTime1 = StrToTime ( $oneWayCheckinDateTime );
            $oneWayTime2 = StrToTime ( $currentDateTime );
            $diff = $oneWayTime1 - $oneWayTime2;
            $oneWayHours = round( $diff / ( 60 * 60 ) );
            if($oneWayHours < 24){
                $oneWayCheckIn = 1;
            } else {
                $oneWayCheckIn = 0;
            }

            $adults = $this->request->session()->read('adults');
            $children = $this->request->session()->read('children');

            if($children == ""){
                $childrenCount = 0;
            } else{
                $childrenCount = $children;
            }
            if($adults == ""){
                $adultCount = 0;
            } else{
                $adultCount = $adults;
            }

            $returnTotalAmount = 0;
            $totalAmount = 0;


            if($returnDate == null){
                $adultAmount = $oneWayAmount * $adultCount;
                $childrenAmount = $oneWayAmount * $childrenCount;
                $oneWayAmountTotal = $adultAmount + $childrenAmount; 
                $amount = $oneWayAmountTotal;
            } else if($returnDate != null){
                $roundRouteId =  $this->request->data['round_route_id'];
                $roundRouteTerminalId =  $this->request->data['round_route_terminal_id'];
                $roundAmount =  $this->request->data['round_amount'];
                $roundDepartureTime =  $this->request->data['round_departure_time'];
                $roundBookingNumber =  $this->request->data['round_booking_number'];

                $roundCheckinDateTime = date('Y-m-d', strtotime($returnDate)).' '.$roundDepartureTime;

                $roundTime1 = StrToTime ( $roundCheckinDateTime );
                $roundTime2 = StrToTime ( $currentDateTime );
                $diff = $roundTime1 - $roundTime2;
                $roundHours = round( $diff / ( 60 * 60 ) );
                if($roundHours < 24){
                    $roundCheckIn = 1;
                } else {
                    $roundCheckIn = 0;
                }

                $adultAmount = $oneWayAmount * $adultCount;
                $childrenAmount = $oneWayAmount * $childrenCount;
                $oneWayAmountTotal = $adultAmount + $childrenAmount;

                $returnAdultAmount = $roundAmount * $adultCount;
                $returnChildrenAmount = $roundAmount * $childrenCount;
                $returnAmountTotal = $returnAdultAmount + $returnChildrenAmount;

                $amount = $oneWayAmountTotal + $returnAmountTotal;
            }

            $userId = $this->request->session()->read('Auth.User.id');
            $this->loadModel('Users');
            $user = $this->Users->get($userId, [
                'contain' => []
            ]);



            $first_name = $this->request->data['first_name'];
            $last_name = $this->request->data['last_name'];
            $address1 = $user->address1;
            $address2 = $user->address2;
            $city = $user->city;
            $state = $user->state;
            $zip = $user->zip;

            $customerAddress = new AnetAPI\CustomerAddressType();
            $customerAddress->setFirstName($first_name);
            $customerAddress->setLastName($first_name);
            //$customerAddress->setCompany("Souveniropolis");
            $customerAddress->setAddress($address1);
            $customerAddress->setCity($city);
            $customerAddress->setState($state);
            $customerAddress->setZip($zip);
            $customerAddress->setCountry("USA");

            // Set the customer's identifying information
            $customerData = new AnetAPI\CustomerDataType();
            $customerData->setType("individual");
            $customerData->setId(rand() . "" . $userId . "0");
            $customerData->setEmail($this->request->data['email']);

            $payment_title = 'FlexBus';


            //$address = $this->request->session()->read('Auth.User.address1') ." ".$this->request->session()->read('Auth.User.address2');
            //$city = $this->request->session()->read('Auth.User.city');
            //$state = $this->request->session()->read('Auth.User.state');
            //$zip = $this->request->session()->read('Auth.User.zip');
            $cardno = $this->request->data['cardno'];
            $cardcvc = $this->request->data['cardcvc'];
            $cardmonth = $this->request->data['cardmonth']['month'];
            $cardyear = $this->request->data['cardyear']['year'];

            /* Create a merchantAuthenticationType object with authentication details
              retrieved from the constants file */
            $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
            $merchantAuthentication->setName(MERCHANT_LOGIN_ID);
            $merchantAuthentication->setTransactionKey(MERCHANT_TRANSACTION_KEY);
            // Set the transaction's refId
            $refId = 'ref' . time();
            // Create the payment data for a credit card
            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber($cardno);
            $creditCard->setExpirationDate($cardyear . "-" . $cardmonth);
            $creditCard->setCardCode($cardcvc);

            // Add the payment data to a paymentType object
            $paymentOne = new AnetAPI\PaymentType();
            $paymentOne->setCreditCard($creditCard);

            // Create order information
            $order = new AnetAPI\OrderType();
            $order->setInvoiceNumber(rand() . "" . $userId);
            $order->setDescription($payment_title);


            // Set the customer's Bill To address
            // Add values for transaction settings
            $duplicateWindowSetting = new AnetAPI\SettingType();
            $duplicateWindowSetting->setSettingName("duplicateWindow");
            $duplicateWindowSetting->setSettingValue("60");

            // Add some merchant defined fields. These fields won't be stored with the transaction,
            // but will be echoed back in the response.
            //    $merchantDefinedField1 = new AnetAPI\UserFieldType();
            //    $merchantDefinedField1->setName("customerLoyaltyNum");
            //    $merchantDefinedField1->setValue("1128836273");
            //    $merchantDefinedField2 = new AnetAPI\UserFieldType();
            //    $merchantDefinedField2->setName("favoriteColor");
            //    $merchantDefinedField2->setValue("blue");
            // Create a TransactionRequestType object and add the previous objects to it
            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType("authOnlyTransaction");
            $transactionRequestType->setAmount($amount);
            $transactionRequestType->setOrder($order);
            $transactionRequestType->setPayment($paymentOne);
            $transactionRequestType->setBillTo($customerAddress);
            $transactionRequestType->setCustomer($customerData);
            $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);

            //    $transactionRequestType->addToUserFields($merchantDefinedField1);
            //    $transactionRequestType->addToUserFields($merchantDefinedField2);
            // Assemble the complete transaction request
            $request = new AnetAPI\CreateTransactionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setRefId($refId);
            $request->setTransactionRequest($transactionRequestType);



            // Create the controller and get the response
            $controller = new AnetController\CreateTransactionController($request);

            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

            if ($response != null) {
                
                // Check to see if the API request was successfully received and acted upon
                if ($response->getMessages()->getResultCode() == RESPONSE_OK) {
                    // Since the API request was successful, look for a transaction response
                    // and parse it to display the results of authorizing the card
                    $tresponse = $response->getTransactionResponse();
                    //debug($tresponse);

                    if ($tresponse != null && $tresponse->getMessages() != null) {

                        $this->loadModel('Bookings');
                        $this->loadModel('Routes');

                        $booking = $this->Bookings->newEntity();

                        $this->request->data['Booking']['user_id'] = $userId;
                        $this->request->data['Booking']['routeterminal_id'] = $oneWayRouteTerminalId;
                        $this->request->data['Booking']['date_time'] = $departureDate . ' ' . $oneWayDepartureTime;

                        $this->request->data['Booking']['status'] = 1;
                        $this->request->data['Booking']['payment_id'] = 3;
                        $this->request->data['Booking']['transaction_id'] = $tresponse->getTransId();

                        $this->request->data['Booking']['transaction_status'] = $response->getMessages()->getResultCode();
                        $this->request->data['Booking']['amount'] = $oneWayAmountTotal;
                        $this->request->data['Booking']['adults'] = $adults;
                        $this->request->data['Booking']['children'] = $children;
                        $this->request->data['Booking']['booking_number'] = $oneWayBookingNumber;
                        $this->request->data['Booking']['checkin'] = $oneWayCheckIn;
                        $this->request->data['Booking']['is_tour'] = $isTour;
                        $this->request->data['Booking']['tour_id'] = $tourId;

                        $PaymentDetail = $this->Bookings->patchEntity($booking, $this->request->data['Booking']);

                        if ($result =  $this->Bookings->save($PaymentDetail)) {
                            $bookingId = $result->id;
                            //STORE LOGS
                            $this->loadModel('Logs');
                            $this->loadModel('Users');
                            $this->loadModel('Bookings');
                            $findRole = $this->Users->get($userId, [
                                'contain' => ['Roles']
                            ]);

                            $roleName = $findRole->role->name;

                            $ticketDetail = $this->Bookings->get($bookingId, [
                                'contain' => [
                                    'Routeterminals' => ['Routes' => ['Buses'], 'DepartureCities', 'ArrivalCities', 'ArrivalTerminals', 'DepartureTerminals']
                                ]
                            ]);

                            $ticketNumber = $ticketDetail->booking_number;
                            $dCity = $ticketDetail->routeterminal->departure_city->names;
                            $aCity = $ticketDetail->routeterminal->arrival_city->names;
                            $dTerminal = $ticketDetail->routeterminal->departure_terminal->name;
                            $aTerminal = $ticketDetail->routeterminal->arrival_terminal->name;
                            $dtime = date('h:i A', strtotime($ticketDetail->routeterminal->departure_time));
                            $atime = date('h:i A', strtotime($ticketDetail->routeterminal->arrival_time));
                            $bus = $ticketDetail->routeterminal->route->bus->bus_number;
                            $amount = $ticketDetail->amount;
                            $adults = $ticketDetail->adults;
                            $children = $ticketDetail->children;


                            $activity = 'One Side Booking';

                            $note = $roleName.' paid $'.$amount.' for ticket booking of ('.$adults.' Adults, '.$children.' Children) from '.$dCity.' ( '.$dTerminal.' ) to '.$aCity.' ('.$aTerminal.'), the time is ('.$dtime.' - '.$atime.'). The bus number is ('.$bus.').';

                            $superAdminNote = $note;

                            $logs = $this->Logs->newEntity();
                            $this->request->data['Log']['user_id'] = $userId;
                            $this->request->data['Log']['activity'] = $activity;
                            $this->request->data['Log']['note'] = $note;

                            $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                            if ($this->Logs->save($logs)) {

                            }


                        }

                        if ($returnDate != null) {

                            $roundDate = date('Y-m-d', strtotime($returnDate));                            
                            $booking = $this->Bookings->newEntity();

                            $rand1 = str_pad(rand(1, 9999999), 7, STR_PAD_LEFT);
                            $rand2 = str_pad(rand(1, 999999), 6, STR_PAD_LEFT);
                            $ticketNumber = $rand1.$rand2;

                            $this->request->data['Booking']['user_id'] = $userId;
                            $this->request->data['Booking']['routeterminal_id'] = $roundRouteTerminalId;
                            $this->request->data['Booking']['date_time'] = $roundDate . ' ' . $roundDepartureTime;

                            $this->request->data['Booking']['status'] = 1;
                            $this->request->data['Booking']['payment_id'] = 3;
                            $this->request->data['Booking']['transaction_id'] = $tresponse->getTransId();

                            $this->request->data['Booking']['transaction_status'] = $response->getMessages()->getResultCode();
                            $this->request->data['Booking']['amount'] = $returnAmountTotal;
                            $this->request->data['Booking']['adults'] = $adults;
                            $this->request->data['Booking']['children'] = $children;
                            $this->request->data['Booking']['booking_number'] = $roundBookingNumber;
                            $this->request->data['Booking']['checkin'] = $roundCheckIn;
                            $this->request->data['Booking']['is_tour'] = $isTour;
                            $this->request->data['Booking']['tour_id'] = $tourId;

                            $PaymentDetail = $this->Bookings->patchEntity($booking, $this->request->data['Booking']);

                            if ($returnResult = $this->Bookings->save($PaymentDetail)) {

                                $returnBookingId = $returnResult->id;
                                //STORE LOGS
                                $this->loadModel('Logs');
                                $this->loadModel('Users');
                                $this->loadModel('Bookings');
                                $findRole = $this->Users->get($userId, [
                                    'contain' => ['Roles']
                                ]);

                                $roleName = $findRole->role->name;

                                $ticketDetail = $this->Bookings->get($returnBookingId, [
                                    'contain' => [
                                        'Routeterminals' => ['Routes' => ['Buses'], 'DepartureCities', 'ArrivalCities', 'ArrivalTerminals', 'DepartureTerminals']
                                    ]
                                ]);

                                $ticketNumber = $ticketDetail->booking_number;
                                $dCity = $ticketDetail->routeterminal->departure_city->names;
                                $aCity = $ticketDetail->routeterminal->arrival_city->names;
                                $dTerminal = $ticketDetail->routeterminal->departure_terminal->name;
                                $aTerminal = $ticketDetail->routeterminal->arrival_terminal->name;
                                $dtime = date('h:i A', strtotime($ticketDetail->routeterminal->departure_time));
                                $atime = date('h:i A', strtotime($ticketDetail->routeterminal->arrival_time));
                                $bus = $ticketDetail->routeterminal->route->bus->bus_number;
                                $amount = $ticketDetail->amount;
                                $adults = $ticketDetail->adults;
                                $children = $ticketDetail->children;

                                $activity = 'Return Booking';

                                $returnNote = $roleName.' paid $'.$amount.' for ticket booking of ('.$adults.' Adults, '.$children.' Children) from '.$dCity.' ( '.$dTerminal.' ) to '.$aCity.' ('.$aTerminal.'), the time is ('.$dtime.' - '.$atime.'). The bus number is ('.$bus.').';

                                $logs = $this->Logs->newEntity();
                                $this->request->data['Log']['user_id'] = $userId;
                                $this->request->data['Log']['activity'] = $activity;
                                $this->request->data['Log']['note'] = $returnNote;

                                $logs = $this->Logs->patchEntity($logs, $this->request->data['Log']);

                                if ($this->Logs->save($logs)) {

                                }

                            }

                        }

                        $this->barcode($bookingId);
                        if($returnDate != null){
                            $this->barcode($returnBookingId);
                        }


                        $this->request->session()->delete("departure_city_id");
                        $this->request->session()->delete("departure_terminal_id");
                        $this->request->session()->delete("arrival_city_id");
                        $this->request->session()->delete("arrival_terminal_id");
                        $this->request->session()->delete("departure_date");
                        $this->request->session()->delete("return_date");
                        $this->request->session()->delete("adults");
                        $this->request->session()->delete("children");
                        $this->request->session()->delete("is_tour");
                        $this->request->session()->delete("tour_id");

                        return $this->redirect(['controller' => 'pages','action' => 'thankyou',$bookingId]);

                    } else {
                        echo "Transaction Failed \n";
                        if ($tresponse->getErrors() != null) {
                            $error_message = " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
                        }
                        $this->Flash->error(__("Transaction Failed \n " . $error_message));
                    }
                    // Or, print errors if the API request wasn't successful
                } else {
                    echo "Transaction Failed \n";
                    exit;
                    $tresponse = $response->getTransactionResponse();

                    if ($tresponse != null && $tresponse->getErrors() != null) {
                        $error_message = " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
                        $this->Flash->error(__("Transaction Failed \n " . $error_message));
                    } else {
                        $error_message = " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
                        $this->Flash->error(__("Transaction Failed \n " . $error_message));
                    }
                }
            } else {
                echo "No response returned \n";

                $this->Flash->error(__("Some error occured, try again later "));
            }
        }

        $returnDate = $this->request->session()->read('return_date');

        $oneWayRouteId = $this->request->data['one_way_route_id'];
        $oneWayRouteTerminalId = $this->request->data['one_way_route_terminal_id'];
        $oneWayAmount = $this->request->data['one_way_amount'];

        if($returnDate != null){
            $roundRouteId = $this->request->data['round_route_id'];
            $roundRouteTerminalId = $this->request->data['round_route_terminal_id'];
            $roundAmount = $this->request->data['round_amount'];
            $roundBookingNumber = $this->request->data['round_way_booking_number'];
        }
        /*
         * this query will find the route that has been searched by customer 
         */
        $this->loadModel('Routeterminals');
        $departureCityId = $this->request->session()->read('departure_city_id');
        $departureTerminalId = $this->request->session()->read('departure_terminal_id');
        $arrivalCityId = $this->request->session()->read('arrival_city_id');
        $arrivalTerminalId = $this->request->session()->read('arrival_terminal_id');


        $searchedRoute = $this->Routeterminals->find('all', [
            'contain' => ['DepartureCities', 'DepartureTerminals', 'ArrivalCities', 'ArrivalTerminals']
        ])->where([
            'Routeterminals.departure_city_id' => $departureCityId,
            'Routeterminals.arrival_city_id' => $arrivalCityId,
            'Routeterminals.departure_terminal_id' => $departureTerminalId,
            'Routeterminals.arrival_terminal_id' => $arrivalTerminalId,
            'Routeterminals.route_id' => $oneWayRouteId
        ])->first();

        /*
             * this query will find the round trip if return date is not empty 
             */

        if($returnDate != null){
            $returnRoute = $this->Routeterminals->find('all', [
                'contain' => ['Routes', 'DepartureCities', 'DepartureTerminals', 'ArrivalCities', 'ArrivalTerminals']
            ])->where([
                'Routeterminals.departure_city_id' => $arrivalCityId,
                'Routeterminals.arrival_city_id' => $departureCityId,
                'Routeterminals.departure_terminal_id' => $arrivalTerminalId,
                'Routeterminals.arrival_terminal_id' => $departureTerminalId,
                'Routeterminals.route_id' => $roundRouteId
            ])->first();


            $this->set(compact('returnRoute'));
            $this->set('roundRouteId', $roundRouteId);
            $this->set('roundRouteTerminalId', $roundRouteTerminalId);
            $this->set('roundAmount', $roundAmount);
            $this->set('roundBookingNumber', $roundBookingNumber);
        }


        $this->set('searchedRoute', $searchedRoute);
        $this->set('oneWayRouteId', $oneWayRouteId);
        $this->set('oneWayRouteTerminalId', $oneWayRouteTerminalId);
        $this->set('oneWayAmount', $oneWayAmount);

        $this->viewBuilder()->setLayout('frontend');
    }

}
