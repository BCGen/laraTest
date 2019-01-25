@extends('layouts.admin.app')

@section('content')
    <base-card title="Demo - 新增">
        <base-form>
            <form-groups label-class="col-1 col-form-label" input-class="col-11" form-controller>

                <form-group label="姓名">
                    <input id="name">
                </form-group>

                <form-group label="上傳">
                    <input id="upload_file" type="file">
                </form-group>

            </form-groups>

            <hr>
        </base-form>
    </base-card>
@endsection
