<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 16.03.2018
 * Time: 17:56
 */
require_once __DIR__ . '/vendor/autoload.php';

use Money\Currency;
use Money\Money;
use Product\Product;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$db = new \LowDB\LowDB();
$app['debug'] = true;

$app->get("/products", function () use ($app, $db) {
    $data = $db->SelectAll("products");
    $data = json_decode($data, true);
    $array = array();

    foreach ($data as $k => $v) {
        $array[$k] = $v["name"];
    }

    return json_encode($array, JSON_PRETTY_PRINT);
});

$app->get("/products/{id}", function ($id) use ($app, $db) {
    $data = $db->SelectById("products", $id);
    if (!empty($data)) {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    return new Response('Not Found', 404 /* ignored */, array('X-Status-Code' => 200));
});

$app->post("/products", function () use ($app, $db) {
    $r = $app['request_stack']->getCurrentRequest();

    $productName = $r->get("name");
    $productPrice = $r->get("price");
    $productCurrency = $r->get("currency");

    if ($productName && $productPrice && $productCurrency) {
        $allowCurrency = ["PLN", "EUR", "USD"];

        if (in_array($productCurrency, $allowCurrency)) {
            $product = new Product($productName, new Money($productPrice, new Currency($productCurrency)));
            $db->Insert("products", $product->getArrayToJSON());
        } else {
            return new Response('Bad Request', 400 /* ignored */, array('X-Status-Code' => 200));
        }
    } else {
        return new Response('Bad Request', 400 /* ignored */, array('X-Status-Code' => 200));
    }
    return new Response('Created', 201 /* ignored */, array('X-Status-Code' => 200));
});

$app->delete('/products/{id}', function ($id) use ($db) {
    if ($db->DeleteById("products", $id)) {
        return new Response('NO CONTENT', 204 /* ignored */, array('X-Status-Code' => 200));
    }
    return new Response('Not Found', 404 /* ignored */, array('X-Status-Code' => 200));
});

$app->put('/products/{id}', function ($id) use ($app, $db) {
    $r = $app['request_stack']->getCurrentRequest();

    $productName = $r->get("name");
    $productPrice = $r->get("price");
    $productCurrency = $r->get("currency");

    if ($productName && $productPrice && $productCurrency) {
        $allowCurrency = ["PLN", "EUR", "USD"];

        if (in_array($productCurrency, $allowCurrency)) {
            $product = new Product($productName, new Money($productPrice, new Currency($productCurrency)));

            if (!$db->Update("products", $id, $product->getArrayToJSON())) {
                return new Response('Not Found', 404 /* ignored */, array('X-Status-Code' => 200));
            }
        } else {
            return new Response('Bad Request', 400 /* ignored */, array('X-Status-Code' => 200));
        }
    } else {
        return new Response('Bad Request', 400 /* ignored */, array('X-Status-Code' => 200));
    }
    return new Response('No Content', 204 /* ignored */, array('X-Status-Code' => 200));
});

$app->run();