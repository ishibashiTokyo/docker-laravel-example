<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;// クライアントからのリクエストが格納されているオブジェクト
use Illuminate\Http\Response;// サーバーからのレスポンスが格納されているオブジェクト

class RequestResponseViewController extends Controller
{
    public function index(Request $request, Response $response, $id = 'none') {
        $html = <<< HTM
<h3>Request</h3>
<pre>{$request}</pre>
<h3>Response</h3>
<pre>{$response}</pre>
<h3>ID</h3>
<pre>{$id}</pre>
<h3>~?test= query</h3>
<pre>{$request->test}</pre>
HTM;

        $html .= sprintf('<h3>$request->url()</h3><pre>%s</pre>', $request->url());

        $html .= sprintf('<h3>$request->fullUrl()</h3><pre>%s</pre>', $request->fullUrl());

        $html .= sprintf('<h3>$request->path()</h3><pre>%s</pre>', $request->path());

        $html .= sprintf('<h3>$response->status()</h3><pre>%s</pre>', $response->status());

        $html .= sprintf('<h3>$response->content()</h3><pre>%s</pre>', $response->content());

        $response->setContent($html);

        return $html;
    }
}
