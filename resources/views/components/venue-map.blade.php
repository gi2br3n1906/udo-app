<svg viewBox="0 0 800 600" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes->merge(['class' => 'w-full h-full']) }}>
    <!-- Main Hall Floor -->
    <rect x="50" y="50" width="700" height="500" rx="30" fill="white" stroke="#CBD5E1" stroke-width="4"/>
    
    <!-- Entrance Label -->
    <text x="400" y="530" text-anchor="middle" font-family="sans-serif" font-size="14" fill="#94A3B8" font-weight="bold">MAIN ENTRANCE</text>
    <path d="M380 540 L400 520 L420 540" stroke="#CBD5E1" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>

    <!-- Booths Zone A (Left) -->
    <g id="zone-a">
        <text x="150" y="100" font-family="sans-serif" font-size="24" fill="#E2E8F0" font-weight="bold">ZONE A</text>
        
        <!-- Booth A1 -->
        <rect id="booth-A1" x="100" y="150" width="80" height="80" rx="8" fill="white" stroke="#CBD5E1" stroke-width="2" class="booth-interactive transition-all duration-300"/>
        <text x="140" y="195" text-anchor="middle" font-family="sans-serif" font-size="12" fill="#64748B" pointer-events="none">A1</text>

        <!-- Booth A2 -->
        <rect id="booth-A2" x="100" y="250" width="80" height="80" rx="8" fill="white" stroke="#CBD5E1" stroke-width="2" class="booth-interactive transition-all duration-300"/>
        <text x="140" y="295" text-anchor="middle" font-family="sans-serif" font-size="12" fill="#64748B" pointer-events="none">A2</text>

        <!-- Booth A3 -->
        <rect id="booth-A3" x="100" y="350" width="80" height="80" rx="8" fill="white" stroke="#CBD5E1" stroke-width="2" class="booth-interactive transition-all duration-300"/>
        <text x="140" y="395" text-anchor="middle" font-family="sans-serif" font-size="12" fill="#64748B" pointer-events="none">A3</text>
    </g>

    <!-- Booths Zone B (Center/Right) -->
    <g id="zone-b">
         <text x="550" y="100" font-family="sans-serif" font-size="24" fill="#E2E8F0" font-weight="bold">ZONE B</text>

        <!-- Booth B1 -->
        <rect id="booth-B1" x="250" y="150" width="80" height="80" rx="8" fill="white" stroke="#CBD5E1" stroke-width="2" class="booth-interactive transition-all duration-300"/>
        <text x="290" y="195" text-anchor="middle" font-family="sans-serif" font-size="12" fill="#64748B" pointer-events="none">B1</text>

        <!-- Booth B2 -->
        <rect id="booth-B2" x="350" y="150" width="80" height="80" rx="8" fill="white" stroke="#CBD5E1" stroke-width="2" class="booth-interactive transition-all duration-300"/>
        <text x="390" y="195" text-anchor="middle" font-family="sans-serif" font-size="12" fill="#64748B" pointer-events="none">B2</text>

        <!-- Booth B3 -->
        <rect id="booth-B3" x="450" y="150" width="80" height="80" rx="8" fill="white" stroke="#CBD5E1" stroke-width="2" class="booth-interactive transition-all duration-300"/>
        <text x="490" y="195" text-anchor="middle" font-family="sans-serif" font-size="12" fill="#64748B" pointer-events="none">B3</text>
        
        <!-- Booth B4 -->
        <rect id="booth-B4" x="250" y="250" width="80" height="80" rx="8" fill="white" stroke="#CBD5E1" stroke-width="2" class="booth-interactive transition-all duration-300"/>
        <text x="290" y="295" text-anchor="middle" font-family="sans-serif" font-size="12" fill="#64748B" pointer-events="none">B4</text>

         <!-- Booth B5 -->
        <rect id="booth-B5" x="350" y="250" width="80" height="80" rx="8" fill="white" stroke="#CBD5E1" stroke-width="2" class="booth-interactive transition-all duration-300"/>
        <text x="390" y="295" text-anchor="middle" font-family="sans-serif" font-size="12" fill="#64748B" pointer-events="none">B5</text>

         <!-- Booth B6 -->
        <rect id="booth-B6" x="450" y="250" width="80" height="80" rx="8" fill="white" stroke="#CBD5E1" stroke-width="2" class="booth-interactive transition-all duration-300"/>
        <text x="490" y="295" text-anchor="middle" font-family="sans-serif" font-size="12" fill="#64748B" pointer-events="none">B6</text>

        <!-- Booth B7 -->
        <rect id="booth-B7" x="550" y="150" width="80" height="80" rx="8" fill="white" stroke="#CBD5E1" stroke-width="2" class="booth-interactive transition-all duration-300"/>
        <text x="590" y="195" text-anchor="middle" font-family="sans-serif" font-size="12" fill="#64748B" pointer-events="none">B7</text>

        <!-- Booth B8 -->
        <rect id="booth-B8" x="550" y="250" width="80" height="80" rx="8" fill="white" stroke="#CBD5E1" stroke-width="2" class="booth-interactive transition-all duration-300"/>
        <text x="590" y="295" text-anchor="middle" font-family="sans-serif" font-size="12" fill="#64748B" pointer-events="none">B8</text>
    </g>

    <!-- Stage Area -->
    <rect x="250" y="400" width="300" height="80" rx="40" fill="#F1F5F9"/>
    <text x="400" y="445" text-anchor="middle" font-family="sans-serif" font-size="16" fill="#94A3B8" font-weight="bold">MAIN STAGE</text>
</svg>
