{{-- Slot-Based Floor Plan - NEW 4 Cluster Layout (22 Booths) --}}
@props(['booths'])

@php
    // ========================================================================
    // SLOT-BASED BOOTH MAP - Define exact coordinates for every Booth ID (1-22)
    // Based on floor plan: image_9d8275.png
    // ========================================================================
    $boothMap = [
        // CLUSTER 1: RIGHT WALL (Booths 1-4) - Vertical stack on far right
        1 => ['x' => 1050, 'y' => 700],  // Bottom
        2 => ['x' => 1050, 'y' => 620],
        3 => ['x' => 1050, 'y' => 540],
        4 => ['x' => 1050, 'y' => 460],  // Top

        // CLUSTER 2: RIGHT ISLAND (Booths 5-12) - Back-to-back block middle-right
        // Right Face (5-9) -> X=880
        5 => ['x' => 880, 'y' => 700],   // Bottom
        6 => ['x' => 880, 'y' => 620],
        7 => ['x' => 880, 'y' => 540],
        8 => ['x' => 880, 'y' => 460],
        9 => ['x' => 880, 'y' => 380],   // Top
        // Left Face (10-12) -> X=810
        10 => ['x' => 810, 'y' => 540],
        11 => ['x' => 810, 'y' => 620],
        12 => ['x' => 810, 'y' => 700],  // Bottom

        // CLUSTER 3: LEFT ISLAND (Booths 13-20) - Back-to-back block middle-left
        // Right Face (13-17) -> X=600
        13 => ['x' => 600, 'y' => 700],  // Bottom
        14 => ['x' => 600, 'y' => 620],
        15 => ['x' => 600, 'y' => 540],
        16 => ['x' => 600, 'y' => 460],
        17 => ['x' => 600, 'y' => 380],  // Top
        // Left Face (18-20) -> X=530
        18 => ['x' => 530, 'y' => 540],
        19 => ['x' => 530, 'y' => 620],
        20 => ['x' => 530, 'y' => 700],  // Bottom

        // CLUSTER 4: LEFT WALL (Booths 21-22) - Vertical stack on far left (lower)
        21 => ['x' => 250, 'y' => 700],  // Bottom
        22 => ['x' => 250, 'y' => 620],
    ];

    $boothWidth = 70;
    $boothHeight = 60;

    // Create a lookup by booth_id for O(1) access
    $boothLookup = collect($booths)->keyBy('booth_id');
@endphp

