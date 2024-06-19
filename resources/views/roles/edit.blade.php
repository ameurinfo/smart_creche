@extends('layout-app.base')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2>تعديل المهمة </h2>
            <div class="float-end">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> رجوع</a>
            </div>
        </div>
    </div>
</div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <strong>المهمة :</strong>
                    <input type="text" value="{{ $role->name }}" name="name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <strong>التراخيص المتعلقة بها:</strong>
                    <br />
                    <div class="row">
                        @php
                            $chunks = $permission->chunk(10);
                        @endphp
                        @foreach ($chunks as $chunk)
                            <div class="col-md-4">
                                @foreach ($chunk as $value)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permission[]" value="{{ $value->id }}"
                                            @if (in_array($value->id, $rolePermissions)) checked @endif>
                                        <label class="form-check-label">{{ $value->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </div>
    </form>
@endsection
