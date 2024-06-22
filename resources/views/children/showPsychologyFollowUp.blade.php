@extends('layout-app.base')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5> تفاصيل المتابعة النفسية: {{$student->name}}</h5>
        </div>
        <div class="card-body">
            @if ($student->psychological_follow_up->count() > 0)
                                @foreach ($student->psychological_follow_up as $item)
                                    <div class="timeline timeline-inverse">

                                        <div class="time-label">
                                            <span class="bg-warning">
                                                {{ $item->created_at->format('Y-m-d') }}
                                            </span>
                                        </div>
                                        <div>
                                            <i class="fas fa-info bg-primary"></i>
                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i>
                                                    {{ $item->created_at->format('H:i:s') }}</span>
                                                <h3 class="timeline-header">تفصيل المتابعة النفسية</h3>
                                                <div class="timeline-body">
                                                    <dl>
                                                        <dt>مزاج الطفل اليومي</dt>
                                                        <dd>{{ $item->dailyMood }}</dd>

                                                    </dl>
                                                    <dl>
                                                        <dt>سلوكات غير سوية </dt>
                                                        <dd>{{ $item->abnormalBehaviors }}</dd>

                                                    </dl>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                لم يتم العثور على سجلات المتابعة النفسية
                                @endif
        </div>
    </div>
@endsection