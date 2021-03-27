<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'Listar Clientes';
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

        curl_setopt($ch, CURLOPT_URL, config('app.asaas_url') . "customers");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
  "name": "' . $request->name . '",
  "email": "' . $request->email . '",
  "phone": "' . $request->phone . '",
  "mobilePhone": "' . $request->mobilePhone . '",
  "cpfCnpj": "' . $request->cpfCnpj . '",
  "postalCode": "' . $request->postalCode . '",
  "address": "' . $request->address . '",
  "addressNumber": "' . $request->addressNumber . '",
  "complement": "' . $request->complement . '",
  "province": "' . $request->province . '",
  "externalReference": "' . $request->externalReference . '",
  "notificationDisabled": ' . $request->notificationDisabled . ',
  "additionalEmails": "' . $request->additionalEmails . '",
  "municipalInscription": "' . $request->municipalInscription . '",
  "stateInscription": "' . $request->stateInscription . '",
  "observations": "' . $request->observations . '"
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

        curl_setopt($ch, CURLOPT_URL, config('app.asaas_url') . "customers/" . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . config('app.asaas_key')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return response()->json($response);
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

        curl_setopt($ch, CURLOPT_URL, config("app.asaas_url") . "customers/" . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_POSTFIELDS, '{
  "name": "' . $request->name . '",
  "email": "' . $request->email . '",
  "phone": "' . $request->phone . '",
  "mobilePhone": "' . $request->mobilePhone . '",
  "cpfCnpj": "' . $request->cpfCnpj . '",
  "postalCode": "' . $request->postalCode . '",
  "address": "' . $request->address . '",
  "addressNumber": "' . $request->addressNumber . '",
  "complement": "' . $request->complement . '",
  "province": "' . $request->province . '",
  "externalReference": "' . $request->externalReference . '",
  "notificationDisabled": "' . $request->notificationDisabled . '",
  "additionalEmails": "' . $request->additionalEmails . '",
  "municipalInscription": "' . $request->municipalInscription . '",
  "stateInscription": "' . $request->stateInscription . '"
}');

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . config("app.asaas_key")
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
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

        curl_setopt($ch, CURLOPT_URL, config("app.asaas_url") . "customers/" . $id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: " . config('app.asaas_key')
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function restore($id)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, config("app.asaas_url")."customers/".$id."/restore");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_POST, TRUE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "access_token: ".config("app.asaas_key")
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
