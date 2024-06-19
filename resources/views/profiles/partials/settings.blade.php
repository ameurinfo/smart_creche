<section>
<h2 class="text-lg font-medium text-gray-900">
    تحديث كلمة المرور
</h2>
<p class="mt-1 text-sm text-gray-600">
    تأكد من أن حسابك يستخدم كلمة مرور طويلة وعشوائية للبقاء آمنًا.
</p>
<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="name">كلمة المرور الحالية  </label>
        <input id="update_password_current_password" name="current_password" type="password" class="form-control"
            autocomplete="current-password" required/>
    </div>
    <div class="form-group">
        <label for="name">كلمة مرور جديدة</label>
        <input id="update_password_password" name="password" type="password" class="form-control"
            autocomplete="new-password" required/>
    </div>
    <div class="form-group">
        <label for="name">تأكيد كلمة المرور </label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
        class="form-control" autocomplete="new-password" required/>
    </div>
    <button type="submit" class="btn btn-danger"><i class="fas fa-edit"></i> تحديث</button>
</form>
</section>
