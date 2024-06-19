@extends('layout-app.base')

@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="{{Auth::user()->hasRole('parents') ? (Auth::user()->parent->image ? asset('storage/' . Auth::user()->parent->image) : asset('backend/dist/img/userProfile.png')) : (Auth::user()->staff->image ? asset('storage/' . Auth::user()->staff->image) : asset('backend/dist/img/userProfile.png')) }}"
                            alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                    <p class="text-muted text-center">{{ Auth::user()->email }}</p>

                    <a href="#" id="image" class="btn btn-primary btn-block"><b>تعديل الصورة</b></a>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#personel_info" data-toggle="tab"><i
                                    class="fas fa-info-circle"></i> البيانات الشخصية</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab"> <i
                                    class="fas fa-cogs"></i> إعدادات الحساب</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="personel_info">
                            @include('profiles.partials.personel-Info')
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="settings">
                            @include('profiles.partials.settings')
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Modal for Image Upload -->
    <div class="modal fade" id="imageUploadModal" tabindex="-1" role="dialog" aria-labelledby="imageUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageUploadModalLabel">تعديل الصورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="imageUploadForm" method="post" action="{{ route('profiles.updateImage', Auth::user()->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="profile_image">اختر صورة</label>
                            <input type="file" class="form-control-file" id="profile_image" name="profile_image" accept="image/*">
                        </div>
                        <div class="form-group">
                            <img id="imagePreview" src="#" alt="Preview" class="img-fluid img-circle d-none" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" id="saveImageBtn">حفظ</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer')
    <script>
        document.getElementById('image').addEventListener('click', function () {
            $('#imageUploadModal').modal('show');
        });

        document.getElementById('profile_image').addEventListener('change', function (event) {
            let reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('d-none');
            }
            reader.readAsDataURL(event.target.files[0]);
        });

        document.getElementById('saveImageBtn').addEventListener('click', function () {
            document.getElementById('imageUploadForm').submit();
        });
    </script>
    @endsection
