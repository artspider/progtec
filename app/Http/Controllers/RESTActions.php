<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

trait RESTActions
{

    public function all(Request $request)
    {
        if ($request->isJson()) {
            $m = self::MODEL;
            return $this->respond(Response::HTTP_OK, $m::all());
        }
        return $this->respond(Response::HTTP_BAD_REQUEST, ['error' => 'Tipo de peticion no soportada']);
    }

    public function get(Request $request, $id)
    {
        if ($request->isJson()) {
            $m = self::MODEL;
            if ($m == "App\Programmer") {
                $model = $m::with('projects')->find($id);
            } else {
                $model = $m::with('programmer')->find($id);
            }
            if (is_null($model)) {
                return $this->respond(Response::HTTP_NOT_FOUND, ['error' => 'Registro no encontrado']);
            }
            return $this->respond(Response::HTTP_OK, $model);
        }
        return $this->respond(Response::HTTP_BAD_REQUEST, ['error' => 'Tipo de peticion no soportada']);
    }

    public function add(Request $request)
    {
        if ($request->isJson()) {
            $m = self::MODEL;
            $this->validate($request, $m::$rules);
            return $this->respond(Response::HTTP_CREATED, $m::create($request->all()));
        }
        return $this->respond(Response::HTTP_BAD_REQUEST, ['error' => 'Tipo de peticion no soportada']);
    }

    public function put(Request $request, $id)
    {
        if ($request->isJson()) {
            $m = self::MODEL;
            $this->validate($request, $m::$rules);
            $model = $m::find($id);
            if (is_null($model)) {
                return $this->respond(Response::HTTP_NOT_FOUND);
            }
            $model->update($request->all());
            return $this->respond(Response::HTTP_OK, $model);
        }
        return $this->respond(Response::HTTP_BAD_REQUEST, ['error' => 'Tipo de peticion no soportada']);
    }

    public function remove(Request $request, $id)
    {
        if ($request->isJson()) {
            $m = self::MODEL;
            if (is_null($m::find($id))) {
                return $this->respond(Response::HTTP_NOT_FOUND);
            }
            $m::destroy($id);
            return $this->respond(Response::HTTP_ACCEPTED);
        }
        return $this->respond(Response::HTTP_BAD_REQUEST, ['error' => 'Tipo de peticion no soportada']);
    }

    protected function respond($status, $data = [])
    {
        return response()->json($data, $status);
    }
}
