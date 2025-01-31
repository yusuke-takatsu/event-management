<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordPattern implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $patterns = [
            'uppercase' => '/[A-Z]/',
            'lowercase' => '/[a-z]/',
            'number' => '/\d/',
            'symbol' => '/[!"#$%&\'()*+,-.\/:;<>=?@[\]^_`{}|~]/',
        ];

        $characterClassesCount = 0;
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $value)) {
                $characterClassesCount++;
            }
        }

        // 半角英数字記号のみかチェック
        $isAlphaNumSymbol = preg_match('/^[!-~]+$/', $value);

        if ($characterClassesCount < 3 || ! $isAlphaNumSymbol) {
            $fail(__('validation.custom.password.pattern'));
        }
    }
}
