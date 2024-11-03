<?php

trait ValidateTrait
{
    private function validateStringLength(string $text, int $length): bool
    {
        return mb_strlen($text) <= $length;
    }

    private function validateEmail(string $email): bool
    {
        return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
