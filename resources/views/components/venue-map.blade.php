{{-- Slot-Based Floor Plan - NEW 4 Cluster Layout (22 Booths) --}}
@props(['booths'])

@php
    // ========================================================================
    // SLOT-BASED BOOTH MAP - Define exact coordinates for every Booth ID
    // Indoor: 1-22 (Universities) | Outdoor: 30-40 (UMKM Bazaar)
    // ========================================================================
    
    // INDOOR UNIVERSITY BOOTHS (1-22)
    $boothMap = [
        // CLUSTER 1: RIGHT WALL (x=1060) - Flush against right wall
        4 => ['x' => 1060, 'y' => 380],  // Top
        3 => ['x' => 1060, 'y' => 460],
        2 => ['x' => 1060, 'y' => 540],
        1 => ['x' => 1060, 'y' => 620],  // Bottom

        // CLUSTER 2: RIGHT ISLAND (Booths 5-12) - Back-to-back block
        // Right Face (x=880)
        8 => ['x' => 880, 'y' => 380],   // Top
        7 => ['x' => 880, 'y' => 460],
        6 => ['x' => 880, 'y' => 540],
        5 => ['x' => 880, 'y' => 620],   // Bottom
        // Left Face (x=810)
        9  => ['x' => 810, 'y' => 380],  // Top
        10 => ['x' => 810, 'y' => 460],
        11 => ['x' => 810, 'y' => 540],
        12 => ['x' => 810, 'y' => 620],  // Bottom

        // CLUSTER 3: LEFT ISLAND (Booths 13-20) - Back-to-back block
        // Right Face (x=600)
        16 => ['x' => 600, 'y' => 380],  // Top
        15 => ['x' => 600, 'y' => 460],
        14 => ['x' => 600, 'y' => 540],
        13 => ['x' => 600, 'y' => 620],  // Bottom
        // Left Face (x=530)
        17 => ['x' => 530, 'y' => 380],  // Top
        18 => ['x' => 530, 'y' => 460],
        19 => ['x' => 530, 'y' => 540],
        20 => ['x' => 530, 'y' => 620],  // Bottom

        // CLUSTER 4: LEFT WALL (x=270) - Only 2 booths at bottom
        22 => ['x' => 270, 'y' => 540],
        21 => ['x' => 270, 'y' => 620],  // Bottom
    ];

    // OUTDOOR UMKM BAZAAR (30-40) - Straight Line Layout (y=350 Axis)
    $umkmMap = [
        // TOP ROW (31-34) - y=290 (Above the walkway)
        31 => ['x' => 100, 'y' => 290],
        32 => ['x' => 50, 'y' => 290],
        33 => ['x' => 0, 'y' => 290],
        34 => ['x' => -50, 'y' => 290],
        
        // BOTTOM ROW (30, 35-37) - y=410 (Below the walkway)
        30 => ['x' => 160, 'y' => 410],  // ON TERRACE - Aligned with 35
        35 => ['x' => 100, 'y' => 410],
        36 => ['x' => 50, 'y' => 410],
        37 => ['x' => 0, 'y' => 410],
        
        // LEFT COLUMN (38-40) - x=-110
        38 => ['x' => -110, 'y' => 350], // ON THE AXIS (Blocking view)
        39 => ['x' => -110, 'y' => 410], // Aligned with Bottom Row
        40 => ['x' => -110, 'y' => 470], // Below 39
    ];

    $boothWidth = 70;
    $boothHeight = 60;
    $umkmWidth = 45;
    $umkmHeight = 45;

    // Create a lookup by booth_id for O(1) access
    $boothLookup = collect($booths)->keyBy('booth_id');
@endphp

<svg 
    viewBox="-250 -150 1600 2600" 
    preserveAspectRatio="xMidYMid meet"
    xmlns="http://www.w3.org/2000/svg" 
    class="w-full h-full block"
    x-ref="mapSvg"
