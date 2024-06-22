@extends('layout-app.base')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb mb-4">
        <div class="pull-left">
            <h2>تربية وتعديل السلوك</h2>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success my-2">
  <p>{{ $message }}</p>
</div>
@endif

<form action="{{ route('children.behaviorModification') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            <h5>تربية وتعديل السلوك</h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="behavior1" name="behavior[]" value="الخوف">
                    <label class="custom-control-label" for="behavior1">الخوف</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="behavior2" name="behavior[]" value="السلوك العدواني">
                    <label class="custom-control-label" for="behavior2">السلوك العدواني</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="behavior3" name="behavior[]" value="التغذية">
                    <label class="custom-control-label" for="behavior3">التغذية</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="behavior4" name="behavior[]" value="النوم">
                    <label class="custom-control-label" for="behavior4">النوم</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="behavior5" name="behavior[]" value="التبول اللاإرادي">
                    <label class="custom-control-label" for="behavior5">التبول اللاإرادي</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="behavior6" name="behavior[]" value="الغيرة">
                    <label class="custom-control-label" for="behavior6">الغيرة</label>
                </div>
            </div>

            <!-- Appreciation Points Section -->
            <div class="form-group mt-4">
                <label for="appreciation_points"><strong>نقاط التقييم:</strong></label>
                <textarea class="form-control" id="appreciation_points" name="appreciation_points" rows="4" placeholder="Enter appreciation points..."></textarea>
            </div>

            <!-- Interactive Images Section -->
            <div class="form-group mt-4">
                <label><strong>Click on the images to record points:</strong></label>
                <div>
                    <img src="{{ asset('path/to/your/image1.jpg') }}" alt="Image 1" class="clickable-image" data-counter="0">
                    <img src="{{ asset('path/to/your/image2.jpg') }}" alt="Image 2" class="clickable-image" data-counter="0">
                </div>
            </div>

            <!-- Hidden input to store points -->
            <input type="hidden" name="image_clicks" id="image_clicks" value="">

        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>

@endsection

@section('footer')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const images = document.querySelectorAll('.clickable-image');
        images.forEach(image => {
            image.addEventListener('click', function () {
                let counter = parseInt(this.getAttribute('data-counter')) + 1;
                this.setAttribute('data-counter', counter);
                alert('You have clicked ' + counter + ' times on this image.');

                // Update the hidden input with the clicks count
                let imageClicks = '';
                images.forEach(img => {
                    imageClicks += img.alt + ': ' + img.getAttribute('data-counter') + ' times\n';
                });
                document.getElementById('image_clicks').value = imageClicks;
            });
        });
    });
</script>
@endsection
