@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.assetSubCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.asset-sub-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="asset_category_id">{{ trans('cruds.assetSubCategory.fields.asset_category') }}</label>
                <select class="form-control select2 {{ $errors->has('asset_category') ? 'is-invalid' : '' }}" name="asset_category_id" id="asset_category_id" required>
                    @foreach($asset_categories as $id => $asset_category)
                        <option value="{{ $id }}" {{ old('asset_category_id') == $id ? 'selected' : '' }}>{{ $asset_category }}</option>
                    @endforeach
                </select>
                @if($errors->has('asset_category'))
                    <span class="text-danger">{{ $errors->first('asset_category') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetSubCategory.fields.asset_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="asset_subcategory">{{ trans('cruds.assetSubCategory.fields.asset_subcategory') }}</label>
                <input class="form-control {{ $errors->has('asset_subcategory') ? 'is-invalid' : '' }}" type="text" name="asset_subcategory" id="asset_subcategory" value="{{ old('asset_subcategory', '') }}" required>
                @if($errors->has('asset_subcategory'))
                    <span class="text-danger">{{ $errors->first('asset_subcategory') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.assetSubCategory.fields.asset_subcategory_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection