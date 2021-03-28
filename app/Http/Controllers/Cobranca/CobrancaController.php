<?php

namespace App\Http\Controllers\Cobranca;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CobrancaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, config('app.asaas_url') . "payments");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
  "customer": "' . $request->customer . '",
  "billingType": "BOLETO",
  "dueDate": "' . $request->dueDate . '",
  "value": ' . $request->value . ',
  "description": "' . $request->description . '",
  "externalReference": "' . $request->externalReference . '",
  "discount": {
    "value": ' . $request->value1 . ',
    "dueDateLimitDays": ' . $request->dueDateLimitDays . '
  },
  "fine": {
    "value": ' . $request->value2 . '
  },
  "interest": {
    "value": ' . $request->value3 . '
  },
  "postalService": ' . $request->postalService . '
}');

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . config("app.asaas_key")
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function storeCartao(Request $request)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, config('app.asaas_url') . "payments/cartao");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
        "customer": "' . $request->customer . '",
        "billingType": "CREDIT_CARD",
        "dueDate": "' . $request->dueDate . '",
        "value": ' . $request->value . ',
        "description": "' . $request->description . '",
        "externalReference": "' . $request->externalReference . '",
        "creditCard": {
            "holderName": "' . $request->holderName . '",
            "number": "' . $request->number . '",
            "expiryMonth": "' . $request->expiryMonth . '",
            "expiryYear": "' . $request->expiryYear . '",
            "ccv": "' . $request->ccv . '"
        },
        "creditCardHolderInfo": {
            "name": "' . $request->name . '",
            "email": "' . $request->email . '",
            "cpfCnpj": "' . $request->cpfCnpj . '",
            "postalCode": "' . $request->postalCode . '",
            "addressNumber": "' . $request->addressNumber . '",
            "addressComplement": ' . $request->addressComplement . ',
            "phone": "' . $request->phone . '",
            "mobilePhone": "' . $request->mobilePhone . '"
        },
        "creditCardToken": "' . $request->creditCardToken . '"
        }');

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . config('app.asaas_key')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return response()->json($response);
    }

    public function storeParcelada(Request $request)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, config('app.asaas_url') . "payments/parcelado");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
  "customer": "' . $request->customer . '",
  "billingType": "' . $request->billingType . '",
  "installmentCount": ' . $request->installmentCount . ',
  "installmentValue": ' . $request->installmentValue . ',
  "dueDate": "' . $request->dueDate . '",
  "description": "' . $request->description . '",
  "externalReference": "' . $request->externalReference . '",
  "discount": {
    "value": ' . $request->value . ',
    "dueDateLimitDays": ' . $request->dueDateLimitDays . '
  },
  "fine": {
    "value": ' . $request->valueMulta . '
  },
  "interest": {
    "value": ' . $request->valueJuros . '
  }
}');

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . config('app.asaas_key')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, config('app.asaas_url') . "payments/" . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . config('app.asaas_key')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, config('app.asaas_url') . "payments/" . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
  "billingType": "BOLETO",
  "dueDate": "2017-06-10",
  "value": 100,
  "description": "Pedido 056984",
  "externalReference": "056984",
  "discount": {
    "value": 10,
    "dueDateLimitDays": 0
  },
  "fine": {
    "value": 1
  },
  "interest": {
    "value": 2
  },
  "postalService": false
}');

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . config('app.asaas_key')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, config('app.asaas_url') . "payments/" . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . config('app.asaas_key')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);
    }

    public function restore($id)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, config('app.asaas_url') . "payments/{id}/restore
");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: sua_api_key"
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        var_dump($response);
    }

    public function estornar($id)
    {
        //
    }

    public function receiveInCash($id)
    {
        //
    }

    public function dereceiveCash($id)
    {
        //
    }
}