>
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
        <linearGradient id="umkmGradient" x1="0%" y1="0%" x2="0%" y2="100%">
            <stop offset="0%" style="stop-color:#fb923c;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#ea580c;stop-opacity:1" />
        </linearGradient>
        {{-- Arrow Marker for Flow --}}
        <marker id="arrowhead" markerWidth="10" markerHeight="7" refX="9" refY="3.5" orient="auto">
            <polygon points="0 0, 10 3.5, 0 7" fill="#ef4444" opacity="0.5" />
        </marker>
    </defs>

    {{-- LAYER 0: TERRACE (4-Meter Surrounding) --}}
    <g id="terrace-layer">
        {{-- Terrace Rectangle - Behind Main Hall --}}
        <rect x="150" y="-20" width="1100" height="950" 
              fill="#e5e7eb" 
              stroke="#9ca3af" 
              stroke-width="3" 
              rx="8" />
        
        {{-- Terrace Labels --}}
        <text x="170" y="400" text-anchor="middle" font-size="14" font-weight="bold" fill="#6b7280"
              transform="rotate(-90 170 400)">TERAS / TERRACE</text>
        <text x="1230" y="400" text-anchor="middle" font-size="14" font-weight="bold" fill="#6b7280"
              transform="rotate(90 1230 400)">TERAS / TERRACE</text>
        <text x="700" y="845" text-anchor="middle" font-size="14" font-weight="bold" fill="#6b7280">
            TERAS / TERRACE
        </text>
    </g>

    {{-- LAYER 1: ZONE BACKGROUNDS --}}
    <g id="zones">
        {{-- OUTDOOR UMKM BAZAAR ZONE (Straight Axis Layout) --}}
        <rect x="-130" y="270" width="300" height="260" 
              fill="#fff7ed" 
              stroke="#f97316" 
              stroke-width="3" 
              stroke-dasharray="10,5"
              rx="8" />
        <text x="20" y="260" text-anchor="middle" font-size="14" font-weight="bold" fill="#ea580c">
            OUTDOOR UMKM BAZAAR
        </text>
        <text x="20" y="545" text-anchor="middle" font-size="11" fill="#9a3412">
            Stands 30-40
        </text>

        {{-- Main Hall (Indoor Container) - White fill covers terrace --}}
        <rect x="250" y="30" width="920" height="750" 
              fill="#ffffff" 
              stroke="#1f2937" 
              stroke-width="4" 
              rx="5" />
        <text x="700" y="20" text-anchor="middle" font-size="20" font-weight="bold" fill="#1f2937">
            MAIN HALL
        </text>
    </g>

    {{-- LAYER 1.5: DOORS / EXITS (Aligned to y=350 Axis) --}}
    <g id="doors">
        {{-- Door: Bottom Center (Main Entrance) --}}
        <rect x="550" y="760" width="200" height="20" 
              fill="#bfdbfe" 
              stroke="#3b82f6" 
              stroke-width="2" 
              rx="2" />
        <text x="650" y="775" text-anchor="middle" font-size="11" font-weight="bold" fill="#1e40af">MAIN ENTRANCE</text>

        {{-- Left Door: Centered on y=350 axis --}}
        <rect x="240" y="310" width="20" height="80" 
              fill="#bfdbfe" 
              stroke="#3b82f6" 
              stroke-width="2" 
              rx="2" />
        <text x="250" y="355" text-anchor="middle" font-size="9" font-weight="bold" fill="#1e40af"
              transform="rotate(-90 250 355)">TO OUTDOOR</text>

        {{-- Right Door: Centered on y=350 axis --}}
        <rect x="1140" y="310" width="20" height="80" 
              fill="#e5e7eb" 
              stroke="#9ca3af" 
              stroke-width="2" 
              rx="2" />
        <text x="1150" y="355" text-anchor="middle" font-size="9" font-weight="bold" fill="#6b7280"
              transform="rotate(90 1150 355)">EXIT</text>
    </g>

    {{-- LAYER 2: STAGE & AUDIENCE (FULL WIDTH) --}}
    <g id="stage-area">
        {{-- Main Stage - FULL WIDTH --}}
        <rect x="250" y="50" width="900" height="100" 
              fill="url(#stageGradient)" 
              stroke="#000000" 
              stroke-width="3" 
              rx="8" />
        <text x="700" y="95" text-anchor="middle" font-size="32" font-weight="bold" fill="white">
            PANGGUNG UTAMA
        </text>
        <text x="700" y="125" text-anchor="middle" font-size="14" fill="white" opacity="0.9">
            MAIN STAGE
        </text>

        {{-- Audience Area - FULL WIDTH (Shorter) --}}
        <rect x="250" y="150" width="900" height="150" 
              fill="#e5e7eb" 
              stroke="#6b7280" 
              stroke-width="2" 
              rx="5" />
        <text x="700" y="230" text-anchor="middle" font-size="16" font-weight="600" fill="#374151">
            Area Penonton / Audience
        </text>
        
        {{-- Halfway Line Indicator (at y=300) --}}
        <line x1="250" y1="300" x2="1150" y2="300" 
              stroke="#9ca3af" 
              stroke-width="2" 
              stroke-dasharray="10,5" />
    </g>

    {{-- LAYER 3: VISITOR FLOW PATH (Snake Route - BELOW Booths) --}}
    <g id="flow-arrows" opacity="0.4">
        {{-- START: Entry from Main Doors (bottom center) → Move Right --}}
        <path d="M640 780 L970 780" 
              stroke="#ef4444" stroke-width="4" fill="none" 
              stroke-dasharray="10,5" marker-end="url(#arrowhead)" />
        
        {{-- Leg 2: Go Up Right Aisle to top gap (y=340) --}}
        <path d="M970 780 L970 340" 
              stroke="#ef4444" stroke-width="4" fill="none" 
              stroke-dasharray="10,5" marker-end="url(#arrowhead)" />
        
        {{-- Leg 3: Turn Left - Cross center aisle --}}
        <path d="M970 340 L705 340" 
              stroke="#ef4444" stroke-width="4" fill="none" 
              stroke-dasharray="10,5" marker-end="url(#arrowhead)" />
        
        {{-- Leg 4: Go Down to BOTTOM (y=710, below all booths) --}}
        <path d="M705 340 L705 710" 
              stroke="#ef4444" stroke-width="4" fill="none" 
              stroke-dasharray="10,5" marker-end="url(#arrowhead)" />
        
        {{-- Leg 5: Turn Left - Move below booths to Left Aisle --}}
        <path d="M705 710 L400 710" 
              stroke="#ef4444" stroke-width="4" fill="none" 
              stroke-dasharray="10,5" marker-end="url(#arrowhead)" />
        
        {{-- Leg 6: Go Up Left Aisle to Exit Door level (y=360) --}}
        <path d="M400 710 L400 360" 
              stroke="#ef4444" stroke-width="4" fill="none" 
              stroke-dasharray="10,5" marker-end="url(#arrowhead)" />
        
        {{-- Leg 7: Exit Left into Door --}}
        <path d="M400 360 L260 360" 
              stroke="#ef4444" stroke-width="4" fill="none" 
              stroke-dasharray="10,5" marker-end="url(#arrowhead)" />
        
        {{-- Flow Direction Labels --}}
        <text x="800" y="770" font-size="10" fill="#ef4444" font-weight="bold">START →</text>
        <text x="280" y="350" font-size="10" fill="#ef4444" font-weight="bold">← EXIT</text>
    </g>

    {{-- LAYER 4: THE BOOTH MATRIX - SLOT-BASED RENDERING --}}
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
                   style="transform-box: fill-box; transform-origin: center;"
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
                          font-size="14" 
                          font-weight="bold" 
                          fill="white">{{ strtoupper(substr($booth['name'], 0, 3)) }}</text>
                    
                    {{-- University Name (Truncated) --}}
                    <text x="{{ $x + $boothWidth/2 }}" y="{{ $y + $boothHeight/2 + 12 }}" 
                          text-anchor="middle" 
                          font-size="6" 
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
    </g>

    {{-- LAYER 4B: UMKM BAZAAR BOOTHS (Orange) --}}
    <g id="umkm-booths-layer">
        @foreach($umkmMap as $boothId => $coords)
            @php
                $x = $coords['x'];
                $y = $coords['y'];
            @endphp
            
            {{-- UMKM BOOTH - Orange themed --}}
            <g id="umkm-{{ $boothId }}" 
               class="booth-interactive cursor-pointer"
               style="transform-box: fill-box; transform-origin: center;">
                {{-- Booth Rectangle --}}
                <rect x="{{ $x }}" y="{{ $y }}" 
                      width="{{ $umkmWidth }}" 
                      height="{{ $umkmHeight }}" 
                      rx="4" 
                      fill="url(#umkmGradient)" 
                      stroke="#c2410c" 
                      stroke-width="2"
                      class="booth-rect" />
                
                {{-- Booth Number (Centered) --}}
                <text x="{{ $x + $umkmWidth/2 }}" y="{{ $y + $umkmHeight/2 + 5 }}" 
                      text-anchor="middle" 
                      font-size="14" 
                      font-weight="bold" 
                      fill="white">{{ $boothId }}</text>
            </g>
        @endforeach
    </g>

    {{-- LAYER 4C: OUTDOOR NAVIGATION PATH (Straight Laser Line at y=350) --}}
    <g id="outdoor-flow" opacity="0.5">
        {{-- Start: Left Exit Door (x=240, y=350) - Straight Left --}}
        <path d="M240 350 L-60 350" 
              stroke="#f97316" stroke-width="4" fill="none" 
              stroke-dasharray="8,4" marker-end="url(#arrowhead)" />
        
        {{-- Turn Down: From the gap to exit --}}
        <path d="M-60 350 L-60 500" 
              stroke="#f97316" stroke-width="4" fill="none" 
              stroke-dasharray="8,4" marker-end="url(#arrowhead)" />
        
        <text x="-50" y="520" font-size="9" fill="#ea580c" font-weight="bold">↓ EXIT</text>
    </g>

    {{-- LAYER 5: CLUSTER LABELS --}}
    <g id="cluster-labels" opacity="0.7">
        {{-- Cluster 1 Label --}}
        <text x="1085" y="440" text-anchor="middle" font-size="10" font-weight="bold" fill="#6b7280"
              transform="rotate(90 1085 440)">CLUSTER 1</text>
        
        {{-- Cluster 2 Label --}}
        <text x="845" y="350" text-anchor="middle" font-size="10" font-weight="bold" fill="#6b7280">
            CLUSTER 2
        </text>
        
        {{-- Cluster 3 Label --}}
        <text x="565" y="350" text-anchor="middle" font-size="10" font-weight="bold" fill="#6b7280">
            CLUSTER 3
        </text>
        
        {{-- Cluster 4 Label --}}
        <text x="285" y="600" text-anchor="middle" font-size="10" font-weight="bold" fill="#6b7280"
              transform="rotate(-90 285 600)">CLUSTER 4</text>
    </g>

    {{-- LAYER 6: AISLE GUIDES --}}
    <g id="aisle-guides" opacity="0.3">
        {{-- Main horizontal aisle (bottom) --}}
        <rect x="320" y="700" width="800" height="40" 
              fill="none" stroke="#94a3b8" stroke-width="2" stroke-dasharray="5,3" rx="3" />
        <text x="720" y="725" text-anchor="middle" font-size="11" fill="#64748b" font-weight="600">
            JALAN UTAMA / MAIN AISLE
        </text>
        
        {{-- Vertical aisle between islands (center) --}}
        <rect x="690" y="360" width="100" height="320" 
              fill="none" stroke="#94a3b8" stroke-width="2" stroke-dasharray="5,3" rx="3" />
    </g>

    {{-- Optional: Reference Grid --}}
    <g id="reference-grid" opacity="0.02">
        @for($i = 0; $i < 1200; $i += 50)
            <line x1="{{ $i }}" y1="0" x2="{{ $i }}" y2="1000" stroke="#000" stroke-width="0.5" />
        @endfor
        @for($i = 0; $i < 1000; $i += 50)
            <line x1="0" y1="{{ $i }}" x2="1200" y2="{{ $i }}" stroke="#000" stroke-width="0.5" />
        @endfor
    </g>

    {{-- CONNECTING PATH (Terrace to Parking) --}}
    <path d="M 600,930 L 600,1600" stroke="#CBD5E1" stroke-width="6" stroke-dasharray="12 8" />
    <text x="600" y="1250" text-anchor="middle" font-size="18" font-weight="600" fill="#94a3b8">JALAN MENUJU PARKIR</text>

    {{-- PARKING AREA (Yellow Zone) --}}
    <g id="parking-area" transform="translate(0, 1600)">
        <rect 
            x="-150" 
            y="0" 
            width="1500" 
            height="500" 
            rx="20" 
            fill="#FEF08A" 
            stroke="#CA8A04" 
            stroke-width="6" 
            stroke-dasharray="12 6"
        />
        
        <text 
            x="600" 
            y="260" 
            font-family="sans-serif" 
            font-size="50" 
            font-weight="900" 
            fill="#854D0E" 
            text-anchor="middle"
            style="text-transform: uppercase; letter-spacing: 0.1em;"
        >
            Area Parkir Luas
        </text>

        {{-- Left Parking Icon --}}
        <circle cx="100" cy="250" r="50" fill="#EAB308" />
        <text x="100" y="270" font-family="sans-serif" font-size="50" font-weight="bold" fill="white" text-anchor="middle">P</text>
        
        {{-- Right Parking Icon --}}
        <circle cx="1100" cy="250" r="50" fill="#EAB308" />
        <text x="1100" y="270" font-family="sans-serif" font-size="50" font-weight="bold" fill="white" text-anchor="middle">P</text>
    </g>
</svg>

<style>
    .booth-interactive {
        transition: all 0.3s ease-out;
    }
    
    .booth-interactive:hover .booth-rect {
        filter: brightness(1.05) drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        transform: scale(1.03);
        transform-box: fill-box;
        transform-origin: center;
    }
    
    .booth-interactive:active .booth-rect {
        filter: brightness(0.98);
        transform: scale(0.99);
        transform-box: fill-box;
        transform-origin: center;
    }
    
    .booth-rect {
        transition: all 0.3s ease-out;
        transform-box: fill-box;
        transform-origin: center;
    }
</style>
