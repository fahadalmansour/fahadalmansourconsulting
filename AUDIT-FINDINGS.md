# fahadalmansourconsulting — Visual/UX Audit

Last run: **2026-05-08** · Run ID: **2026-05-08-1500**
Captured: `~/.claude/reports/fahadalmansourconsulting/screenshots/2026-05-08/` (6 shots: home + about × 3 viewports × en)
HEAD: `69b7c49`
Notion: https://www.notion.so/e38bdfd54e3343109402b1def5e8c693

> **Capture caveat**: AR variants and contact page returned 404 / weren't reached. About page returned **Arabic content even when EN was requested** — indicates a locale-routing bug (see H1 below).

**Tally:** 2 BLOCKER · 3 HIGH · 5 MEDIUM · 5 LOW = **15 findings**

---

## BLOCKER

### B1. Home renders raw WordPress defaults — `fsc` theme is not active on home route
- Viewport / page / locale: all / home / en
- Source: `wp-content/themes/fsc/` not selected as active theme OR no static front page set
- Fix: WP Admin → Appearance → Themes → activate `fsc`. Then Settings → Reading → "Your homepage displays" → static page using the `fsc` front-page template; verify `front-page.php` / `page-home.php` is wired to the 21 documented shortcodes (hero, services, FAQ, contact).
- Evidence: Screenshot shows only header wordmark, "Hello world!" H1, "MAY 5 2026 / Uncategorized" meta, "Welcome to WordPress" placeholder, footer wordmark + 3 social icons. No hero, services, FAQ, or contact components visible at any viewport.

### B2. Seeded WP demo content still public — "Hello world!" post + "Sample Page"
- Source: WP Admin → Posts / Pages
- Fix: Delete the "Hello world!" post and "Sample Page"; remove "Uncategorized" default category; clear the latest-posts loop from the home template.
- Evidence: Visible "Hello world!" headline with `MAY 5, 2026 / Uncategorized` and "Welcome to WordPress" placeholder. Header nav shows "Sample Page" as the only menu item at 768/1280.

---

## HIGH

### H1. About EN page returns Arabic / RTL content — locale router bug
- Viewport / page / locale: all / about / en (returned AR)
- Source: `wp-content/themes/fsc/` (cookie-based language switch; no plugin per CLAUDE.md)
- Fix: Verify the `fsc_lang` cookie / query param honors `?lang=en` on `/about/`; ensure the EN about template exists and is selected when `fsc_lang=en`. If the capture script set the cookie correctly, the bug is server-side; otherwise fix the capture harness.
- Evidence: About screenshots at 360 / 768 / 1280 render fully RTL Arabic ("فهد سعد المنصور", "BTC/EDU/LTC" tickers, "المسار", "أربعة مبادئ تحكم كل مهمة", "مجالات العمل") with no English variant present.

### H2. Header wordmark wraps to 2 lines on mobile and crowds the hamburger
- Source: `fsc/header.php` + site-title CSS
- Fix: Below 480 px reduce `site-title` font-size from ~28 px to 18-20 px (or shorten visible wordmark to "FSF Almansour Office" with full name in `aria-label`); allow `white-space: nowrap`.
- Evidence: Mobile header shows `FAHAD SAAD FAHAD / ALMANSOUR OFFICE` breaking across two lines and consuming ~20% of viewport height; hamburger sits at line 1, misaligned with line 2.

### H3. Inconsistent brand casing — header `OFFICE` vs footer `Office` on the same screen
- Source: `fsc/header.php` vs `fsc/footer.php`
- Fix: Standardize on a single token. Recommended: `Fahad Saad F. Almansour Office` (Title Case) in both header and footer.
- Evidence: Header reads `FAHAD SAAD FAHAD ALMANSOUR OFFICE` (all caps); footer on the same screenshot reads `FAHAD SAAD FAHAD ALMANSOUR Office` (mixed).

---

## MEDIUM

### M1. Duplicated "FAHAD" in legal/brand name reads as a typo
- Source: Settings → General → Site Title
- Fix: Confirm legal name with operator. Likely intended `Fahad Saad Almansour Office`. If `Fahad Saad Fahad` is correct per CR, clarify with `Fahad S. Almansour`.

### M2. Footer is bare — no CR, email, copyright, address
- Source: `fsc/footer.php`
- Fix: Three columns / one row: (1) wordmark + tagline, (2) contact (email, phone, Riyadh address), (3) legal (CR number, copyright year, privacy link). KSA MoC commercial-registration disclosure requires this.
- Evidence: Footer at 1280 shows only the wordmark left and three unlabeled social icons right; vast empty space below.

### M3. Social icons lack accessible labels and visible focus states
- Source: footer social block
- Fix: `aria-label="Instagram" / "Facebook" / "X (Twitter)"` per `<a>`; `:focus-visible { outline: 2px solid currentColor; outline-offset: 3px }`; tap target ≥44×44.

### M4. No skip-to-content link, hamburger missing `aria-expanded` / `aria-controls`
- Source: `fsc/header.php`
- Fix: Add focusable skip link; ensure hamburger button is ≥44×44 with `aria-expanded` toggle and `aria-controls` pointing to the menu.

### M5. Vertical rhythm broken — ~280 px of whitespace between header and H1 at 1280
- Source: `fsc` site-main wrapper padding
- Fix: Reduce `.site-main` top padding from ~280 px to ~96 px on desktop, ~48 px on mobile.

---

## LOW

### L1. Date locale uses English all-caps month for a bilingual KSA audience
- Source: `fsc` post-meta partial
- Fix: Use `get_the_date()` with locale-aware format; EN `5 May 2026`, AR `٥ مايو ٢٠٢٦`. Drop the all-caps month styling.

### L2. Type hierarchy flat — H1 "Hello world!" competes with site-title at same weight
- Source: `fsc` typography tokens
- Fix: `.site-title { font-weight: 600; font-size: 18-20px }`; reserve 700-800 for H1.

### L3. Tickers row `BTC / EDU / LTC` on About is unexplained, off-brand
- Source: `fsc` about template / shortcode block
- Fix: Re-label or remove. For a vendor-neutral consulting voice, ticker-style finance widgets read as marketing fluff. If they represent track-record categories, use plain text headings instead.

### L4. Four-principle grid: oversized `01/02/03/04` numerals dominate the principle text
- Source: `fsc` principles shortcode
- Fix: Add 1 px hairline dividers between cells (or wrap each in a card with 24 px padding); reduce numeric size from ~64 px to ~40 px so principle copy leads.

### L5. Contact CTA at bottom of About lacks button affordance
- Source: `fsc` contact-cta shortcode
- Fix: Render email as a styled `<button>` / `<a class="btn">` with `min-height: 44px`, `padding: 12px 20px`, filled or outlined treatment.

---

## Summary

This audit surfaced something more serious than visual debt: **the consulting site is currently serving raw WordPress defaults on the home route.** The `fsc` theme (per CLAUDE.md: 21 shortcodes, A/B testing, bilingual cookie system) does not appear to be active or wired to a static front page. Until B1 + B2 are addressed, every other finding is downstream of "the actual site isn't visible."

The second-tier issue is **locale routing**: the about page returns Arabic content when EN is requested. This needs root-cause investigation — possibly the `fsc_lang` cookie isn't honored on `/about/`, or the EN about template doesn't exist. AR variants and the contact page also failed to capture, suggesting wider routing issues.

Once B1/B2/H1 are fixed, the remaining 12 findings are component-level CSS/markup edits in the `fsc` theme — none require a rewrite.
