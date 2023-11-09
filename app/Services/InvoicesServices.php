<?php

namespace App\Services;

use App\Models\Invoices;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;

class InvoicesServices
{
    public function getInvoices($request)
    {
        $invoices = DB::select("SELECT invoices.id AS 'invoices_id', invoices.policyTime AS 'policy_time', invoices.chassis AS 'chasis', invoices.licensePlate AS 'placa', invoices.totalGeneral AS 'total',
                                    insurances.nombre AS 'asegurtadora', vehicle_type_tarifs.nombre AS 'tipo_vehiculo', vehicle_brands.DESCRIPCION AS 'marca', vehicle_models.descripcion AS 'modelo',
                                    invoices.police_transactionId AS 'transaccion_id', invoices.police_number AS 'numero_poliza', invoices.payment_status AS 'estatus_pago', invoices.AuthorizationCode AS 'codigo_pago',
                                    clients.id AS 'cliente_id', clients.name AS 'cliente_nombre', clients.lastname AS 'cliente_apellido', clients.cardnumber AS 'cliente_cedula', clients.phonenumber AS 'cliente_celular',
                                    invoices.services AS 'servecios_id', invoices.discount_id AS 'codigo_descuento_id'
                                    FROM invoices
                                    INNER JOIN insurances ON insurances.id = invoices.sellers_id
                                    INNER JOIN vehicle_type_tarifs ON vehicle_type_tarifs.id = invoices.car_tipe
                                    INNER JOIN vehicle_brands ON vehicle_brands.ID = invoices.car_brand
                                    INNER JOIN vehicle_models ON vehicle_models.id = invoices.car_model
                                    INNER JOIN clients ON clients.id = invoices.client_id
                                    WHERE invoices.created_at > '$request->date_init' AND invoices.created_at < '$request->date_end'");
        return $invoices;
    }
    public function getInvoice($id)
    {
        $invoices = DB::select("SELECT invoices.id AS 'invoices_id', invoices.policyTime AS 'policy_time', invoices.chassis AS 'chasis', invoices.licensePlate AS 'placa', invoices.totalGeneral AS 'total',
                                    insurances.nombre AS 'asegurtadora', vehicle_type_tarifs.nombre AS 'tipo_vehiculo', vehicle_brands.DESCRIPCION AS 'marca', vehicle_models.descripcion AS 'modelo',
                                    invoices.police_transactionId AS 'transaccion_id', invoices.police_number AS 'numero_poliza', invoices.payment_status AS 'estatus_pago', invoices.AuthorizationCode AS 'codigo_pago',
                                    clients.id AS 'cliente_id', clients.name AS 'cliente_nombre', clients.lastname AS 'cliente_apellido', clients.cardnumber AS 'cliente_cedula', clients.phonenumber AS 'cliente_celular',
                                    invoices.services AS 'servecios_id', invoices.discount_id AS 'codigo_descuento_id'
                                    FROM invoices
                                    INNER JOIN insurances ON insurances.id = invoices.sellers_id
                                    INNER JOIN vehicle_type_tarifs ON vehicle_type_tarifs.id = invoices.car_tipe
                                    INNER JOIN vehicle_brands ON vehicle_brands.ID = invoices.car_brand
                                    INNER JOIN vehicle_models ON vehicle_models.id = invoices.car_model
                                    INNER JOIN clients ON clients.id = invoices.client_id
                                    WHERE invoices.id = '$id'");
        return $invoices;
    }
}
