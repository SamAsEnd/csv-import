<?php

it('has csv:import command', function () {
    $this->artisan('csv:import')
        ->assertExitCode(0);
});

