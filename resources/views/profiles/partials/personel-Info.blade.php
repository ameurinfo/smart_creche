<section>
    <h2 class="text-lg font-medium text-gray-900">
        تحديث البيانات الشخصية
    </h2>
    <form method="post" action="{{ route('profiles.update', $user->id) }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">الاسم الكامل </label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="job">الوظيفة </label>
            @if(Auth::user()->hasRole('parents'))
                <input type="text" class="form-control" id="job" name="job" value="{{ $user->parent->job }}">
            @else
                <input type="text" class="form-control" id="job_title" name="job_title"
                    value="{{ $user->staff->job_title }}">
            </div>
            <div class="form-group">
                <label for="birthdate">تاريخ الميلاد </label>
                <input type="date" class="form-control" id="birthdate" name="birthdate"
                    value="{{ $user->staff->birthdate }}" required>
            </div>
        @endif
        <div class="form-group">
            <label for="phone_number">رقم الهاتف </label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" 
                value="{{ Auth::user()->hasRole('parents') ? $user->parent->phone_number : $user->staff->phone_number }}">
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-pen"></i> تحديث</button>
    </form>
</section>
