<?php

it('errors when incorrect path is given', function () {
    $this->artisan('csv:import-custom /path/to/a/non-existent/file')
        ->expectsOutput('File does not exist!')
        ->assertExitCode(-1);
});

it('parse csv files', function () {
    /** @var \Tests\TestCase $this */
    $this->artisan('csv:import-custom stubs/sample.csv')
        ->expectsTable(['Name', 'Address', 'Phone', 'Tags', 'ID'], [
            ['John Wilson', '23 Arkadia Avenue, \nLondon,\nSW1 8TT', '00443234233322', 'Student,Customer,Alumni', '544533'],
            ['Sam Dawson', '6 The Mills, \nDublin,\nD4', '003534233322', 'Student', '544522'],
            ['Gerry Rigss ', 'The Old Valve,\nThe Rock, \nDublin,\nD2', '003534222322', 'Student', '544223'],
        ])
        ->assertExitCode(0);
});
