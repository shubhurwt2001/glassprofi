<?php

namespace App\Handler;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\WebhookClient\Exceptions\WebhookFailed;
use Spatie\WebhookClient\WebhookConfig;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;

class CustomSignature implements SignatureValidator
{
    public function isValid(Request $request, WebhookConfig $config): bool
    {

        $auth = base64_decode($request->header($config->signatureHeaderName));
        Log::info($auth);
        $timestamp = explode(":", $auth)[0];
        $signature = explode(":", $auth)[1];

        if (!$signature) {
            return false;
        }
        $signingSecret = $config->signingSecret;
        if (empty($signingSecret)) {
            throw WebhookFailed::signingSecretNotSet();
        }
        $computedSignature = hash_hmac('sha512', $timestamp . ':' . $request->getContent(), $signingSecret);
        return hash_equals($signature, $computedSignature);
    }
}
