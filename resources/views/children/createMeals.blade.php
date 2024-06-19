@extends('layout-app.base')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <strong><i class="fas fa-edit"></i> تتبع الوجبات</strong>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h5>وجبات سابقة</h5>
                    
                    @if ($previousMeals->isEmpty())
                        <p>لا توجد وجبات مسجلة في الوقت الحالي.</p>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>تاريخ الوجبة</th>
                                    <th>نوع الوجبة</th>
                                    <th>وصف الوجبة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($previousMeals as $meal)
                                    <tr>
                                        <td>{{ $meal->date }}</td>
                                        <td>{{ $meal->meal_type }}</td>
                                        <td>{{ $meal->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    @unless(Auth::user()->hasRole('parents'))
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMealModal">
                        <i class="fas fa-plus"></i> إضافة وجبة جديدة
                    </button>
                    @endunless
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addMealModal" tabindex="-1" role="dialog" aria-labelledby="addMealModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMealModalLabel">إضافة وجبة جديدة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('children.storeMeals') }}">
                    @csrf
                    <div class="form-group">
                        <label for="dateMeals">تاريخ الوجبة:</label>
                        <div class="input-group">
                            <input type="date" name="dateMeals" id="dateMeals" class="form-control" value="{{ $currentDate }}" required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" id="toggleDateBtn">اليوم</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="typeMeals">نوع الوجبة:</label>
                        <select name="typeMeals" id="typeMeals" class="form-control" required>
                            <option value="">اختر نوع الوجبة</option>
                            <option value="فطور">فطور</option>
                            <option value="غداء">غداء</option>
                            <option value="عشاء">عشاء</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descriptionMeals">وصف الوجبة:</label>
                        <input type="text" name="descriptionMeals" id="descriptionMeals" class="form-control" required>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAllStudents">
                                        <label class="form-check-label" for="selectAllStudents">تحديد الكل</label>
                                    </div>
                                </th>
                                <th>اسم الطفل</th>
                                <th>توقيت الحضور</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendedStudents as $studentAttendances)
                                @foreach ($studentAttendances as $attendance)
                                    @if ($attendance->departure_time === null)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input studentCheckbox" type="checkbox" name="students[{{ $attendance->child_id }}]" value="1">
                                                </div>
                                            </td>
                                            <td>{{ $attendance->child->name }}</td>
                                            <td>{{ $attendance->arrival_time }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check-circle"></i> تسجيل الوجبة</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var selectAllStudents = document.getElementById('selectAllStudents');
    var studentCheckboxes = document.querySelectorAll('.studentCheckbox');

    selectAllStudents.addEventListener('change', function() {
        studentCheckboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllStudents.checked;
        });
    });

    studentCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var allChecked = Array.from(studentCheckboxes).every(function(cb) {
                return cb.checked;
            });
            selectAllStudents.checked = allChecked;
        });
    });

    document.getElementById('toggleDateBtn').addEventListener('click', function() {
        var dateInput = document.getElementById('dateMeals');
        var currentDate = new Date().toISOString().split('T')[0];
        dateInput.value = dateInput.value === currentDate ? '' : currentDate;
    });
});
</script>
@endsection
