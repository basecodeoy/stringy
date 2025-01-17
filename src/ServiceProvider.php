<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Stringy;

use BaseCodeOy\Crate\Package\AbstractServiceProvider;
use BaseCodeOy\Stringy\Macro\MacroInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

final class ServiceProvider extends AbstractServiceProvider
{
    #[\Override()]
    public function packageRegistered(): void
    {
        foreach ($this->macros() as $macro) {
            /** @var MacroInterface */
            $instance = app($macro);

            foreach ($instance->names() as $name) {
                if (!Str::hasMacro($name)) {
                    Str::macro($name, fn (string $value): string => $instance->run($value));
                }

                if (!Stringable::hasMacro($name)) {
                    Stringable::macro($name, fn (): Stringable => new Stringable($instance->run($this->value)));
                }
            }
        }
    }

    private function macros(): array
    {
        return [
            Macro\AcronymMacro::class,
            Macro\CamelCaseMacro::class,
            Macro\ConstantCaseMacro::class,
            Macro\DotCaseMacro::class,
            Macro\HeaderCaseMacro::class,
            Macro\HeadlineCaseMacro::class,
            Macro\KebabCaseMacro::class,
            Macro\LowerCaseFirstMacro::class,
            Macro\LowerCaseMacro::class,
            Macro\NoCaseMacro::class,
            Macro\PascalCaseMacro::class,
            Macro\PathCaseMacro::class,
            Macro\SentenceCaseMacro::class,
            Macro\SnakeCaseMacro::class,
            Macro\SpongeCaseMacro::class,
            Macro\SwapCaseMacro::class,
            Macro\TitleCaseMacro::class,
            Macro\UpperCaseFirstMacro::class,
            Macro\UpperCaseMacro::class,
        ];
    }
}
