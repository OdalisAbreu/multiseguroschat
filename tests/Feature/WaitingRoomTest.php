<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\DataPaymentGateway;
use App\Models\Insurance;
use App\Models\Invoices;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Inertia\Testing\Assert;

class WaitingRoomTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_handles_a_successful_payment()
    {
        // Configurar el request simulado
        $data = [
            'ResponseCode' => '00',
            'TransactionID' => 1,
            'RemoteResponseCode' => '00',
            'AuthorizationCode' => '409615',
            'RetrivalReferenceNumber' => '000000000033',
            'TxToken' => 'txn-8fe8af21ca484614b70eddd0286fa8ce'
        ];
        $client =  Client::create([
            'id' => 1,
            'name' => 'Odalis',
            'lastname' => 'Abreu',
            'cardnumber' => '22400274092',
            'passportnumber' => '',
            'phonenumber' => '18294428902',
            'adrress' => 'Las Cobas',
            'city' => 'Santo Domingo',
            'email' => 'odalis@mail.com',
            'session' => 'A',
            'nacionalidad' => 117,
            'province' => 2,
            'vista' => 'Vista',
            'idConversacion' => 210460880
        ]);

        Insurance::create([
            'id' => 5,
            'name' => 'SURA SEGUROS',
            'prefijo' => 'AUTO-SS',
            'id_suplid' => 1,
            'logo' => '/ima/sura-logo-act.png',
            'activo' => 'si',
            'valores_alternos' => 'valores_alternos'
        ]);

        DataPaymentGateway::create([
            'merchanttype' => '7997',
            'merchantnumber' => '349000000',
            'merchantterminal' => '58585858',
            'client_name' => 'Sura Seguros Chat',
            'insurance_id' => 5,
            'payment_gateway_id' => 2,
            'payment_url' => 'https://lab.cardnet.com.do/authorize'
        ]);

        $invoice = Invoices::create([
            'policyTime' => '12',
            'chassis' => 'Knagu416bha167996',
            'licensePlate' => 'AAA1234',
            'year' => '2022',
            'totalGeneral' => 2350,
            'sellers_id' => 5,
            'car_tipe' => 2,
            'car_brand' => 29,
            'car_model' => 2254,
            'services' => '[]',
            'client_id' => $client->id,
            'payment_status' => 'peding',
            'discount_id' => 0,
            'policyInitDate' => date('Y-m-d\TH:i:s.u\Z'),
        ]);

        // Llamar a la función waitingRoom
        $this->post('api/statusPayment', $data);
        // Verificar que la factura fue actualizada
        $invoice->refresh();
        $this->assertEquals('ACCEPT', $invoice->payment_status);
        $this->assertEquals($data['ResponseCode'], $invoice->payment_messeger);
        $this->assertNotNull($invoice->police_number);
        $this->assertNotNull($invoice->police_transactionId);
    }

    /** @test */
    public function it_handles_a_declined_payment()
    {
        // Configurar el request simulado
        $data = [
            'ResponseCode' => '01', // Código de error para la prueba
            'TransactionID' => 1,
            'RemoteResponseCode' => '00',
            'AuthorizationCode' => '409615',
            'RetrivalReferenceNumber' => '000000000033',
            'TxToken' => 'txn-8fe8af21ca484614b70eddd0286fa8ce'
        ];

        $client =  Client::create([
            'id' => 1,
            'name' => 'Odalis',
            'lastname' => 'Abreu',
            'cardnumber' => '22400274092',
            'passportnumber' => '',
            'phonenumber' => '18294428902',
            'adrress' => 'Las Cobas',
            'city' => 'Santo Domingo',
            'email' => 'odalis@mail.com',
            'session' => 'A',
            'nacionalidad' => 117,
            'province' => 2,
            'vista' => 'Vista',
            'idConversacion' => 210460880
        ]);

        Insurance::create([
            'id' => 5,
            'name' => 'SURA SEGUROS',
            'prefijo' => 'AUTO-SS',
            'id_suplid' => 1,
            'logo' => '/ima/sura-logo-act.png',
            'activo' => 'si',
            'valores_alternos' => 'valores_alternos'
        ]);

        DataPaymentGateway::create([
            'merchanttype' => '7997',
            'merchantnumber' => '349000000',
            'merchantterminal' => '58585858',
            'client_name' => 'Sura Seguros Chat',
            'insurance_id' => 5,
            'payment_gateway_id' => 2,
            'payment_url' => 'https://lab.cardnet.com.do/authorize'
        ]);

        $invoice = Invoices::create([
            'policyTime' => '12',
            'chassis' => 'Knagu416bha167996',
            'licensePlate' => 'AAA1234',
            'year' => '2022',
            'totalGeneral' => 2350,
            'sellers_id' => 5,
            'car_tipe' => 2,
            'car_brand' => 29,
            'car_model' => 2254,
            'services' => '[]',
            'client_id' => $client->id,
            'payment_status' => 'peding',
            'discount_id' => 0,
            'policyInitDate' => date('Y-m-d\TH:i:s.u\Z'),
        ]);

        // Llamar a la función waitingRoom
        $this->post('api/statusPayment', $data);

        // Verificar que la factura fue actualizada
        $invoice->refresh();
        $this->assertEquals('DECLINED', $invoice->payment_status);
        $this->assertEquals($data['ResponseCode'], $invoice->payment_messeger);

        //     // Verificar la respuesta
        //     $response->assertInertia(
        //         fn(Assert $page) => $page
        //             ->component('error')
        //             ->hasAll([
        //                 'ResponseCode',
        //                 'TransactionID',
        //                 'RemoteResponseCode',
        //                 'AuthorizationCode',
        //                 'RetrivalReferenceNumber',
        //                 'TxToken'
        //             ])
        //     );
    }
}
