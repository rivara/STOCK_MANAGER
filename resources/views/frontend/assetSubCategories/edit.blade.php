@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.assetSubCategory.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.asset-sub-categories.update", [$assetSubCategory->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="asset_category_id">{{ trans('cruds.assetSubCategory.fields.asset_category') }}</label>
                            <select class="form-control select2" name="asset_category_id" id="asset_category_id" required>
                                @foreach($asset_categories as $id => $asset_category)
                                    <option value="{{ $id }}" {{ (old('asset_category_id') ? old('asset_category_id') : $assetSubCategory->asset_category->id ?? '') == $id ? 'selected' : '' }}>{{ $asset_category }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('asset_category'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('asset_category') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.assetSubCategory.fields.asset_category_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="asset_subcategory">{{ trans('cruds.assetSubCategory.fields.asset_subcategory') }}</label>
                            <input class="form-control" type="text" name="asset_subcategory" id="asset_subcategory" value="{{ old('asset_subcategory', $assetSubCategory->asset_subcategory) }}" required>
                            @if($errors->has('asset_subcategory'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('asset_subcategory') }}
                                </div>
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

        </div>
    </div>
</div>
@endsection