<?php

namespace App\MessageHandler;

use App\Message\UploadMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class UploadMessageHandler
{
    public function __invoke(UploadMessage $message): void
    {}
}