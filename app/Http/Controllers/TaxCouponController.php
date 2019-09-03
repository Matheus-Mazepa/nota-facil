<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Request;

class TaxCouponController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('tax-coupon');
    }

    public function taxCoupon(Request $request) {
        $client = new Client();

        $products = $request->get('products');

        $headers = [
            'x-access-token' => current_user()->token_modula_id,
            'Accept' => 'application/json, text/plain, */*',
            'Content-type' => 'application/json;charset=UTF-8'
        ];

        $response = $client->get(
            'https://api.modulapro.com.br:3019/issuer',
            [
                'headers' => $headers,
            ]
        );

        $data = json_decode((string)$response->getBody());
        if ($response->getStatusCode() == 200) {
            $store = data_get($data, 'data');
            try {
                $response = $client->post(
                    'https://api.modulapro.com.br:3019/taxcoupon/',
                    [
                        'headers' => $headers,
                        'json' => [
                            'cpf_ticket_check' => false,
                            'total_discount' => 0,
                            'received_value' => 0,
                            'products_price' => 9,
                            'total_price' => 9,
                            'change_value' => 0,
                            'products' => $products,
                            'tpAmb' => 1,
                            'store' => $store,
                            'tax' =>  [
                                'city' => '0', 'state' => '0.035', 'federal' => '0.02'
                            ],
                            'customer' => [],
                            'cpf_ticket' => "",
                        ],
                    ]
                );
                if ($response->getStatusCode() == 200) {
                    $data = json_decode((string)$response->getBody());
                    dd($data);
                }
            } catch (\Exception $exception) {
                dd($exception);
            }
        }
    }


//curl 'https://api.modulapro.com.br:3019/taxcoupon/'
//-H 'Accept: application/json, text/plain, */*' -H
//'x-access-token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJhcGkubW9kdWxhcHJvLmNvbS5icjozMDE5L2FwaSIsInN1YiI6IjU4MzlhZGQ1ODNmMzBkNjVhNzRlMDdmMiIsInNjb3BlIjoibWFuYWdlclJvbGUiLCJpYXQiOjE1NjI0MjUzNDcsImV4cCI6MTU2MjQ1NDE0N30.LudfFzdVCxfi7iLNg59msIgt4GJjpDnxTvZZJBWa5tE'
//-H 'User-Agent: GuzzleHttp/6.3.3 curl/7.54.0 PHP/7.1.23'
//-H 'DNT: 1'
//-H 'Content-Type: application/json;charset=UTF-8'
//--data-binary '{"cpf_ticket_check":false,"total_discount":0,"received_value":0,"products_price":9,"total_price":9,"change_value":0,"products":[{"ncm_desc":"","cfop":"5101","cfop_nfe":"5401","comercial_price":9,"comercial_price_nfe":9,"created_at":"2016-11-27T14:21:36.385Z","_id":"583aebf0ca1c28674a832a16","name":"Pote 1L Sabores Mistos","description":"Pote 1L Sabores Mistos","ncm":"21050090","icms_aliquot":0,"ipi_aliquot":0.005,"comercial_unit":"UND","taxable_unit":"UND","taxable_quantity":1,"taxable_price":9,"_cod":55,"__v":0,"details":{},"quantity":1,"comercial_price_total":9,"price":{"sale":9,"discount":0},"unit":{"abbreviation":"UND"}}],
//"tpAmb":1,"store":{"cnpj":"95384491000128","street":"Rua Leonardo Coblinski","number":223,"neighborhood":"Boqueirão","city_name":"Guarapuava","cep":"85023330","state_name":"Paraná","phone":"4236221023"},
//"tax":{"city":0,"state":0.035,"federal":0.02},
//"customer":{},"cpf_ticket":""}'
//--compressed

    public function getAll()
    {
        $client = new Client();


        $headers = [
            'x-access-token' => current_user()->token_modula_id,
        ];

        $response = $client->get(
            'https://api.modulapro.com.br:3019/product/?limit=1000&skip=0',
            [
                'headers' => $headers,
            ]
        );


        $data = json_decode((string)$response->getBody());
        if ($response->getStatusCode() == 200) {
          return data_get($data, 'data');
        }
        return [];

    }
}
