<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us · Aethelweave</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Cormorant Garamond & Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            bg: '#FDFBF7',
                            dark: '#2C2A29',
                            gold: '#A58B54',
                            goldDark: '#8F753D',
                            card: '#FFFFFF',
                            border: '#E8E2D2'
                        }
                    },
                    fontFamily: {
                        serif: ['"Cormorant Garamond"', 'serif'],
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        /* subtle extra polish */
        .hover-lift {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .hover-lift:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px -8px rgba(0,0,0,0.08);
        }
        .input-focus-ring:focus {
            outline: 2px solid #A58B54;
            outline-offset: 1px;
            border-color: transparent;
        }
        .gold-dot {
            background: #A58B54;
        }
        .bg-warm {
            background-color: #F8F3EA;
        }
        .border-soft {
            border-color: #E8E2D2;
        }
        .shadow-card {
            box-shadow: 0 8px 24px -6px rgba(44, 42, 41, 0.06);
        }
        .shadow-card-hover {
            box-shadow: 0 16px 32px -10px rgba(44, 42, 41, 0.10);
        }
        .gold-gradient-border {
            position: relative;
        }
        .gold-gradient-border::after {
            content: '';
            position: absolute;
            inset: -1px;
            border-radius: 12px;
            padding: 1px;
            background: linear-gradient(135deg, #A58B54 0%, #d4bf94 60%, #A58B54 100%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }
        /* responsive map */
        .map-container {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
        }
        .map-container iframe {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-brand-bg text-brand-dark font-sans antialiased min-h-screen py-12 px-4 sm:px-6 lg:px-8">

    <div class="max-w-7xl mx-auto">
        
        <!-- HEADER SECTION – refined -->
        <div class="text-center max-w-2xl mx-auto mb-14">
            <p class="text-[11px] uppercase tracking-[0.3em] text-brand-gold font-semibold mb-2">We’re Here To Help</p>
            <h1 class="font-serif text-4xl sm:text-5xl font-medium tracking-wide mb-4 text-brand-dark">Let’s Connect With Us</h1>
            <div class="flex items-center justify-center space-x-3 mb-5">
                <span class="h-[1px] w-12 bg-brand-gold/40"></span>
                <span class="w-1.5 h-1.5 rounded-full bg-brand-gold/60"></span>
                <span class="h-[1px] w-12 bg-brand-gold/40"></span>
            </div>
            <p class="text-sm sm:text-base text-gray-600 font-light leading-relaxed max-w-xl mx-auto">
                Have a question about our jewelry, orders, shipping, or anything else? Our expert team is always happy to assist. Reach out, and we’ll be delighted to help you find the perfect piece or resolve your query.
            </p>
        </div>

        <!-- MAIN GRID CONTAINER -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT COLUMN: Support Channels & Map Section -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- Support Channels Row – professional cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    
                    <!-- WhatsApp Support -->
                    <div class="bg-brand-card p-6 rounded-xl border border-brand-border/60 shadow-card hover-lift text-center flex flex-col items-center justify-center transition">
                        <div class="w-12 h-12 rounded-full bg-[#F5EEDC] flex items-center justify-center text-brand-gold mb-3">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.124-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                        </div>
                        <h3 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-gray-500 mb-1">WhatsApp</h3>
                        <p class="text-sm font-medium text-brand-dark">+91 98765 43210</p>
                    </div>

                    <!-- Call Support -->
                    <div class="bg-brand-card p-6 rounded-xl border border-brand-border/60 shadow-card hover-lift text-center flex flex-col items-center justify-center transition">
                        <div class="w-12 h-12 rounded-full bg-[#F5EEDC] flex items-center justify-center text-brand-gold mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <h3 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-gray-500 mb-1">Call Us</h3>
                        <p class="text-sm font-medium text-brand-dark">+91 98765 43210</p>
                    </div>

                    <!-- Email Support -->
                    <div class="bg-brand-card p-6 rounded-xl border border-brand-border/60 shadow-card hover-lift text-center flex flex-col items-center justify-center transition">
                        <div class="w-12 h-12 rounded-full bg-[#F5EEDC] flex items-center justify-center text-brand-gold mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-[11px] font-semibold uppercase tracking-[0.15em] text-gray-500 mb-1">Email</h3>
                        <p class="text-xs font-medium text-brand-dark truncate max-w-full">support@aethelweave.com</p>
                    </div>

                </div>

                <!-- Map & Boutique Location – polished -->
                <div class="bg-brand-card p-6 rounded-xl border border-brand-border shadow-card hover:shadow-card-hover transition">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-[10px] font-semibold uppercase tracking-[0.2em] text-brand-gold bg-brand-bg px-3 py-1 rounded border border-brand-border/60">Find Us On Map</h3>
                        <a href="https://maps.google.com" target="_blank" class="text-xs text-brand-gold underline hover:text-brand-dark transition">Open in Maps</a>
                    </div>
                    
                    <!-- Google Map Embedded iframe – refined container -->
                    <div class="map-container w-full h-56 bg-gray-100 rounded-lg mb-4 border border-brand-border/60">
                        <iframe 
                            width="100%" 
                            height="100%" 
                            frameborder="0" 
                            style="border:0" 
                            loading="lazy"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3782.5936087570146!2d73.8870!3d18.5362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTjCsDMyJzEwLjQiTiA3M8KwNTMnMTMuMiJF!5e0!3m2!1sen!2sin!4v1620000000000" 
                            allowfullscreen>
                        </iframe>
                    </div>

                    <div class="text-center">
                        <p class="text-[10px] uppercase tracking-[0.2em] text-gray-400 font-semibold mb-1">Visit Our Boutique</p>
                        <p class="text-xs text-brand-dark font-medium">123, Jewelry Lane, Koregaon Park, Pune, Maharashtra 411001, India</p>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Contact Form – elevated design -->
            <div class="lg:col-span-5 bg-brand-card p-8 rounded-xl border border-brand-border shadow-card hover:shadow-card-hover transition">
                <h2 class="text-xl font-serif font-medium text-brand-dark mb-1">Get In Touch</h2>
                <p class="text-xs text-gray-500 mb-6">Speak with our jewellery consultant</p>

                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 text-xs rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact-inquiry.store') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">First Name *</label>
                            <input type="text" name="first_name" required placeholder="Enter your first name" class="w-full px-4 py-2.5 text-sm bg-brand-bg/50 border border-brand-border rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-gold input-focus-ring transition" />
                        </div>
                        <div>
                            <label class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">Last Name *</label>
                            <input type="text" name="last_name" required placeholder="Enter your last name" class="w-full px-4 py-2.5 text-sm bg-brand-bg/50 border border-brand-border rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-gold input-focus-ring transition" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">Email Address *</label>
                        <input type="email" name="email" required placeholder="Enter your email" class="w-full px-4 py-2.5 text-sm bg-brand-bg/50 border border-brand-border rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-gold input-focus-ring transition" />
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">I am Interested In... *</label>
                        <select name="interest" required class="w-full px-4 py-2.5 text-sm bg-brand-bg/50 border border-brand-border rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-gold text-gray-600 transition">
                            <option value="" disabled selected>I am Interested In...</option>
                            <option value="Rings">Rings & Bands</option>
                            <option value="Necklaces">Necklaces & Chains</option>
                            <option value="Bracelets">Bracelets & Bangles</option>
                            <option value="Custom">Custom Design Consultation</option>
                            <option value="Other">General Inquiry</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium uppercase tracking-wider text-gray-600 mb-1">Tell us your enquiry *</label>
                        <textarea name="message" rows="3" required placeholder="Enter your message" class="w-full px-4 py-2.5 text-sm bg-brand-bg/50 border border-brand-border rounded-lg focus:outline-none focus:ring-1 focus:ring-brand-gold resize-none input-focus-ring transition"></textarea>
                    </div>

                    <button type="submit" class="w-full py-3.5 bg-brand-gold hover:bg-brand-goldDark text-white font-medium text-xs uppercase tracking-[0.2em] rounded-lg transition shadow-sm hover:shadow-md">
                        Submit Your Enquiry
                    </button>
                </form>
            </div>

        </div>

        <!-- tiny footer note (clean) -->
        <div class="text-center mt-12 text-[10px] text-gray-400 tracking-widest uppercase border-t border-brand-border/40 pt-6">
            <span class="text-brand-gold/60">✦</span> Aethelweave · artisan jewellery
        </div>
    </div>

</body>
</html>