<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class CoordinatesController
{

    public function content()
    {
        return new Response(
          '<html><body>Lucky number:</body></html>'
        );
    }

}