<svg viewBox="0 0 1200 1000" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
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
        {{-- Arrow Marker for Flow --}}
        <marker id="arrowhead" markerWidth="10" markerHeight="7" refX="9" refY="3.5" orient="auto">
            <polygon points="0 0, 10 3.5, 0 7" fill="#ef4444" opacity="0.5" />
        </marker>
    </defs>

    {{-- LAYER 1: ZONE BACKGROUNDS --}}
    <g id="zones">
        {{-- Zone 34 (Outdoor - Far LEFT) --}}
        <rect x="20" y="250" width="180" height="550" 
              fill="#fff7ed" 
              stroke="#f97316" 
              stroke-width="3" 
              stroke-dasharray="10,5"
              rx="8" />
        <text x="110" y="230" text-anchor="middle" font-size="14" font-weight="bold" fill="#ea580c">
            AREA 34 (OUTDOOR)
        </text>
        <rect x="40" y="290" width="140" height="470" 
              fill="#fed7aa" 
              stroke="#f97316" 
              stroke-width="2" 
              rx="4" />
        <text x="110" y="535" text-anchor="middle" font-size="16" font-weight="bold" fill="#9a3412">
            Stand 34
        </text>
        <text x="110" y="555" text-anchor="middle" font-size="11" fill="#9a3412">
            Tenant Area
        </text>

        {{-- Main Hall (Indoor Container) --}}
        <rect x="220" y="80" width="950" height="850" 
              fill="#ffffff" 
              stroke="#333333" 
              stroke-width="4" 
              rx="5" />
        <text x="695" y="60" text-anchor="middle" font-size="20" font-weight="bold" fill="#1f2937">
            MAIN HALL
        </text>
    </g>

    {{-- LAYER 1.5: DOORS / EXITS --}}
    <g id="doors">
        {{-- Door: Left Side (To Outdoor/Bazaar) --}}
        <rect x="210" y="500" width="20" height="100" 
              fill="#bfdbfe" 
              stroke="#3b82f6" 
              stroke-width="2" 
              rx="2" />
        <text x="220" y="555" text-anchor="middle" font-size="9" font-weight="bold" fill="#1e40af"
              transform="rotate(-90 220 555)">TO AREA 34</text>

        {{-- Door: Bottom Center (Main Entrance) --}}
        <rect x="550" y="920" width="200" height="20" 
              fill="#bfdbfe" 
              stroke="#3b82f6" 
              stroke-width="2" 
              rx="2" />
        <text x="650" y="935" text-anchor="middle" font-size="11" font-weight="bold" fill="#1e40af">MAIN ENTRANCE</text>

        {{-- Door: Right Side Exit --}}
        <rect x="1160" y="500" width="20" height="100" 
              fill="#e5e7eb" 
              stroke="#9ca3af" 
              stroke-width="2" 
              rx="2" />
        <text x="1170" y="555" text-anchor="middle" font-size="9" font-weight="bold" fill="#6b7280"
              transform="rotate(90 1170 555)">EXIT</text>
    </g>

    {{-- LAYER 2: STAGE & AUDIENCE --}}
    <g id="stage-area">
        {{-- Main Stage --}}
        <rect x="400" y="130" width="600" height="120" 
              fill="url(#stageGradient)" 
              stroke="#000000" 
              stroke-width="3" 
              rx="8" />
        <text x="700" y="180" text-anchor="middle" font-size="32" font-weight="bold" fill="white">
            PANGGUNG UTAMA
        </text>
        <text x="700" y="215" text-anchor="middle" font-size="14" fill="white" opacity="0.9">
            MAIN STAGE
        </text>

        {{-- Audience Area --}}
        <rect x="400" y="270" width="600" height="60" 
              fill="#e5e7eb" 
              stroke="#6b7280" 
              stroke-width="2" 
              rx="5" />
        <text x="700" y="305" text-anchor="middle" font-size="13" font-weight="600" fill="#374151">
            Area Penonton / Audience
        </text>
    </g>

    {{-- LAYER 3: VISITOR FLOW ARROWS (Light guide) --}}
    <g id="flow-arrows" opacity="0.3">
        {{-- Entry from bottom --}}
        <path d="M650 900 L650 800 L480 800 L480 720" 
              stroke="#ef4444" stroke-width="4" fill="none" 
              stroke-dasharray="10,5" marker-end="url(#arrowhead)" />
        
        {{-- Flow through center --}}
        <path d="M720 800 L720 500 L780 500" 
              stroke="#ef4444" stroke-width="4" fill="none" 
              stroke-dasharray="10,5" marker-end="url(#arrowhead)" />
        
        {{-- Flow to exit --}}
        <path d="M980 550 L1100 550" 
              stroke="#ef4444" stroke-width="4" fill="none" 
              stroke-dasharray="10,5" marker-end="url(#arrowhead)" />
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
        {{-- Main horizontal aisle --}}
        <rect x="320" y="800" width="800" height="40" 
              fill="none" stroke="#94a3b8" stroke-width="2" stroke-dasharray="5,3" rx="3" />
        <text x="720" y="825" text-anchor="middle" font-size="11" fill="#64748b" font-weight="600">
            JALAN UTAMA / MAIN AISLE
        </text>
        
        {{-- Vertical aisle between islands --}}
        <rect x="690" y="360" width="100" height="420" 
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
