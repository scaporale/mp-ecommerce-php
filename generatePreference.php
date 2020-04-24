<?php
    
    require ('constantes.php');

    require __DIR__  . '/vendor/autoload.php';
    
    //Credenciales Mercado Pago (PRODUCCION - Test-user)
    MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);
    MercadoPago\SDK::setPublicKey(PUBLIC_KEY);

    //Sanitización de variables POST (Prevención XSS)
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //Variables del POST
    $imgProducto    = $_POST['img'];
    $titleProducto  = $_POST['title'];
    $priceProducto  = $_POST['price'];
    $unitProducto   = $_POST['unit'];


    //Creo la preferencia
    $preference = new MercadoPago\Preference();
    $preference->binary_mode = false;   //Aprobado, Rechazado o En proceso (con true solo los primeros dos)
            
    //Creo el item con la información del producto que quiero cobrar
    $item = new MercadoPago\Item();
    $item->id = INFORMACION_PRODUCTO_ID;
    $item->title = $titleProducto;
    $item->quantity = INFORMACION_PRODUCTO_CANTIDAD;
    $item->currency_id = INFORMACION_PRODUCTO_MONEDA;
    $item->unit_price = $priceProducto;
    $item->description = INFORMACION_PRODUCTO_DESCRIPCION;
    $item->picture_url = URL_SITE.$imgProducto;

    //Agrego el item a la preferencia
    $preference->items = [ $item ];

    //Creo el payer
    $payer = new MercadoPago\Payer();
    $payer->name = INFORMACION_PAGADOR_NOMBRE;
    $payer->surname = INFORMACION_PAGADOR_APELLIDO;
    $payer->email = INFORMACION_PAGADOR_EMAIL;
    $payer->phone = [
        "area_code" => INFORMACION_PAGADOR_TELEFONO_CODIGO_DE_AREA,
        "number" => INFORMACION_PAGADOR_TELEFONO_NUMERO
    ];
    $payer->identification = [
        'type' => INFORMACION_PAGADOR_DNI_TIPO,
        'number' => INFORMACION_PAGADOR_DNI_NUMERO,
    ];        
    $payer->address = [
        "street_name" => INFORMACION_PAGADOR_CALLE,
        "street_number" => intval(INFORMACION_PAGADOR_NUMERO),
        "zip_code" => INFORMACION_PAGADOR_CODIGO_POSTAL
    ];

    //MP espera la fecha en formato Date(ISO_8601)
    $fechaYHora = new DateTime('now');
    $payer->date_created = $fechaYHora->format(ISO_8601);

    //Agrego el payer a la preferencia
    $preference->payer = $payer;

    //Métodos de pago excluidos y cantidad de cuotas máxima
    $preference->payment_methods = [
        "excluded_payment_methods"  =>      [ MEDIOS_DE_PAGO_EXCEPTUADOS ],
        "excluded_payment_types"    =>      [ TIPOS_DE_MEDIOS_DE_PAGO_EXCEPTUADOS ],
        "installments"              =>      CANTIDAD_MAXIMA_CUOTAS
    ];

    //Asigno las Back urls
    $preference->back_urls = [
        "success" => URL_SITE_PAGO_APROBADO,
        "failure" => URL_SITE_PAGO_RECHAZADO,
        "pending" => URL_SITE_PAGO_EN_PROCESO
    ];
    $preference->auto_return = "approved";

    //Asigno URL del servicio IPN
    $preference->notification_url = URL_SITE_IPN;

    //Asigno external_reference
    $preference->external_reference = INFORMACION_PEDIDO_NUMERO_DE_ORDEN;



    //Finalmente genero la preferencia
    $status = $preference->save();

    // var_dump($preference);
    // die;


