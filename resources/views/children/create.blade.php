@extends('layout-app.base')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2>إضافة طفل جديد</h2>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">بيانات الطفل</h3>
    </div>
    <form action="{{ route('children.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name"><strong>الاسم الكامل:</strong></label>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="birthdate"><strong>تاريخ الميلاد :</strong></label>
                <input type="date" name="birthdate" class="form-control" placeholder="Birthdate">
            </div>
            <div class="form-group">
                <label for="gender"><strong>الجنس :</strong></label>
                <select name="gender" class="form-control">
                    <option value="ذكر">ذكر</option>
                    <option value="أنثى">أنثى</option>
                </select>
            </div>
            <div class="form-group">
                <label for="parents_id"><strong>ولي اﻷمر :</strong></label>
                <select name="parents_id" class="form-control" id="parents_id">
                    <option value="">اختر من القائمة</option>
                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-sm btn-success mt-2" data-toggle="modal" data-target="#newParentModal"><i class="fas fa-plus-circle"></i> إضافة ولي أمر جديد</button>
            </div>
            <div class="form-group">
                <label for="address"><strong>العنوان:</strong></label>
                <input type="text" name="address" class="form-control" placeholder="Address">
            </div>
            <div class="form-group">
                <label for="phone_number"><strong>رقم الهاتف:</strong></label>
                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
            </div>
            <div class="form-group">
                <label for="image"><strong>صورة شخصية:</strong></label>
                <input type="file" name="image" class="form-control">
            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> حفظ</button>
        </div>
    </form>
</div>

<!-- New Parent Modal -->
<div class="modal fade" id="newParentModal" tabindex="-1" role="dialog" aria-labelledby="newParentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newParentModalLabel">إضافة ولي أمر جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="newParentForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="parent_name">الاسم الكامل :</label>
                        <input type="text" class="form-control" id="parent_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="parent_relationship">العلاقة بالطفل:</label>
                        <input type="text" class="form-control" id="parent_relationship" name="relationship" required>
                    </div>
                    <div class="form-group">
                        <label for="parent_email">الإيميل:</label>
                        <input type="email" class="form-control" id="parent_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="parent_phone">رقم الهاتف :</label>
                        <input type="text" class="form-control" id="parent_phone" name="phone_number" required>
                    </div>
                    <div class="form-group">
                        <label for="parent_job">الوظيفة:</label>
                        <input type="text" class="form-control" id="parent_job" name="job" required>
                    </div>
                    <!-- Add other parent fields as needed -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
    $(document).ready(function() {
        $('#newParentForm').on('submit', function(e) {
            e.preventDefault();

            var parentName = $('#parent_name').val();
            var parentEmail = $('#parent_email').val();
            var parentPhone = $('#parent_phone').val();
            var parentRelationship = $('#parent_relationship').val();
            var parentJob = $('#parent_job').val();

            $.ajax({
                url: '{{ route('parents.storeAjax') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name: parentName,
                    email: parentEmail,
                    phone_number: parentPhone,
                    relationship: parentRelationship,
                    job: parentJob,
                },
                success: function(response) {
                    // Assuming the response contains the new parent's ID and name
                    var newParent = $('<option></option>')
                        .attr('value', response.id)
                        .text(response.name)
                        .prop('selected', true);

                    $('#parents_id').append(newParent);
                    $('#newParentModal').modal('hide');
                },
                error: function(response) {
                    console.log('Error:', response);
                    // Handle validation errors
                }
            });
        });
    });
</script>
@endsection
