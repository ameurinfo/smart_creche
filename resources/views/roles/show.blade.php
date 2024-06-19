@extends('layout-app.base')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2>تفاصيل المهمة </h2>
            <div class="float-end">
                <a class="btn btn-primary" href="{{ route('roles.index') }}">رجوع</a>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5>معلومات المهمة</h5>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <strong>المهمة:</strong>
                        <p class="form-control">{{ $role->name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5>التراخيص المتعلقة بها</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if (!empty($rolePermissions))
                            @php
                                $chunks = $rolePermissions->chunk(10);
                            @endphp
                            @foreach ($chunks as $chunk)
                                <div class="col-md-6">
                                    @foreach ($chunk as $v)
                                        <label class="badge bg-secondary">{{ $v->name }}</label>
                                    @endforeach
                                </div>
                            @endforeach
                        @else
                            <p>ليس هناك أي تراخيص متاحة</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
