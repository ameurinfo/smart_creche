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
            <h5>السلوك غير السوي</h5>
        </div>
        <div class="card-body">
            @foreach(['الخوف', 'السلوك العدواني', 'التغذية', 'النوم', 'التبول اللاإرادي', 'الغيرة'] as $index => $behavior)
             <div class="form-group">
                    <label for="behavior{{ $index + 1 }}">{{ $behavior }}</label>
                    <input type="text" class="form-control" id="behavior{{ $index + 1 }}" name="behavior[]" value="{{ $behavior }}">
                </div>
                @endforeach
            </div>
                
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>تعديل السلوك (خطة)</h5>
        </div>
        <div class="card-body">
            <p>غير متاح حاليا</p>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>نقاط الاستحسان</h5>
        </div>
        <div class="card-body">
            <!-- Appreciation Points Section -->
            <div class="form-group mt-4">
                <label><strong>نقاط التقييم:</strong></label>
                <div class="rating-container">
                    @for ($i = 0; $i <= 9; $i++)
                    <span class="star" data-rating="{{ $i }}">&#9733;</span>
                    @endfor
                </div>
                <input type="hidden" name="overall_rating" id="overall_rating" value="0">
            </div>
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
        const stars = document.querySelectorAll('.star');
        stars.forEach(star => {
            star.addEventListener('click', function () {
                const rating = this.dataset.rating;
                document.getElementById('overall_rating').value = rating;

                // Update the stars to reflect the selected rating
                stars.forEach(s => {
                    if (s.dataset.rating <= rating) {
                        s.classList.add('selected');
                    } else {
                        s.classList.remove('selected');
                    }
                });
            });

            star.addEventListener('mouseenter', function () {
                this.style.cursor = 'pointer';
            });
        });
    });
</script>
<style>
    .star {
        font-size: 24px; /* Increase the size of the stars */
    }
    .star.selected {
        color: gold;
    }
</style>
@endsection