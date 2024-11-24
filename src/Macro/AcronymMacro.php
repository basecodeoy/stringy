<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\StringPowerPack\Macro;

final class AcronymMacro implements MacroInterface
{
    public function run(string $string): string
    {
        \preg_match_all('/\b\w/u', $string, $matches);

        return \implode('', $matches[0]);
    }

    public function names(): array
    {
        return [
            'acronym',
        ];
    }
}
