<?php


 namespace App\Http\Controllers\Provider;

 use App\Http\Controllers\Controller;
 use App\Traits\Providers\SlotegratorTrait;
 use GuzzleHttp\Exception\GuzzleException;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Log;
 use Illuminate\Http\JsonResponse;

class SlotegratorController extends Controller
{
    use SlotegratorTrait;

    public function webhookHandler(Request $request): JsonResponse
    {
        return $this->webhooks($request);
    }
}
