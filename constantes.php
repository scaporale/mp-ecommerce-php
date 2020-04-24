<?php

    //Url del sitio
    define("URL_SITE", "https://scaporale-mp-ecommerce-php.herokuapp.com/");
    define("URL_SITE_PAGO_APROBADO", URL_SITE."aprobado.php");
    define("URL_SITE_PAGO_RECHAZADO", URL_SITE."rechazado.php");
    define("URL_SITE_PAGO_EN_PROCESO", URL_SITE."en-proceso.php");
    define("URL_SITE_IPN", URL_SITE."ipn.php");
    define("URL_MERCADO_PAGO_GET_PAYMENTS", "https://api.mercadopago.com/v1/payments/");

    //Credenciales de Mercado Pago
    define("ACCESS_TOKEN", "APP_USR-7455310476774640-042418-208e377607b9c1e908f72d0c17be8715-469485398");
    define("PUBLIC_KEY", "APP_USR-a4bbec5d-51dd-4fbb-b2b9-143486752915");
    
    //Constantes para configurar la preferencia
    define("CANTIDAD_MAXIMA_CUOTAS", 6);
    define("MEDIOS_DE_PAGO_EXCEPTUADOS", [ 'id' => 'amex' ]);
    define("TIPOS_DE_MEDIOS_DE_PAGO_EXCEPTUADOS", [ 'id' => 'atm' ]);

    //Constantes con información del comprador
    define("INFORMACION_PAGADOR_NOMBRE", 'Lalo');
    define("INFORMACION_PAGADOR_APELLIDO", 'Landa');
    define("INFORMACION_PAGADOR_EMAIL", 'test_user_63274575@testuser.com');
    define("INFORMACION_PAGADOR_DNI_TIPO", 'DNI');
    define("INFORMACION_PAGADOR_DNI_NUMERO", '22.333.444');
    define("INFORMACION_PAGADOR_TELEFONO_CODIGO_DE_AREA", '011');
    define("INFORMACION_PAGADOR_TELEFONO_NUMERO", '2222-3333');
    define("INFORMACION_PAGADOR_CALLE", 'Falsa');
    define("INFORMACION_PAGADOR_NUMERO", '123');
    define("INFORMACION_PAGADOR_CODIGO_POSTAL", '1111');

    //Constantes con información del producto
    define("INFORMACION_PRODUCTO_ID", '1234');
    define("INFORMACION_PRODUCTO_DESCRIPCION", 'Dispositivo móvil de Tienda e-commerce');
    define("INFORMACION_PRODUCTO_CANTIDAD", 1);
    define("INFORMACION_PRODUCTO_MONEDA", "ARS");

    //Constantes con información del pedido
    define("INFORMACION_PEDIDO_NUMERO_DE_ORDEN", 'ABCD1234');

    //Formato de fecha esperado por Mercado Pago Date(ISO_8601)
    define("ISO_8601",'Y-m-d\TH:i:sO');
    