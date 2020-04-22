<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Redirect user to the client application
     * @return RedirectResponse
     */
    public function redirect(): RedirectResponse
    {
        if (app()->environment('local'))
        {
            return redirect()->to('http://localhost:8080');
        }

        return redirect()->to('https://folding.fit.cvut.cz');
    }
}
