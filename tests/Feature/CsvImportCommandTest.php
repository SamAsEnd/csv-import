<?php

it('errors when incorrect path is given', function () {
    $this->artisan('csv:import /path/to/a/non-existent/file')
        ->expectsOutput('File does not exist!')
        ->assertExitCode(-1);
});

it('parse csv files', function () {
    /** @var \Tests\TestCase $this */
    $this->artisan('csv:import stubs/simple.csv')
        ->expectsTable(['Name', 'Handle'], [
            ['Samson Endale', 'SamAsEnd'],
        ])
        ->assertExitCode(0);
});
