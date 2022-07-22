<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('eloquent.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Client::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'id_number' => $request->id_number
            ]
        );
        $id = Client::where('phone', '=', $request->phone)
            ->where('name', '=', $request->name)->first();

        Bill::create(
            [
                'invoice' => $request->invoice,
                'installment' => $request->installment,
                'value' => $request->value,
                'client_id' => $id->id
            ]
        );

        return view('eloquent.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($client)
    {
        $client = Client::find($client);
        //dd($client);
        //$clients = Bill::where('client_id', '=', $client->id)->get();
        //$clientao = $client . $clients;
        return $client;
    }

    public function show2($name)
    {
        $name = Client::where('name', '=', $name)->first();
        //dd($client);
        //$clients = Bill::where('client_id', '=', $client->id)->get();
        //$clientao = $client . $clients;
        return $name;
    }
    public function search($text)
    {
        $text = Client::where('name', 'LIKE', "%$text%")->get();
        //dd($client);
        //$clients = Bill::where('client_id', '=', $client->id)->get();
        //$clientao = $client . $clients;
        return $text;
    }

    public function bills($client)
    {
        $client = Client::find($client);
        //dd($client);
        $clients = Bill::where('client_id', '=', $client->id)->get();
        //$clientao = $client . $clients;
        return $clients;
    }
    public function value($value)
    {
        $contas = Bill::where('value', '>', $value)->get();
        //$clientao = $client . $clients;
        return $contas;
    }
    public function between($value1, $value2)
    {
        $contas = Bill::where('value', '>', $value1)->where('value', '<', $value2)->get();
        //$clientao = $client . $clients;
        return $contas;
    }

    public function order()
    {
        $client = Client::orderBy('name', 'ASC')->limit(2)->get();
        //dd($client);
        //$clientao = $client . $clients;
        return $client;
    }

    public function soma($num1, $num2)
    {
        $soma = $num1 + $num2;
        logger()->info('Soma feita');
        return $soma;
    }
    public function sub($num1, $num2)
    {
        $subtra = $num1 - $num2;
        logger()->debug('Sub feita', ['num1' => $num1, 'num2' => $num2, 'sub' => $subtra]);
        return $subtra;
    }
    
    public function div($num1, $num2)
    {
        if($num2 == 0){
            logger()->error('Divisor zero!');
        }else{
            logger()->info('Div feita');
        }
        return $num1;
    }
    public function mult($num1, $num2)
    {
        if($num1 < 0 || $num2 < 0){
            logger()->warning('Negativo');
        }
        return $num1;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
