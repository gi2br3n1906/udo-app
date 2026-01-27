{{-- Slot-Based Floor Plan - 4 Vertical Clusters with Exact Booth ID Positions --}}
@props(['booths'])

@php
    // ========================================================================
    // SLOT-BASED BOOTH MAP - Define exact coordinates for every Booth ID (1-25)
    // Booth ID 1 = RIGHT WALL, Booth ID 25 = LEFT WALL
    // ========================================================================
    $boothMap = [
        // CLUSTER D: RIGHT WALL (IDs 1-5) -> Fixed X=1060 (flush against right border)
        1 => ['x' => 1060, 'y' => 670],
        2 => ['x' => 1060, 'y' => 590],
        3 => ['x' => 1060, 'y' => 510],
        4 => ['x' => 1060, 'y' => 430],
        5 => ['x' => 1060, 'y' => 350],

        // CLUSTER C: RIGHT ISLAND (IDs 6-13) - Back-to-Back
        // Right Side (6-9) -> Fixed X=770
        6 => ['x' => 770, 'y' => 590],
        7 => ['x' => 770, 'y' => 510],
        8 => ['x' => 770, 'y' => 430],
        9 => ['x' => 770, 'y' => 350],
        // Left Side (10-13) -> Fixed X=700
        10 => ['x' => 700, 'y' => 350],
        11 => ['x' => 700, 'y' => 430],
        12 => ['x' => 700, 'y' => 510],
        13 => ['x' => 700, 'y' => 590],

        // CLUSTER B: LEFT ISLAND (IDs 14-21) - Back-to-Back
        // Right Side (14-17) -> Fixed X=520
        14 => ['x' => 520, 'y' => 590],
        15 => ['x' => 520, 'y' => 510],
        16 => ['x' => 520, 'y' => 430],
        17 => ['x' => 520, 'y' => 350],
        // Left Side (18-21) -> Fixed X=450
        18 => ['x' => 450, 'y' => 350],
        19 => ['x' => 450, 'y' => 430],
        20 => ['x' => 450, 'y' => 510],
        21 => ['x' => 450, 'y' => 590],

        // CLUSTER A: LEFT WALL (IDs 22-25) -> Fixed X=270 (flush against left border)
        22 => ['x' => 270, 'y' => 350],
        23 => ['x' => 270, 'y' => 430],
        24 => ['x' => 270, 'y' => 510],
        25 => ['x' => 270, 'y' => 590],
    ];

    $boothWidth = 70;
    $boothHeight = 60;

    // Create a lookup by booth_id for O(1) access
    $boothLookup = collect($booths)->keyBy('booth_id');
@endphp

