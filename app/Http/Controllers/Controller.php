<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundHttpException;
use Illuminate\Http\Request;

abstract class Controller
{
    protected $model;
    protected $request;

    public function index() {
        $formRequestClass = $this->getFormRequestClass();
        $rules = [];

        if (class_exists($formRequestClass)) {
            $request = new $formRequestClass();
            $rules = $request->rules();
        }

        $query = $this->model::query();
        $filters = $this->request->all();

        // Filtros extras além do fillable
        $othersFillableFields = [];

        // Filtra todos os campos que estão na propriedade fillable da model
        foreach ($filters as $field => $value) {
            if (in_array($field, $this->model->getFillable()) || in_array($field, $othersFillableFields)) {
                if (isset($rules[$field]) && str_contains($rules[$field], 'string')){
                    $query->where($field, 'like', '%'.trim($value).'%');
                    continue;
                }

                $query->where($field, $value);
            }
        }

        // Ordenação
        $query->orderBy('id', 'desc');

        $data = $query->get();
        $data = $this->convertDataToResourceCollection($data);

        return response()->json($data, 200);
    }

    public function show($id) {
        $data = $this->model::find($id);

        if (!$data) {
            throw new NotFoundHttpException();
        }

        $data = $this->convertDataToResource($data);
        
        return response()->json($data, 200);
    }

    public function store(Request $request) {
        $requestData = $this->validateRequest($request);
        
        $data = $this->model::create($requestData);

        return response()->json($data, 201);
    }

    public function update(Request $request, $id) {
        $data = $this->model::find($id);

        if (!$data) {
            throw new NotFoundHttpException();
        }

        $requestData = $this->validateRequest($request);
        $data->update($requestData);

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $data = $this->model::find($id);

        if (!$data) {
            throw new NotFoundHttpException();
        }

        $data->delete();

        return response()->noContent();
    }

    protected function getFormRequestClass(): string {
        $modelClass = class_basename($this->model);
        $requestClass = "App\\Http\\Requests\\{$modelClass}Request";

        return $requestClass;
    }

    protected function validateRequest(Request $request): mixed {
        $formRequestClass = $this->getFormRequestClass();

        if (class_exists($formRequestClass)) {
            $formRequest = app($formRequestClass);
            $data = $formRequest->validated();
        } else {
            $data = $request->all();
        }

        return $data;
    }

    protected function getResourceClass(): string {
        $modelClass = class_basename($this->model);
        $requestClass = "App\\Http\\Resources\\{$modelClass}Resource";

        return $requestClass;
    }

    protected function convertDataToResource(mixed $data): mixed {
        $resourceClass = $this->getResourceClass();

        if (class_exists($resourceClass)) {
            $data = new $resourceClass($data);
        }

        return $data;
    }

    protected function convertDataToResourceCollection(mixed $data): mixed {
        $resourceClass = $this->getResourceClass();

        if (class_exists($resourceClass)) {
            $data = $resourceClass::collection($data);
        }

        return $data;
    }
}
