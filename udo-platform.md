# UDO Platform - Master Development Plan

## 1. Project Overview
**Project Name:** UDO Platform (University Day's Out)
**Type:** Event Companion App (Digital Guidebook + Attendance System)
**Target Audience:** Students attending the event (Strictly Mobile Users).
**Goal:** Replace physical guestbooks with a seamless **Web App (PWA-like)** experience. Users scan QR -> Fill Absen -> Get Dashboard.

## 2. Tech Stack
- **Framework:** Laravel 12.x
- **Admin Panel:** FilamentPHP v4.x
- **Frontend:** Blade Templates + TailwindCSS + Alpine.js
- **Database:** MySQL
- **Testing:** Pest
- **Asset Bundling:** Vite

## 3. Core Business Logic & Flows

### A. The Gate (Visitor "Soft Auth")
Instead of traditional login, we use a session-based attendance system.
1.  **Entry:** User scans QR Code -> opens URL.
2.  **Middleware (`CheckVisitorRegistration`):**
    - Checks for specific cookie/session `visitor_registered`.
    - **If Missing:** Redirect to `/welcome`.
    - **If Present:** Allow access to `/home`.
3.  **Registration Form (Mobile Optimized):**
    - Inputs: Name, School Origin (Asal Sekolah), Class (Kelas).
    - **UX:** Use multi-step or clean simple form. No complex validation.
    - Action: Saves to `visitors` table -> Sets cookie (valid for 30 days) -> Redirects to `/home`.

### B. The Digital Guidebook (Main App Dashboard)
**CRITICAL:** This must NOT look like a landing page. It must look like a **Mobile App Dashboard**.
1.  **Home Dashboard:**
    - **Header:** Personalized greeting ("Hi, [Name]!") + Event Time/Status.
    - **Quick Action Grid (Bento Style):** 4-6 Large Icons for Map, Tenants, Rundown, Rules.
    - **Highlights:** Horizontal scroll (carousel) for "Featured Universities" or "Live Now".
2.  **Interactive Map (SVG Based):**
    - Display venue layout using Inline SVG.
    - **Logic:** SVG elements have IDs (e.g., `booth-A1`). Database records for Universities/UMKM have a corresponding `map_booth_id` column.
    - **Interaction:** Pinch-to-zoom enabled. Clicking a booth opens a Bottom Sheet (Modal) with details.
3.  **Directories:**
    - **Universities:** List of campuses, profile, majors, brochure download.
    - **UMKM:** Food tenants, menu list, price range.
    - **Sponsors & Media Partners.**

## 4. Database Schema Requirements (Unchanged)

### `visitors`
- `id` (PK)
- `name` (string)
- `school_origin` (string)
- `class` (string)
- `visited_at` (timestamp)
- `ip_address` (nullable)
- `user_agent` (nullable)

### `universities`
- `id` (PK)
- `name` (string)
- `slug` (unique)
- `description` (text, nullable)
- `logo_path` (string)
- `map_booth_id` (string, nullable) -> Matches SVG ID (e.g., 'A1')
- `website_url` (nullable)
- `is_favorite` (boolean)

### `umkms`
- `id` (PK)
- `name` (string)
- `description` (text)
- `menu_list` (json/text)
- `price_range` (string)
- `map_booth_id` (string, nullable)

### `sponsors`
- `id` (PK)
- `name` (string)
- `logo_path` (string)
- `type` (enum: Platinum, Gold, Silver, Media Partner)

### `rundowns`
- `id` (PK)
- `title` (string)
- `start_time` (datetime)
- `end_time` (datetime)
- `description` (text)

## 5. UI/UX Design Guidelines (STRICT)
**The UI must emulate a Native Mobile App:**
1.  **Navigation:**
    - **Bottom Navigation Bar (Fixed):** Essential for mobile. Items: Home, Map, Rundown, Profile (Edit Data).
    - **Sticky Header:** Keep the brand/greeting visible.
2.  **Visual Style:**
    - **Vibe:** Gen Z, Dynamic, University Event.
    - **Colors:** Use "Electric Purple" gradients (not flat corporate blue/purple).
    - **Shapes:** Heavy use of `rounded-2xl` or `rounded-3xl` for cards.
    - **Effects:** Soft shadows (`shadow-lg`), Glassmorphism (`backdrop-blur`) on headers/navbars.
3.  **Layout Structure:**
    - No full-screen hero banners that push content down.
    - Use **Cards** and **Grids** for menus.
    - Tap targets (buttons) must be at least 44px height (finger friendly).

## 6. Development Phases (Agent Instructions)

**Phase 1: Foundation**
1.  Setup Laravel 12 & Filament v4.
2.  Create Migrations & Models for all tables.
3.  Setup Filament Resources (University, Umkm, Sponsor, Rundown, Visitor).

**Phase 2: The Gate (Frontend Logic)**
1.  Create `Visitor` Model & Migration.
2.  Create `WelcomeController`. View must be a simple, clean mobile form.
3.  Implement `CheckVisitorRegistration` Middleware.

**Phase 3: The App Interface (Frontend)**
1.  **Layout Setup:** Create `layouts/app.blade.php` featuring the **Bottom Navigation Bar**.
2.  **Home Dashboard:** Implement the "Bento Grid" menu style and Greeting Header.
3.  **Map Logic:** Create Blade component for SVG Map with Panzoom.js integration.
4.  **Detail Pages:** Use Bottom Sheets or clean mobile pages for University/UMKM details.

**Phase 4: Content & Polish**
1.  Implement Rundown and Info pages.
2.  **Final UX Check:** Ensure no "Desktop" elements remain. Test scroll areas.