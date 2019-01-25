<?php

// namespace App\Http\Traits;

use Illuminate\Http\Request;

trait ControllerHelperTrait
{
    public function index()
    {
        if (class_exists($this->getModel())) {
            if (isset($this->sort) && $this->sort === false) {
                $list = $this->getModel()::all();
            } else {
                $list = $this->getModel()::all()->sortByDesc('sort');
            }
        }

        return $this->makeResponse(isset($list) ?? compact('list'));
    }

    public function create()
    {
        return view($this->getView());
    }

    public function store(Request $request)
    {
        $this->getModel()::create($this->validateData());

        return redirect($this->getRedirect())->with('message', __('message.create_successful'));
    }

    public function show($id)
    {
        $item = $this->getModel($id);

        return $this->makeResponse(compact('item'));
    }

    public function edit($id)
    {
        $item = $this->getModel($id);

        return $this->makeResponse(compact('item'));
    }

    public function update(Request $request, $id)
    {
        $this->getModel($id)->update($this->validateData());

        return redirect($this->getRedirect())->with('message', __('message.update_successful'));
    }

    public function destroy($id)
    {
        $this->getModel($id)->delete();
    }

    // Helper function
    protected function modelName()
    {
        return str_before(class_basename(get_called_class()), 'Controller');
    }

    protected function getView($name = null)
    {
        $name = $name ? $name : debug_backtrace()[1]['function'];

        if (property_exists($this, $name)) {
            return $this->index;
        } else {
            return "admin." . camel_case($this->modelName()) . "." . $name;
        }
    }

    protected function getRedirect()
    {
        $redirect = 'admin/' . snake_case($this->modelName());
        return property_exists($this, 'redirect') ? $this->redirect : $redirect;
    }

    protected function getModel($id = null)
    {
        $model = property_exists($this, 'model') ? $this->model : "\\App\\{$this->modelName()}";
        return $id ? ($model::findOrFail($id)) : $model;
    }

    protected function makeResponse($data = null)
    {
        $view = $this->getView(debug_backtrace()[1]['function']);


        if (!$data) {
            return view($view);
        }
        dd($data);
        return request()->ajax() ? response()->json($data) : view($view, $data);
    }

    protected function validateData()
    {
        return $this->hasValidateMethod() ? $this->validateRequest() : request()->all();
    }

    protected function hasValidateMethod()
    {
        return method_exists($this, 'validateRequest');
    }
}
