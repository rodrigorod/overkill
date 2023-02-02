<?php

namespace App\Message;

use Symfony\Component\HttpFoundation\File\File;

class UploadMessage
{
    public function __construct(
        private readonly ?File $upload,
        private readonly string $user
    )
    {}

    public function getUpload(): string
    {
        return $this->upload;
    }

    public function getUser(): string
    {
        return $this->user;
    }
}