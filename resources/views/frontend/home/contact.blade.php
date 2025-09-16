@extends('frontend.layouts.app')

@section('title', 'Contact Us - Awan Global Foods')

@section('content')
    {{-- Hero Section --}}
    <section style="background:linear-gradient(90deg,#f0f9ff,#fff); padding:60px 0; text-align:center;">
        <div class="container">
            <h1 style="font-size:36px; font-weight:700; color:#16a34a;">Get in Touch</h1>
            <p style="max-width:700px; margin:10px auto; color:#555;">
                Have a question, feedback, or business inquiry?  
                We’d love to hear from you — let’s talk!
            </p>
        </div>
    </section>

    {{-- Contact Section --}}
    <section style="padding:50px 0;">
        <div class="container" style="display:grid; grid-template-columns:repeat(auto-fit,minmax(300px,1fr)); gap:40px; max-width:1000px; margin:auto;">

            {{-- Contact Form --}}
            <div style="background:#fff; padding:25px; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
                <h3 style="font-size:22px; margin-bottom:20px; color:#16a34a;">Send us a Message</h3>
                
                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div style="margin-bottom:15px;">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <div style="margin-bottom:15px;">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                    <div style="margin-bottom:15px;">
                        <label>Message</label>
                        <textarea name="message" class="form-control" rows="5" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" style="background:#16a34a; color:#fff; border:none; padding:12px 20px; border-radius:6px; font-weight:600;">
                        Send Message
                    </button>
                </form>
            </div>

            {{-- Contact Info --}}
            <div style="background:#f9fafb; padding:25px; border-radius:8px;">
                <h3 style="font-size:22px; margin-bottom:20px; color:#16a34a;">Contact Information</h3>
                <p style="margin-bottom:15px;">📍 <strong>Office:</strong> 123 Main Street, Lahore, Pakistan</p>
                <p style="margin-bottom:15px;">📞 <strong>Phone:</strong> +92 300 1234567</p>
                <p style="margin-bottom:15px;">📧 <strong>Email:</strong> info@awanglobalfoods.com</p>
                <p style="margin-bottom:15px;">🕒 <strong>Working Hours:</strong> Mon - Sat (9:00 AM - 7:00 PM)</p>
                
                {{-- Google Map (optional) --}}
                <div style="margin-top:20px;">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13615.240741193935!2d74.3587!3d31.5204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391904d3ec3c62f1%3A0x9f60cfd75f1a5a1!2sLahore!5e0!3m2!1sen!2s!4v1700000000000" 
                        width="100%" height="200" style="border:0; border-radius:6px;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>
    </section>
@endsection
