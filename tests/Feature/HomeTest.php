<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    public function TestExample()
    {
        $response = $this->get('/');

        $response->assertSeeText('سر تیتر خبرها');
    }
}
