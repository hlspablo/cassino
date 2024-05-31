<?php


 namespace App\Http\Controllers\Provider;

 use App\Http\Controllers\Controller;
 use App\Traits\Providers\SlotegratorTrait;
 use GuzzleHttp\Exception\GuzzleException;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Log;
 use JetBrains\PhpStorm\NoReturn;

 class SlotegratorController extends Controller
 {
     use SlotegratorTrait;

     /**
      * Display a listing of the resource.
      * @throws GuzzleException
      * @throws \JsonException
      */
     public function index(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     {
         $data = $this->getGames();
         dd($data);
         //return response()->json(['data' => $prettyData]);
         return response($prettyData, 200, ['Content-Type' => 'application/json']);
     }
     /**
      * Store a newly created resource in storage.
      */
     public function webhookMethod(Request $request)
     {
         return $this->webhooks($request);
     }

     /**
      * Display the specified resource.
      */
     public function show(string $id)
     {
         //
     }

     /**
      * Show the form for editing the specified resource.
      */
     public function edit(string $id)
     {
         //
     }

     /**
      * Update the specified resource in storage.
      */
     public function update(Request $request, string $id)
     {
         //
     }

     /**
      * Remove the specified resource from storage.
      */
     public function destroy(string $id)
     {
         //
     }
 }
