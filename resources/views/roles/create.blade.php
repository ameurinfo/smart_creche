@extends('layout-app.base')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2>إضافة مهمة جديدة</h2>
            <div class="float-end">
                <a class="btn btn-primary" href="{{ route('roles.index') }}">رجوع</a>
            </div>
        </div>
    </div>
</div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name"><strong>المهمة:</strong></label>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="permissions"><strong>التراخيص المتعلق بها:</strong></label>
                    <div class="row">
                        @foreach ($permission->chunk(10) as $chunk)
                            <div class="col-md-4">
                                @foreach ($chunk as $value)
                                    <div class="form-check">
                                        <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="form-check-input">
                                        <label class="form-check-label">{{ $value->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>
@endsection
