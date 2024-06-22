@extends('layout-app.base')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>متابعة نفسية</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('children.storePsychologyFollowUp', $student->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <div class="form-group">
                        <label for="dailyMood"> مزاج الطفل اليومي</label>
                        <input class="form-control" type="text" id="dailyMood" name="dailyMood">
                    </div>
                    <div class="form-group">
                        <label for="abnormalBehaviors"> سلوكات غير سوية</label>
                        <input class="form-control" type="text" id="abnormalBehaviors" name="abnormalBehaviors">
                    </div>
                    <div class="form-group">
                        <label for="psychologicalConsultations">استشارات نفسية</label>
                        <input class="form-control" type="text" name="psychologicalConsultations" id="psychologicalConsultations" placeholder="غير متاح حاليا" readonly>
                    </div>
                </div>

                <div class="form-group text-center mt-4">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> حفظ </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
