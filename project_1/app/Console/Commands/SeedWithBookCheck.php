<?php
namespace App\Console\Commands;
use Illuminate\Database\Console\Seeds\SeedCommand;
use Symfony\Component\Console\Input\InputOption;
// Rozszerzenie standardowego db:seed o opcje podana w zadaniu.
class SeedWithBookCheck extends SeedCommand
{
    protected function getOptions(): array
    {
        return array_merge(parent::getOptions(), [
            ['check', null, InputOption::VALUE_REQUIRED, 'Sprawdz tytul ksiazki zamiast dodawac dane'],
        ]);
    }
}
