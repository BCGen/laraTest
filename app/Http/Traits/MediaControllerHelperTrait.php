<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait MediaControllerHelperTrait
{
    use ControllerHelperTrait;
    use MediaTrait;

    public function store(Request $request)
    {
        $data = array_merge($this->validateData(), $this->uploadFiles());

        // 創建model 並取得 id
        $model = $this->getModel()::create($data);

        // 檢查是否有 hasMany array屬性，如果有則新建model
        $this->createChildModel($model, $data);

        return redirect($this->getRedirect())->with('message', __('message.create_successful'));
    }

    public function update(Request $request, $id)
    {
        // 取得 model
        $model = $this->getModel($id);

        $data = array_merge($this->validateData(), $this->uploadFiles());

        $model->update($data);

        // 檢查是否有 hasMany array屬性，如果有則新建model
        $this->createChildModel($model, $data);

        return redirect($this->getRedirect())->with('message', __('message.update_successful'));
    }

    public function destroy($id)
    {
        $model = $this->getModel($id);

        $model->delete();

        $this->deleteChildModel($model);

    }

    protected function uploadFiles()
    {
        $validateData = $this->validateData();
        $fileInfo = [];

        if (count(request()->file()) !== 0) {

            foreach (request()->file() as $key => $file) {

                if (array_key_exists($key, $validateData)) {

                    $fieldName = $this->getFieldName($key);

                    if (!is_array($file)) {
                        $info = $this->storeFile($file, $this->getStorePath());

                        $fileInfo = array_merge(
                            $fileInfo,
                            [
                                "{$fieldName}_name" => $info['file_name'],
                                "{$fieldName}_url" => $info['file_url'],
                            ]
                        );
                    } else {
                        $fileInfo[$fieldName] = $this->storeFiles($file, $this->getStorePath());
                    }
                }
            }
        }

        return $fileInfo;
    }

    protected function createChildModel($model, $data)
    {
        if (property_exists($this, 'hasMany') && gettype($this->hasMany) === 'array') {
            foreach ($this->hasMany as $childModel => $field) {
                if (array_key_exists($field, $data)) {
                    $model->hasMany($childModel)->createMany($data[$field]);
                }
            }
        }
    }

    protected function deleteChildModel($model)
    {
        if (property_exists($this, 'hasMany') && gettype($this->hasMany) === 'array') {
            foreach (array_keys($this->hasMany) as $childModel) {
                foreach($model->hasMany($childModel)->get() as $data) {
                    $data->delete();
                };
            }
        }
    }

    protected function getStorePath()
    {
        return "public/" . camel_case($this->modelName());
    }

    protected function getFieldName($key)
    {
        return starts_with($key, 'upload_') ? str_replace_first('upload_', '', $key) : $key;
    }
}
