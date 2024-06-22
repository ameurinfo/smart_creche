@extends('layout-app.base')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5>تحيين السجل التراكمي</h5>
        </div>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <div class="card-body">
            <form action="{{ route('children.storeCumulativeRecord', $student->id) }}" method="POST">
                @csrf
                <!-- بيانات الطفل -->
                <div class="form-group">
                    <label for="age">العمر الزمني:</label>
                    <input type="text" name="age" class="form-control" placeholder="العمر الزمني">
                </div>
                <div class="form-group">
                    <label for="mental_age">العمر العقلي:</label>
                    <input type="text" name="mental_age" class="form-control" placeholder="العمر العقلي">
                </div>
                <div class="form-group">
                    <label for="disability">نوع الإعاقة ان وجدت:</label>
                    <input type="text" name="disability" class="form-control" placeholder="نوع الإعاقة ان وجدت">
                </div>

                <!-- بيانات الاسرة -->
                <h4>بيانات الاسرة</h4>
                <div class="form-group">
                    <label for="family_members">عدد افراد الاسرة:</label>
                    <input type="text" name="family_members" class="form-control" placeholder="عدد افراد الاسرة">
                </div>
                <div class="form-group">
                    <label for="siblings">عدد الاخوة:</label>
                    <input type="text" name="siblings" class="form-control" placeholder="عدد الاخوة">
                </div>
                <div class="form-group">
                    <label for="parents">الولي:</label>
                    <input type="text" name="parents" class="form-control" placeholder="الولي">
                </div>
                <div class="form-group">
                    <label for="child_order">ترتيب الطفل في العائلة:</label>
                    <input type="text" name="child_order" class="form-control" placeholder="ترتيب الطفل في العائلة">
                </div>
                <div class="form-group">
                    <label for="living_with">مع من يعيش الطفل:</label>
                    <input type="text" name="living_with" class="form-control" placeholder="مع من يعيش الطفل">
                </div>
                <div class="form-group">
                    <label for="economic_status">الحالة الاقتصادية:</label>
                    <input type="text" name="economic_status" class="form-control" placeholder="الحالة الاقتصادية">
                </div>
                <div class="form-group">
                    <label for="home_status">أجواء المنزل:</label>
                    <input type="text" name="home_status" class="form-control" placeholder="أجواء المنزل">
                </div>

                <!-- بيانات الطفل الصحية -->
                <h4>بيانات الطفل الصحية</h4>
                <div class="form-group">
                    <label>السمع:</label>
                    <input type="text" name="hearing" class="form-control" placeholder="السمع">
                </div>
                <div class="form-group">
                    <label>البصر:</label>
                    <input type="text" name="vision" class="form-control" placeholder="البصر">
                </div>
                <div class="form-group">
                    <label>الذوق:</label>
                    <input type="text" name="taste" class="form-control" placeholder="الذوق">
                </div>
                <div class="form-group">
                    <label>اللمس:</label>
                    <input type="text" name="touch" class="form-control" placeholder="اللمس">
                </div>
                <div class="form-group">
                    <label>النطق:</label>
                    <input type="text" name="speech" class="form-control" placeholder="النطق">
                </div>
                <div class="form-group">
                    <label>مصاب بمرض مزمن:</label>
                    <div class="form-check">
                        <input type="radio" name="chronic_disease" value="yes" class="form-check-input"
                            id="chronic_disease_yes">
                        <label for="chronic_disease_yes" class="form-check-label">نعم</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="chronic_disease" value="no" class="form-check-input"
                            id="chronic_disease_no">
                        <label for="chronic_disease_no" class="form-check-label">لا</label>
                    </div>
                </div>

                <!-- بيانات القدرات العقلية -->
                <h4>بيانات القدرات العقلية</h4>
                <div class="form-group">
                    <label>اختبارات الذكاء:</label>
                    <input type="text" name="intelligence_tests" class="form-control" placeholder="اختبارات الذكاء">
                </div>
                <div class="form-group">
                    <label>القدرات الخاصة:</label>
                    <input type="text" name="special_abilities" class="form-control" placeholder="القدرات الخاصة">
                </div>
                <div class="form-group">
                    <label>تاريخ اجرائها وتقرير النفسانيين:</label>
                    <input type="text" name="psychological_tests" class="form-control"
                        placeholder="تاريخ اجرائها وتقرير النفسانيين">
                </div>

                <!-- بيانات الجانب المعرفي -->
                <h4>بيانات الجانب المعرفي</h4>
                <div class="form-group">
                    <label>الادراك:</label>
                    <div class="form-check">
                        <input type="checkbox" name="cognitive[]" value="إدراك الذات" class="form-check-input"
                            id="self_awareness">
                        <label for="self_awareness" class="form-check-label">إدراك الذات</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="cognitive[]" value="إدراك الاسم" class="form-check-input"
                            id="name_awareness">
                        <label for="name_awareness" class="form-check-label">إدراك الاسم</label>
                    </div>
                    <!-- Add other cognitive checkboxes similarly -->
                </div>

                <div class="form-group">
                    <label>اللانتباه والتركيز:</label>
                    <input type="text" name="attention_concentration" class="form-control"
                        placeholder="اللانتباه والتركيز">
                </div>
                <div class="form-group">
                    <label>الذاكرة:</label>
                    <div class="form-check">
                        <input type="checkbox" name="memory[]" value="قريبة المدى" class="form-check-input"
                            id="short_term_memory">
                        <label for="short_term_memory" class="form-check-label">قريبة المدى</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="memory[]" value="متوسطة المدى" class="form-check-input"
                            id="medium_term_memory">
                        <label for="medium_term_memory" class="form-check-label">متوسطة المدى</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="memory[]" value="بعيدة المدى" class="form-check-input"
                            id="long_term_memory">
                        <label for="medium_term_memory" class="form-check-label">بعيدة المدى</label>
                    </div>
                </div>
                    <!-- الاستقلالية -->
                    <h4>الاستقلالية</h4>
                    <div class="form-group">
                        <label>الأكل:</label>
                        <input type="text" name="eating" class="form-control" placeholder="الأكل">
                    </div>
                    <div class="form-group">
                        <label>النظافة:</label>
                        <input type="text" name="cleanliness" class="form-control" placeholder="النظافة">
                    </div>
                    <div class="form-group">
                        <label>اللباس:</label>
                        <input type="text" name="dressing" class="form-control" placeholder="اللباس">
                    </div>

                    <!-- النشاطات -->
                    <h4>النشاطات</h4>
                    <div class="form-group">
                        <label>الجانب النفسي الحركي:</label>
                        <div class="form-check">
                            <input type="checkbox" name="activities[]" value="المشي" class="form-check-input"
                                id="walking">
                            <label for="walking" class="form-check-label">المشي</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="activities[]" value="الجري" class="form-check-input"
                                id="running">
                            <label for="running" class="form-check-label">الجري</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" name="activities[]" value="الحركات الدقيقة" class="form-check-input"
                                id="fine_movements">
                            <label for="fine_movements" class="form-check-label">الحركات الدقيقة</label>
                        </div>
                    </div>

                    <!-- الجانب الانفعالي -->
                    <h4>الجانب الانفعالي</h4>
                    <div class="form-group">
                        <label>شديد الانفعال:</label>
                        <input type="text" name="highly_emotional" class="form-control" placeholder="شديد الانفعال">
                    </div>
                    <div class="form-group">
                        <label>منطوي:</label>
                        <input type="text" name="introverted" class="form-control" placeholder="منطوي">
                    </div>

                    <div class="form-group text-center mt-4">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> حفظ </button>
                    </div>
            </form>
        </div>
    </div>
@endsection
