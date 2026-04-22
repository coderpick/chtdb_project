<!DOCTYPE html>
<html lang="bn">

<head>
    @include('layouts.frontend.partials.head')
    @stack('styles')
</head>

<body>

    @include('layouts.frontend.partials.header')

    <!-- Marquee -->
    <div class="marquee-bar">
        <div class="marquee-content">
            {{ \App\Models\Setting::get('marquee_text', '📢 তিন পার্বত্য জেলার বেকার যুবক যুবতীদের তথ্য ও যোগাযোগ প্রযুক্তি বিষয়ক দক্ষতা উন্নয়ন ও আত্মকর্মসংস্থান সুযোগ সৃষ্টিকরণ স্কিম — পার্বত্য চট্টগ্রাম উন্নয়ন বোর্ড ও PeopleNTech এর যৌথ উদ্যোগে ২১৫+ শিক্ষার্থী প্রশিক্ষিত — রাঙামাটি | খাগড়াছড়ি | বান্দরবান 🏔️') }}
        </div>
    </div>

    @yield('content')
    @include('layouts.frontend.partials.footer')
    @include('layouts.frontend.partials.script')
    @stack('scripts')
</body>

</html>
