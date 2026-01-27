@extends('layouts.app')

@section('title', 'Venue Map')

@section('header-title')
    Venue Map
@endsection

@section('header-subtitle')
    Find your favorite booth
@endsection

@section('content')
{{-- Main Map Container --}}
<div id="map-container" class="relative w-full h-[calc(100vh-theme(spacing.44))] bg-slate-100 overflow-hidden rounded-2xl shadow-inner">
    
    {{-- Panzoom Target Element --}}
    <div id="panzoom-element" class="w-full h-full flex items-center justify-center cursor-grab active:cursor-grabbing">
        <x-venue-map class="w-[700px] h-[500px]" />
    </div>

    {{-- Floating Controls --}}
    <div class="absolute bottom-4 right-4 flex flex-col gap-2 z-50">
        {{-- Zoom In --}}
        <button id="btn-zoom-in" 
                class="w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-slate-700 hover:bg-slate-50 active:scale-95 transition-all border border-slate-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
        </button>

        {{-- Zoom Out --}}
        <button id="btn-zoom-out" 
                class="w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-slate-700 hover:bg-slate-50 active:scale-95 transition-all border border-slate-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
            </svg>
        </button>

        {{-- Reset --}}
        <button id="btn-reset" 
                class="w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-slate-700 hover:bg-slate-50 active:scale-95 transition-all border border-slate-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
        </button>
    </div>

    {{-- Bottom Sheet Modal (Hidden by Default) --}}
    <div id="booth-modal" class="fixed inset-0 z-[100] flex items-end justify-center pointer-events-none opacity-0 transition-opacity duration-300">
        {{-- Backdrop --}}
        <div id="modal-backdrop" class="absolute inset-0 bg-black/40 backdrop-blur-sm pointer-events-none"></div>
        
        {{-- Sheet --}}
        <div id="modal-sheet" class="relative w-full max-w-lg bg-white rounded-t-3xl p-6 shadow-2xl translate-y-full transition-transform duration-300 pb-8">
            <div class="w-12 h-1.5 bg-slate-200 rounded-full mx-auto mb-5"></div>
            
            <div class="flex items-center gap-4">
                <div id="modal-logo" class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center shrink-0 text-purple-600 font-bold text-xl">
                    --
                </div>
                <div class="flex-1">
                    <span id="modal-booth-tag" class="inline-block px-2 py-0.5 bg-purple-50 text-purple-600 text-[10px] font-bold uppercase rounded-md mb-1">Booth --</span>
                    <h3 id="modal-name" class="text-xl font-bold text-slate-800 leading-tight">Loading...</h3>
                    <p id="modal-type" class="text-sm text-slate-500">University</p>
                </div>
            </div>
            
            <div class="mt-6 flex gap-3">
                <button id="modal-close-btn" class="flex-1 py-3.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition-colors">
                    Close
                </button>
                <a id="modal-view-btn" href="#" class="flex-1 py-3.5 px-4 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-xl text-center shadow-lg shadow-purple-500/20 transition-all">
                    View Profile
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Occupied Booth Styling */
    .booth-occupied {
        fill: #8B5CF6 !important;
        cursor: pointer !important;
        filter: drop-shadow(0 4px 6px rgba(139, 92, 246, 0.4));
        transition: fill 0.2s ease, transform 0.2s ease;
    }
    .booth-occupied:hover {
        fill: #7C3AED !important;
    }
    /* Booth Labels (text elements) */
    .booth-label-white {
        fill: white !important;
        font-weight: bold;
        pointer-events: none;
    }
</style>
@endpush

@push('scripts')
{{-- Load Panzoom from CDN --}}
<script src="https://unpkg.com/@panzoom/panzoom@4.5.1/dist/panzoom.min.js"></script>

<script>
    // ===== PASS PHP DATA TO JAVASCRIPT =====
    const occupiedBooths = @json($booths);
    
    // ===== WAIT FOR DOM =====
    document.addEventListener('DOMContentLoaded', function() {
        
        // --- 1. Initialize Panzoom ---
        const panzoomElement = document.getElementById('panzoom-element');
        const mapContainer = document.getElementById('map-container');
        
        if (!panzoomElement || !window.Panzoom) {
            console.error('Panzoom: Element or library not found!');
            return;
        }
        
        const pz = Panzoom(panzoomElement, {
            maxScale: 4,
            minScale: 0.5,
            contain: 'outside',
            startScale: 1,
            cursor: 'grab'
        });
        
        // Enable Mouse Wheel Zoom
        mapContainer.addEventListener('wheel', pz.zoomWithWheel);
        
        console.log('✅ Panzoom initialized successfully');

        // --- 2. Attach Button Listeners ---
        document.getElementById('btn-zoom-in').addEventListener('click', function(e) {
            e.stopPropagation();
            pz.zoomIn();
            console.log('Zoom In');
        });
        
        document.getElementById('btn-zoom-out').addEventListener('click', function(e) {
            e.stopPropagation();
            pz.zoomOut();
            console.log('Zoom Out');
        });
        
        document.getElementById('btn-reset').addEventListener('click', function(e) {
            e.stopPropagation();
            pz.reset();
            console.log('Reset');
        });

        // --- 3. Highlight Occupied Booths ---
        console.log('Booths data received:', occupiedBooths);
        
        occupiedBooths.forEach(function(booth) {
            const boothId = 'booth-' + booth.booth_id;
            const el = document.getElementById(boothId);
            
            if (el) {
                // Apply Visual Styling
                el.classList.add('booth-occupied');
                
                // Style sibling text label (if present)
                const label = el.nextElementSibling;
                if (label && label.tagName.toLowerCase() === 'text') {
                    label.classList.add('booth-label-white');
                }
                
                // Add Click Listener
                el.addEventListener('click', function(e) {
                    e.stopPropagation();
                    showBoothModal(booth);
                });
                
                console.log('✓ Booth ready:', boothId);
            } else {
                console.warn('✗ Booth SVG element not found:', boothId);
            }
        });

        // --- 4. Modal Functions ---
        const modal = document.getElementById('booth-modal');
        const modalBackdrop = document.getElementById('modal-backdrop');
        const modalSheet = document.getElementById('modal-sheet');
        const modalCloseBtn = document.getElementById('modal-close-btn');
        
        function showBoothModal(booth) {
            // Populate Modal Content
            document.getElementById('modal-logo').textContent = booth.name ? booth.name.substring(0, 2).toUpperCase() : '??';
            document.getElementById('modal-booth-tag').textContent = 'Booth ' + booth.booth_id;
            document.getElementById('modal-name').textContent = booth.name || 'Unknown';
            document.getElementById('modal-type').textContent = booth.type === 'university' ? 'University' : 'UMKM';
            document.getElementById('modal-view-btn').href = booth.url || '#';
            
            // Show Modal
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
            modalBackdrop.classList.add('pointer-events-auto');
            modalSheet.classList.add('pointer-events-auto');
            modalSheet.classList.remove('translate-y-full');
            
            console.log('Modal opened for:', booth.name);
        }
        
        function hideBoothModal() {
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            modalBackdrop.classList.remove('pointer-events-auto');
            modalSheet.classList.remove('pointer-events-auto');
            modalSheet.classList.add('translate-y-full');
        }
        
        // Close on button click
        modalCloseBtn.addEventListener('click', hideBoothModal);
        
        // Close on backdrop click
        modalBackdrop.addEventListener('click', hideBoothModal);
        
        console.log('🗺️ Map fully initialized!');
    });
</script>
@endpush
