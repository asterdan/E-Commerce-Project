<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\WebProfile;
use PayPal\Api\InputFields;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use App\Order;
use App\ShippingAddress;
use App\OrderDetails;

class PaymentController extends Controller
{
    //
    public function create(Request $request)
    {

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AVf8B4xcjR0Ur3RmvWYheudIG9hL78MvB8CSdKfsFTObFF61z09uNZmkvyMMswYN4WsHsE5dBrDQSsHA',     // ClientID
            'EKMVbVbjNerUzmoBUMu-fYN4jrQuF92w4viuwujH_9YDQYmN454c4q9BJJ0rJSMvSYtEch4ijNg1tlUx'     // ClientSecret
            )
        );

        $product_id = $request->input('product_id');
        $product_name = $request->input('product_name');
        $product_price = $request->input('product_price');
        $user_id = $request->input('user_id');


        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item1 = new Item();
        $item1->setName($product_name)
              ->setCurrency('USD')
              ->setQuantity(1)
              ->setSku('123123')
              ->setPrice($product_price);
        $itemList = new ItemList();
        $itemList->addItem($item1);

        $details = new Details();
        $details->setShipping(1.2)
                ->setTax(1.3)
                ->setSubtotal($product_price);
        $total = $product_price + 1.2 + 1.3;
        $amount = new Amount();
        $amount->setCurrency('USD')
               ->setTotal($total)
               ->setDetails($details);
               
        $transaction = new Transaction();
        $transaction->setAmount($amount)
                    ->setItemList($itemList)
                    ->setDescription('Payment description')
                    ->setInvoiceNumber(uniqid());
        
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("http://localhost:8000/execute-payment/".$product_id."/".$user_id)
                     ->setCancelUrl("http://localhost:8000/");  
                     
                     
                     $payment = new Payment();
                     $payment->setIntent("sale")
                         ->setPayer($payer)
                         ->setRedirectUrls($redirectUrls)
                         ->setTransactions(array($transaction));

                         try {
                            $payment->create($apiContext);
                        } catch (PayPal\Exception\PayPalConnectionException $ex) {
                            echo $ex;
                            exit(1);
                        }
                        return  redirect($payment->getApprovalLink());
        




    }


    public function execute(Request $request)
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AVf8B4xcjR0Ur3RmvWYheudIG9hL78MvB8CSdKfsFTObFF61z09uNZmkvyMMswYN4WsHsE5dBrDQSsHA',     // ClientID
                'EKMVbVbjNerUzmoBUMu-fYN4jrQuF92w4viuwujH_9YDQYmN454c4q9BJJ0rJSMvSYtEch4ijNg1tlUx'    // ClientSecret
            )
        );

        $paymentId = $request->input('paymentId');
        $payment = Payment::get($paymentId, $apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $productId = $request->product_id;
        $userId = $request->user_id;

        try {

            $result = $payment->execute($execution, $apiContext);
            $shippingAddress = new ShippingAddress;
            $shippingAddress->recipient_name =$result->payer->payer_info->shipping_address->recipient_name;
            $shippingAddress->line1 = $result->payer->payer_info->shipping_address->line1;
            $shippingAddress->city = $result->payer->payer_info->shipping_address->city;
            $shippingAddress->state =$result->payer->payer_info->shipping_address->state;
            $shippingAddress->postal_code = $result->payer->payer_info->shipping_address->postal_code;
            $shippingAddress->country_code = $result->payer->payer_info->shipping_address->country_code;
            $shippingAddress->save();
            $order_details = new OrderDetails;
            $order_details->payer_name = $result->payer->payer_info->first_name;
            $order_details->payer_last_name = $result->payer->payer_info->last_name;
            $order_details->payer_email = $result->payer->payer_info->email;
            $order_details->payment_amount = $result->transactions[0]->amount->total;
            $order_details->payment_currency = $result->transactions[0]->amount->currency;
            $order_details->product_name = $result->transactions[0]->item_list->items[0]->name;
            $order_details->product_price = $result->transactions[0]->item_list->items[0]->price;
            $order_details->product_price_currency = $result->transactions[0]->item_list->items[0]->currency;
            $order_details->shipping_address_id = $shippingAddress->id;
            $order_details->save();
            $order = new Order;
            $order->product_id = $productId;
            $order->user_id = $userId;
            $order->status = 'Waiting';
            $order->order_details_id = $order_details->id;
            $order->save();
            
            
        } catch (Exception $ex) {
            echo $ex;
            exit(1);
        }
        return view('paypalresult')->with('data',$result);
    }

    public function afterPayment()
    {
        return view('paypalresult');
    }
}
