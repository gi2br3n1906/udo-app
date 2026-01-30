@extends('layouts.app')

@section('title', 'Interactive Venue Map')

@section('header-title')
    Peta Lokasi Event
@endsection

@section('header-subtitle')
    Drag, zoom, dan klik booth untuk detail
@endsection

@section('content')
<div class="w-full h-[calc(100vh-12rem)] relative">
    
    {{-- Legend --}}
    <div class="absolute top-4 left-4 z-20 bg-white/95 backdrop-blur rounded-xl shadow-lg p-3 text-xs">
        <div class="flex flex-col gap-2">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-indigo-600 rounded"></div>
                <span class="text-gray-700">University</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-green-500 rounded"></div>
                <span class="text-gray-700">Stage</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-yellow-400 rounded"></div>
                <span class="text-gray-700">Parking</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 bg-purple-500 rounded"></div>
                <span class="text-gray-700">Facilities</span>
            </div>
        </div>
    </div>

    {{-- Zoom Controls --}}
    <div class="absolute bottom-6 right-6 z-20 flex flex-col gap-2">
        <button id="zoom-in-btn" 
                class="w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-700 hover:bg-gray-50 active:scale-95 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
            </svg>
        </button>
        
        <button id="zoom-out-btn" 
                class="w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-700 hover:bg-gray-50 active:scale-95 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
            </svg>
        </button>
        
        <button id="reset-btn" 
                class="w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-gray-700 hover:bg-gray-50 active:scale-95 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
        </button>
    </div>

    {{-- Interactive Map Container --}}
    <div id="map-container" class="w-full h-full bg-gradient-to-br from-slate-50 to-slate-100 rounded-2xl shadow-inner overflow-hidden">
        <div id="panzoom-element" class="w-full h-full flex items-center justify-center cursor-grab active:cursor-grabbing">
            <x-venue-map :booths="$booths" />
        </div>
    </div>

    {{-- Instruction Hint (Show on first load) --}}
    <div id="instruction-hint" class="absolute bottom-20 left-1/2 -translate-x-1/2 z-10 bg-indigo-600 text-white px-4 py-2 rounded-full shadow-lg text-sm font-medium animate-bounce">
        👆 Drag & pinch to zoom
    </div>
</div>

{{-- Modal for Booth Detail --}}
<div id="booth-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm" onclick="closeBoothModal()">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-6 transform transition-all scale-95 opacity-0" id="modal-content" onclick="event.stopPropagation()">
        <div class="flex items-center gap-4 mb-4">
            <div id="modal-logo" class="w-16 h-16 bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-600 font-bold text-2xl shrink-0">
                --
            </div>
            <div class="flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <span id="modal-booth-badge" class="px-2 py-1 bg-indigo-100 text-indigo-700 text-xs font-bold rounded">BOOTH --</span>
                </div>
                <h3 id="modal-name" class="text-xl font-bold text-gray-800">Loading...</h3>
            </div>
        </div>
        
        <div class="flex gap-3 mt-6">
            <button onclick="closeBoothModal()" class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">
                Tutup
            </button>
            <a id="modal-link" href="#" class="flex-1 px-4 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg text-center transition">
                Lihat Detail
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Load Panzoom from CDN --}}
<script src="https://unpkg.com/@panzoom/panzoom@4.5.1/dist/panzoom.min.js"></script>

<script>
// Global function to open booth modal (called from SVG onclick)
window.openBoothModal = function(id, name, boothNumber, url) {
    const modal = document.getElementById('booth-modal');
    const modalContent = document.getElementById('modal-content');
    const modalLogo = document.getElementById('modal-logo');
    const modalName = document.getElementById('modal-name');
    const modalBadge = document.getElementById('modal-booth-badge');
    const modalLink = document.getElementById('modal-link');
    
    // Update content
    modalLogo.textContent = name.substring(0, 2).toUpperCase();
    modalName.textContent = name;
    modalBadge.textContent = 'BOOTH ' + boothNumber;
    modalLink.href = url;
    
    // Show modal with animation
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeBoothModal() {
    const modal = document.getElementById('booth-modal');
    const modalContent = document.getElementById('modal-content');
    
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }, 200);
}

// Initialize Panzoom
document.addEventListener('DOMContentLoaded', function() {
    const panzoomElement = document.getElementById('panzoom-element');
    const mapContainer = document.getElementById('map-container');
    
    if (!panzoomElement || !window.Panzoom) {
        console.error('Panzoom: Element or library not found!');
        return;
    }
    
    // Initialize Panzoom
    const panzoom = Panzoom(panzoomElement, {
        maxScale: 4,
        minScale: 0.8,
        contain: 'outside',
        startScale: 1.2,
        cursor: 'grab'
    });
    
    // Enable mouse wheel zoom
    mapContainer.addEventListener('wheel', panzoom.zoomWithWheel);
    
    // Zoom Controls
    document.getElementById('zoom-in-btn').addEventListener('click', () => {
        panzoom.zoomIn();
    });
    
    document.getElementById('zoom-out-btn').addEventListener('click', () => {
        panzoom.zoomOut();
    });
    
    document.getElementById('reset-btn').addEventListener('click', () => {
        panzoom.reset();
    });
    
    // Hide instruction hint after 4 seconds
    setTimeout(() => {
        const hint = document.getElementById('instruction-hint');
        if (hint) {
            hint.style.opacity = '0';
            hint.style.transition = 'opacity 0.5s';
            setTimeout(() => hint.remove(), 500);
        }
    }, 4000);
    
    console.log('✅ Interactive Map with Panzoom initialized!');
});

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeBoothModal();
    }
});
</script>
@endpush
