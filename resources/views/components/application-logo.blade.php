@props(['class' => ''])

<svg {{ $attributes->merge(['class' => $class]) }} viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
    <!-- UDO Logo - University Days Out -->
    <!-- Stylized graduation cap with forward arrow -->
    <defs>
        <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" style="stop-color:#8B5CF6"/>
            <stop offset="50%" style="stop-color:#EC4899"/>
            <stop offset="100%" style="stop-color:#F59E0B"/>
        </linearGradient>
    </defs>
    
    <!-- Main shape - Abstract "U" with upward momentum -->
    <path 
        d="M8 16C8 16 8 28 8 32C8 38.627 13.373 44 20 44H28C34.627 44 40 38.627 40 32V16" 
        stroke="currentColor" 
        stroke-width="3" 
        stroke-linecap="round" 
        fill="none"
    />
    
    <!-- Graduation cap top -->
    <path 
        d="M4 18L24 8L44 18L24 28L4 18Z" 
        fill="currentColor" 
        opacity="0.9"
    />
    
    <!-- Tassel -->
    <path 
        d="M24 8V4" 
        stroke="currentColor" 
        stroke-width="2" 
        stroke-linecap="round"
    />
    <circle cx="24" cy="3" r="2" fill="currentColor"/>
    
    <!-- Forward arrow indicating "Days Out" / progress -->
    <path 
        d="M30 36L36 36M36 36L32 32M36 36L32 40" 
        stroke="currentColor" 
        stroke-width="2.5" 
        stroke-linecap="round" 
        stroke-linejoin="round"
    />
</svg>
