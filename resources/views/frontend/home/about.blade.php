@extends('frontend.layouts.app')

@section('title', 'About Us - Awan Global Foods')

@section('content')
    {{-- Hero Section --}}
    <section style="background:linear-gradient(90deg,#f0f9ff,#fff); padding:60px 0; text-align:center;">
        <div class="container">
            <h1 style="font-size:36px; font-weight:700; color:#16a34a;">About Awan Global Foods</h1>
            <p style="max-width:700px; margin:10px auto; color:#555;">
                Delivering fresh, high-quality groceries and food products across Pakistan.  
                We believe in healthy living, sustainability, and customer satisfaction.
            </p>
        </div>
    </section>

    {{-- Company Intro --}}
    <section style="padding:50px 0;">
        <div class="container" style="max-width:900px; margin:auto;">
            <h2 style="font-size:28px; margin-bottom:15px; color:#16a34a;">Who We Are</h2>
            <p style="line-height:1.8; color:#444;">
                Awan Global Foods is a trusted name in the food and grocery industry.  
                Our mission is to make fresh, hygienic, and affordable food accessible to everyone.  
                With years of experience, we aim to bridge the gap between farmers, suppliers, and consumers.
            </p>
        </div>
    </section>

    {{-- Mission & Vision --}}
    <section style="padding:50px 0; background:#f9fafb;">
        <div class="container" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:30px; max-width:1000px; margin:auto;">
            <div style="background:#fff; padding:25px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
                <h3 style="font-size:22px; margin-bottom:10px; color:#16a34a;">Our Mission</h3>
                <p style="color:#444; line-height:1.7;">
                    To provide quality groceries with convenience and affordability,  
                    ensuring every family can enjoy healthy meals without compromise.
                </p>
            </div>
            <div style="background:#fff; padding:25px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
                <h3 style="font-size:22px; margin-bottom:10px; color:#16a34a;">Our Vision</h3>
                <p style="color:#444; line-height:1.7;">
                    To become Pakistan’s leading grocery and food distribution company,  
                    empowering local farmers and building a sustainable food supply chain.
                </p>
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section style="padding:50px 0;">
        <div class="container" style="max-width:1000px; margin:auto;">
            <h2 style="font-size:28px; text-align:center; margin-bottom:30px; color:#16a34a;">Why Choose Us?</h2>
            <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:20px;">
                <div style="background:#fff; padding:20px; border-radius:8px; text-align:center; box-shadow:0 2px 6px rgba(0,0,0,0.05);">
                    <h4>🍎 Fresh Products</h4>
                    <p style="color:#555;">We source directly from trusted farmers and suppliers.</p>
                </div>
                <div style="background:#fff; padding:20px; border-radius:8px; text-align:center; box-shadow:0 2px 6px rgba(0,0,0,0.05);">
                    <h4>🚚 Fast Delivery</h4>
                    <p style="color:#555;">Quick and reliable delivery right at your doorstep.</p>
                </div>
                <div style="background:#fff; padding:20px; border-radius:8px; text-align:center; box-shadow:0 2px 6px rgba(0,0,0,0.05);">
                    <h4>💳 Secure Payment</h4>
                    <p style="color:#555;">Multiple safe payment options available.</p>
                </div>
                <div style="background:#fff; padding:20px; border-radius:8px; text-align:center; box-shadow:0 2px 6px rgba(0,0,0,0.05);">
                    <h4>🤝 Customer Support</h4>
                    <p style="color:#555;">Friendly support team available to help you anytime.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact CTA --}}
    <section style="padding:50px 0; background:#16a34a; color:#fff; text-align:center;">
        <div class="container">
            <h2 style="font-size:28px; margin-bottom:10px;">Get in Touch</h2>
            <p style="margin-bottom:20px;">Have questions? We’d love to hear from you.</p>
            <a href="{{ route('pages.contact') }}" style="background:#fff; color:#16a34a; padding:12px 20px; border-radius:6px; font-weight:600; text-decoration:none;">
                Contact Us
            </a>
        </div>
    </section>
@endsection
