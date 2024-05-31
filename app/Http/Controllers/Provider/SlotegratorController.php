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
     public function index(): \Illuminate\Http\JsonResponse
     {
         $result = $this->startGameSlotegrator('d2eca6ec0cee46189bcc99620e08f844');
         return response()->json($result);
         //$this->generateSlugs();
         //return response()->json(['status' => 'success']);
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
