<?php

    require ('constantes.php');

    require __DIR__  . '/vendor/autoload.php';

    $_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

    MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);

    $merchant_order = null;

    switch($_GET["topic"]) {
        case "payment":
            $payment = MercadoPago\Payment::find_by_id($_GET["id"]);
            // Get the payment and the corresponding merchant_order reported by the IPN.
            $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);
            break;
        case "merchant_order":
            $merchant_order = MercadoPago\MerchantOrder::find_by_id($_GET["id"]);
            break;
    }

    if(!empty($merchant_order)){

        if(!empty($payment)){
            $paid_amount = 0;
            foreach ($merchant_order->payments as $payment) {
                if ($payment->status == 'approved'){
                    $paid_amount += $payment->transaction_amount;
                }
            }
            /*
            public 'id' => int 6290967916
            public 'transaction_amount' => int 10000
            public 'total_paid_amount' => int 10000
            public 'shipping_cost' => int 0
            public 'currency_id' => string 'ARS' (length=3)
            public 'status' => string 'approved' (length=8)
            public 'status_detail' => string 'accredited' (length=10)
            public 'operation_type' => string 'regular_payment' (length=15)
            public 'date_approved' => string '2020-04-24T16:19:11.000-04:00' (length=29)
            public 'date_created' => string '2020-04-24T16:19:10.000-04:00' (length=29)
            public 'last_modified' => string '2020-04-24T16:19:11.000-04:00' (length=29)
            public 'amount_refunded' => int 0
            */
            $html = 'id: '.$payment->id. '<br>';
            $html .= 'transaction_amount: '.$payment->transaction_amount. '<br>';
            $html .= 'total_paid_amount: '.$payment->total_paid_amount. '<br>';
            $html .= 'shipping_cost: '.$payment->shipping_cost. '<br>';
            $html .= 'currency_id: '.$payment->currency_id. '<br>';
            $html .= 'status: '.$payment->status. '<br>';
            $html .= 'status_detail: '.$payment->status_detail. '<br>';
            $html .= 'operation_type: '.$payment->operation_type. '<br>';
            $html .= 'date_approved: '.$payment->date_approved. '<br>';
            $html .= 'date_created: '.$payment->date_created. '<br>';
            $html .= 'last_modified: '.$payment->last_modified. '<br>';
            $html .= 'amount_refunded: '.$payment->amount_refunded. '<br>';

            echo $html;

        }

    }