<svg viewBox="0 0 1200 850" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
    <defs>
        {{-- Gradients --}}
        <linearGradient id="stageGradient" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" style="stop-color:#10b981;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#059669;stop-opacity:1" />
        </linearGradient>
        <linearGradient id="boothGradient" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" style="stop-color:#8b5cf6;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#7c3aed;stop-opacity:1" />
        </linearGradient>
        <linearGradient id="emptyGradient" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" style="stop-color:#f3f4f6;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#e5e7eb;stop-opacity:1" />
        </linearGradient>
    </defs>

    {{-- LAYER 1: ZONE BACKGROUNDS --}}
    <g id="zones">
        {{-- Zone 34 (Outdoor - Far LEFT) --}}
        <rect x="20" y="150" width="200" height="550" 
              fill="#fff7ed" 
              stroke="#f97316" 
              stroke-width="3" 
              stroke-dasharray="10,5"
              rx="8" />
        <text x="120" y="130" text-anchor="middle" font-size="14" font-weight="bold" fill="#ea580c">
            AREA 34 (OUTDOOR)
        </text>
        <rect x="50" y="190" width="140" height="470" 
              fill="#fed7aa" 
              stroke="#f97316" 
              stroke-width="2" 
              rx="4" />
        <text x="120" y="435" text-anchor="middle" font-size="18" font-weight="bold" fill="#9a3412">
            Stand 34
        </text>
        <text x="120" y="460" text-anchor="middle" font-size="12" fill="#9a3412">
            Tenant Area
        </text>

        {{-- Main Hall (Indoor Container - Compact) --}}
        <rect x="250" y="50" width="900" height="730" 
              fill="#ffffff" 
              stroke="#333333" 
              stroke-width="4" 
              rx="5" />
        <text x="700" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="#1f2937">
            MAIN HALL
        </text>
    </g>

    {{-- LAYER 1.5: DOORS / EXITS --}}
    <g id="doors">
        {{-- Door 1: Top Left (To Outdoor/Bazaar) --}}
        <rect x="240" y="200" width="20" height="80" 
              fill="#bfdbfe" 
              stroke="#3b82f6" 
              stroke-width="2" 
              rx="2" />
        <text x="250" y="245" text-anchor="middle" font-size="9" font-weight="bold" fill="#1e40af"
              transform="rotate(-90 250 245)">EXIT</text>

        {{-- Door 2: Top Right (Side Exit) --}}
        <rect x="1140" y="200" width="20" height="80" 
              fill="#e5e7eb" 
              stroke="#9ca3af" 
              stroke-width="2" 
              rx="2" />
        <text x="1150" y="245" text-anchor="middle" font-size="9" font-weight="bold" fill="#6b7280"
              transform="rotate(90 1150 245)">EXIT</text>

        {{-- Door 3: Bottom Left (Main Door) --}}
        <rect x="450" y="770" width="120" height="20" 
              fill="#bfdbfe" 
              stroke="#3b82f6" 
              stroke-width="2" 
              rx="2" />
        <text x="510" y="785" text-anchor="middle" font-size="10" font-weight="bold" fill="#1e40af">MAIN DOOR</text>

        {{-- Door 4: Bottom Right (Main Door) --}}
        <rect x="830" y="770" width="120" height="20" 
              fill="#bfdbfe" 
              stroke="#3b82f6" 
              stroke-width="2" 
              rx="2" />
        <text x="890" y="785" text-anchor="middle" font-size="10" font-weight="bold" fill="#1e40af">MAIN DOOR</text>
    </g>

    {{-- LAYER 2: STAGE & AUDIENCE --}}
    <g id="stage-area">
        {{-- Main Stage --}}
        <rect x="450" y="100" width="500" height="120" 
              fill="url(#stageGradient)" 
              stroke="#000000" 
              stroke-width="3" 
              rx="8" />
        <text x="700" y="150" text-anchor="middle" font-size="32" font-weight="bold" fill="white">
            PANGGUNG UTAMA
        </text>
        <text x="700" y="185" text-anchor="middle" font-size="16" fill="white" opacity="0.9">
            MAIN STAGE
        </text>

        {{-- Audience Area --}}
        <rect x="450" y="240" width="500" height="60" 
              fill="#e5e7eb" 
              stroke="#6b7280" 
              stroke-width="2" 
              rx="5" />
        <text x="700" y="275" text-anchor="middle" font-size="14" font-weight="600" fill="#374151">
            Area Penonton / Audience
        </text>
    </g>

    {{-- LAYER 3: THE BOOTH MATRIX - SLOT-BASED RENDERING --}}
    {{-- Iterate through the DEFINED SLOTS (1-25), NOT the data --}}
    <g id="booths-layer">
        @foreach($boothMap as $boothId => $coords)
            @php
                // Try to find the booth/university assigned to this slot ID
                $booth = $boothLookup->get($boothId);
                $x = $coords['x'];
                $y = $coords['y'];
            @endphp

            @if($booth)
                {{-- OCCUPIED BOOTH - Interactive with data --}}
                <g id="booth-{{ $boothId }}" 
                   class="booth-interactive cursor-pointer"
                   data-booth-id="{{ $booth['id'] }}"
                   data-booth-number="{{ $boothId }}"
                   data-booth-name="{{ $booth['name'] }}"
                   data-booth-url="{{ $booth['url'] }}"
                   onclick="window.openBoothModal({{ $booth['id'] }}, '{{ addslashes($booth['name']) }}', '{{ $boothId }}', '{{ $booth['url'] }}')">
                    
                    {{-- Booth Rectangle --}}
                    <rect x="{{ $x }}" y="{{ $y }}" 
                          width="{{ $boothWidth }}" 
                          height="{{ $boothHeight }}" 
                          rx="4" 
                          fill="url(#boothGradient)" 
                          stroke="#5b21b6" 
                          stroke-width="2"
                          class="booth-rect" />
                    
                    {{-- Booth Number Badge --}}
                    <circle cx="{{ $x + $boothWidth - 12 }}" cy="{{ $y + 12 }}" r="11" 
                            fill="white" 
                            stroke="#5b21b6" 
                            stroke-width="1.5" />
                    <text x="{{ $x + $boothWidth - 12 }}" y="{{ $y + 17 }}" 
                          text-anchor="middle" 
                          font-size="10" 
                          font-weight="bold" 
                          fill="#7c3aed">{{ $boothId }}</text>
                    
                    {{-- University Code/Initial --}}
                    <text x="{{ $x + $boothWidth/2 }}" y="{{ $y + $boothHeight/2 }}" 
                          text-anchor="middle" 
                          font-size="16" 
                          font-weight="bold" 
                          fill="white">{{ strtoupper(substr($booth['name'], 0, 3)) }}</text>
                    
                    {{-- University Name (Truncated) --}}
                    <text x="{{ $x + $boothWidth/2 }}" y="{{ $y + $boothHeight/2 + 14 }}" 
                          text-anchor="middle" 
                          font-size="7" 
                          fill="white" 
                          font-weight="600">
                        {{ strlen($booth['name']) > 10 ? substr($booth['name'], 0, 10) . '..' : $booth['name'] }}
                    </text>
                </g>
            @else
                {{-- EMPTY SLOT - Show placeholder with slot number --}}
                <g id="slot-{{ $boothId }}" class="empty-slot">
                    <rect x="{{ $x }}" y="{{ $y }}" 
                          width="{{ $boothWidth }}" 
                          height="{{ $boothHeight }}" 
                          rx="4" 
                          fill="url(#emptyGradient)" 
                          stroke="#9ca3af" 
                          stroke-width="2"
                          stroke-dasharray="4,2" />
                    
                    {{-- Slot Number (Centered) --}}
                    <text x="{{ $x + $boothWidth/2 }}" y="{{ $y + $boothHeight/2 + 5 }}" 
                          text-anchor="middle" 
                          font-size="16" 
                          font-weight="bold" 
                          fill="#9ca3af">{{ $boothId }}</text>
                </g>
            @endif
        @endforeach

        {{-- Visual Aisle Guides --}}
        {{-- Aisle 1 (Between Left Wall and Left Island) --}}
        <line x1="360" y1="340" x2="360" y2="680" 
              stroke="#cbd5e1" stroke-width="2" stroke-dasharray="5,3" opacity="0.5" />
        
        {{-- Aisle 2 (Main Center Aisle) --}}
        <rect x="600" y="330" width="80" height="370" 
              fill="none" stroke="#94a3b8" stroke-width="2" stroke-dasharray="5,3" opacity="0.4" rx="3" />
        <text x="640" y="520" text-anchor="middle" font-size="11" fill="#64748b" font-weight="600"
              transform="rotate(-90 640 520)">JALAN UTAMA</text>
        
        {{-- Aisle 3 (Between Right Island and Right Wall) --}}
        <line x1="920" y1="340" x2="920" y2="680" 
              stroke="#cbd5e1" stroke-width="2" stroke-dasharray="5,3" opacity="0.5" />
    </g>

    {{-- Optional: Reference Grid --}}
    <g id="reference-grid" opacity="0.02">
        @for($i = 0; $i < 1200; $i += 50)
            <line x1="{{ $i }}" y1="0" x2="{{ $i }}" y2="850" stroke="#000" stroke-width="0.5" />
        @endfor
        @for($i = 0; $i < 850; $i += 50)
            <line x1="0" y1="{{ $i }}" x2="1200" y2="{{ $i }}" stroke="#000" stroke-width="0.5" />
        @endfor
    </g>
</svg>

<style>
    .booth-interactive:hover .booth-rect {
        filter: brightness(1.4) drop-shadow(0 0 12px rgba(139, 92, 246, 0.9));
        transform: scale(1.08);
        transform-origin: center;
    }
    
    .booth-interactive:active .booth-rect {
        filter: brightness(0.85);
        transform: scale(0.98);
    }
    
    .booth-rect {
        transition: all 0.2s ease;
    }
</style>
