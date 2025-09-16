@extends('frontend.layouts.app')

@section('title', 'Privacy Policy - Awan Global Foods')

@section('content')
    <section style="padding:60px 0; background:#f9fafb;">
        <div class="container" style="max-width:900px; margin:0 auto; background:#fff; padding:40px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.05);">

            <h1 style="font-size:28px; font-weight:700; margin-bottom:20px; color:#111827;">Privacy Policy</h1>
            <p style="color:#555; margin-bottom:30px;">
                At <strong>Awan Global Foods</strong>, your privacy is very important to us. This Privacy Policy explains how we collect, 
                use, and protect your personal information when you use our website and services.
            </p>

            <h2 style="font-size:20px; font-weight:600; margin-top:30px; margin-bottom:12px;">1. Information We Collect</h2>
            <p style="color:#555; margin-bottom:20px;">
                We may collect personal information such as your name, email address, phone number, shipping address, 
                and payment details when you shop with us or create an account.
            </p>

            <h2 style="font-size:20px; font-weight:600; margin-top:30px; margin-bottom:12px;">2. How We Use Your Information</h2>
            <ul style="color:#555; margin-bottom:20px; padding-left:20px; list-style:disc;">
                <li>To process and deliver your orders.</li>
                <li>To improve our website, products, and services.</li>
                <li>To send you promotions, offers, and important updates.</li>
                <li>To provide customer support and respond to your inquiries.</li>
            </ul>

            <h2 style="font-size:20px; font-weight:600; margin-top:30px; margin-bottom:12px;">3. Data Protection</h2>
            <p style="color:#555; margin-bottom:20px;">
                We implement strict security measures to protect your personal data from unauthorized access, misuse, 
                or disclosure. However, please note that no online platform can guarantee 100% security.
            </p>

            <h2 style="font-size:20px; font-weight:600; margin-top:30px; margin-bottom:12px;">4. Sharing of Information</h2>
            <p style="color:#555; margin-bottom:20px;">
                We do not sell or rent your personal information to third parties. We may share limited information 
                with trusted partners for payment processing, shipping, or legal compliance.
            </p>

            <h2 style="font-size:20px; font-weight:600; margin-top:30px; margin-bottom:12px;">5. Cookies</h2>
            <p style="color:#555; margin-bottom:20px;">
                Our website uses cookies to enhance user experience, track performance, and personalize content. 
                You can disable cookies in your browser settings if you prefer.
            </p>

            <h2 style="font-size:20px; font-weight:600; margin-top:30px; margin-bottom:12px;">6. Your Rights</h2>
            <p style="color:#555; margin-bottom:20px;">
                You have the right to access, update, or delete your personal data. If you wish to exercise any of 
                these rights, please contact us at <a href="mailto:support@awanglobalfoods.com" style="color:#16a34a;">support@awanglobalfoods.com</a>.
            </p>

            <h2 style="font-size:20px; font-weight:600; margin-top:30px; margin-bottom:12px;">7. Updates to This Policy</h2>
            <p style="color:#555; margin-bottom:20px;">
                We may update this Privacy Policy from time to time. The updated version will be posted on this page 
                with the effective date mentioned at the top.
            </p>

            <p style="margin-top:30px; color:#555;">
                If you have any questions about our Privacy Policy, feel free to 
                <a href="{{ route('contact') }}" style="color:#16a34a;">contact us</a>.
            </p>

        </div>
    </section>
@endsection
