<?php

namespace App\Providers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use JsonSerializable;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @param ResponseFactory $response
     * @return void
     */
    public function boot(ResponseFactory $response): void
    {
        $response->macro('apiSuccess', function ($data = []): JsonResponse {
            $response = '';
            $responseTemplate = '{"error":"","response":%s}';
            if ($data instanceof ResourceCollection) {
                $response = $data->toResponse(request())->getContent();
            } elseif ($data instanceof Jsonable) {
                $response = $data->toJson();
            } elseif ($data instanceof JsonSerializable) {
                $response = json_encode($data->jsonSerialize());
            } elseif ($data instanceof Arrayable) {
                $response = json_encode($data->toArray());
            } else {
                $response = json_encode($data);
            }

            return JsonResponse::fromJsonString(sprintf($responseTemplate, $response));
        });

        $response->macro('apiError', function ($message = 'Something went wrong', $status = 400, $errors = []): JsonResponse {
            $errors = json_encode($errors);
            $responseTemplate = '{"message":"%s","errors":%s}';

            return JsonResponse::fromJsonString(sprintf($responseTemplate, $message, $errors), $status);
        });
    }
}
