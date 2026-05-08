# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Repository Overview

FSC_Business is a **business documentation + WordPress theme repository** for Fahad Almansour Consulting Office (مكتب فهد المنصور للاستشارات), an independent IT decision consulting firm based in Riyadh, Saudi Arabia.

- CR Number: 7053130576
- Domain: fahadalmansourconsulting.com
- Service Area: Riyadh (in-person), Saudi Arabia & GCC (remote)

The repo root is also a **Next.js 16 application** (`package.json` name `fahad-consulting`): App Router under `app/`, shared UI in `components/`, helpers in `lib/`, bilingual messages in `messages/{ar,en}.json` via `next-intl` 4.9. Static export to `out/` (`next.config.ts`: `output: 'export'`, `trailingSlash: true`); Tailwind v4 via `@tailwindcss/postcss`; React 19, Supabase JS, Framer Motion. Deployed by `deploy/` (Ansible: `inventory.yml`, `playbook.yml`). **This CLAUDE.md focuses on the WordPress theme**; the Next.js app is only briefly noted here.

## Architecture

Two main components: **business documentation** (root `*.md` files) and a **custom WordPress theme** (`wordpress-theme/`).

### Business Documentation

18+ Markdown files with a hierarchical authority chain:

1. **`FAHAD_CONSULTING_PROJECT.md`** — Master business plan (single source of truth)
2. **`BRAND_KIT.md`** — Brand authority (colors, tone, typography → feeds into `style.css`)
3. **`FSC_MASTER_NOTION.md`** — 4 Notion database schemas (Services Catalog, Certifications Roadmap, Partner Network, Client Pipeline)
4. **`FSC_CONTRACTS_COMPLETE.md`** — Bilingual contract templates using `[VARIABLE]` placeholders (agreement numbering: `FSC-SA-[YEAR]-[NUMBER]`)
5. **`FSC_TRANSLATION_STRINGS.md`** — EN|AR translation pairs organized by page section, feeds into `languages/ar.po`
6. **Specialty files** — `WEBSITE_ARCHITECTURE.md` (sitemap/specs), `WEBSITE_CONTENT_EN.md` / `WEBSITE_CONTENT_AR.md` (copy), `FSC_SEO_KEYWORDS.md`, `FSC_COMPETITOR_ANALYSIS.md`, `FSC_LINKEDIN_SOCIAL_GUIDE.md`, `SOCIAL_MEDIA_PACK.md`, `FSC_COURSES_PRIORITIZED.md`

Content flows: Master plan → Brand kit → Translation strings → WordPress theme shortcodes → Website.

### WordPress Theme (`wordpress-theme/`)

Custom bilingual theme. Package name: `fsc`, v2.0.0. Requires WordPress 6.0+ and PHP 8.0+.

#### Rendering Flow

```
Request → header.php (language detection, fonts, nav, meta/SEO)
       → Template (front-page.php, page-{slug}.php, single.php, archive.php, etc.)
       → Shortcodes from inc/shortcodes.php render all section content
       → footer.php (contact info, legal links, social links, copyright)
```

#### Language System (`functions.php` lines 19-74)

Plugin-free bilingual switching. No Polylang/WPML required.

- **Detection priority**: `?lang=` URL param → `fsc_language` cookie (30-day, HttpOnly, secure) → default `ar`
- **Core helpers**: `fsc_get_current_language()` returns `'ar'`|`'en'`, `fsc_is_arabic()` returns bool, `fsc_language_switcher_url($lang)` builds switch URLs
- **Locale filter**: `fsc_switch_locale()` hooks `locale` at priority 1 (skips admin)
- **RTL**: Automatic via WordPress `is_rtl()` after locale switch. Templates use `$is_rtl` ternary for directional logic (arrow icons, margins, flex direction)
- **All translatable strings** use `__('text', 'fsc')` / `_e('text', 'fsc')` with text domain `fsc`

#### Shortcode System (`inc/shortcodes.php`, 1492 lines)

The **primary content delivery mechanism**. 21 registered shortcodes, all using output buffering (`ob_start()` / `ob_get_clean()`):

| Shortcode | Purpose |
|-----------|---------|
| `[fsc_hero]` | Homepage hero (integrates A/B testing for headline/CTA) |
| `[fsc_how_we_work]` | 4-step methodology |
| `[fsc_decision_areas]` | 3-column service areas grid |
| `[fsc_advisory_services]` | 2-column engagement models |
| `[fsc_what_you_receive]` | 5-item deliverables list |
| `[fsc_boundaries]` | "What We Don't Do" section |
| `[fsc_why_us]` | 4 value proposition cards |
| `[fsc_contact_form]` | Contact form (CF7 fallback to mailto) |
| `[fsc_intake_form]` | Extended discovery call form with qualification fields |
| `[fsc_contact_info]` | Contact sidebar |
| `[fsc_social_links]` | Social media icons (reads `fsc_linkedin`/`fsc_twitter`/`fsc_youtube` from Customizer) |
| `[fsc_trust_badges]` | 4 credential indicators |
| `[fsc_faq]` | Accordion FAQ (supports `limit` attribute) |
| `[fsc_neutrality_card]` | Vendor neutrality card |
| `[fsc_reference_architecture]` | 6-layer tech stack diagram |
| `[fsc_tools_standards]` | Tools/standards grid |
| `[fsc_vendor_neutrality]` | Dark-bg neutrality statement |
| `[fsc_engagement]` | 3-column engagement attributes |
| `[fsc_engagement_steps]` | 2-step process |
| `[fsc_what_to_expect]` | 4-item expectations checklist |
| `[fsc_latest_insights]` | Latest insights / blog teaser block (registered at `inc/shortcodes.php:759`) |

All shortcodes contain inline bilingual text via `_e()`. RTL handled with `[dir="rtl"]` selectors and PHP ternaries.

**Contact Form 7 integration**: `[fsc_contact_form]` and `[fsc_intake_form]` look up CF7 forms by slug (`advisory-inquiry`, `discovery-call-request`). Falls back to custom mailto form if CF7 not installed.

**A/B-only shortcodes** (registered in `inc/ab-testing.php:53–54`, not `shortcodes.php`): `[fsc_ab_test]` renders a test's variant content; `[fsc_ab_variant]` exposes the assigned variant key.

#### A/B Testing System (`inc/ab-testing.php` + `js/ab-tracking.js`)

Privacy-respecting, no external services. Cookie-based variant assignment.

**5 default tests**: `hero_headline`, `cta_button`, `hero_subheadline`, `why_us_title`, `contact_cta` — each with 3 variants (a/b/c).

**PHP API**:
- `fsc_ab($test_id)` — returns variant content string
- `fsc_ab_variant($test_id)` — returns variant key (`'a'`/`'b'`/`'c'`)
- `fsc_ab_e($test_id)` — echoes escaped variant content

**JS API** (global):
- `fscTrackConversion(testId)` — tracks conversion via AJAX (deduplicated per session via `sessionStorage`)
- `fscGetVariant(testId)` — returns current variant
- `fscIsVariant(testId, variant)` — boolean check

**Data flow**: Random assignment → `fsc_ab_variants` cookie (30-day) → impressions/conversions stored in `fsc_ab_test_results` WP option → admin dashboard at Themes > A/B Testing.

**AJAX endpoints** (`inc/ab-testing.php:57–58`): `wp_ajax_fsc_ab_conversion` (auth) + `wp_ajax_nopriv_fsc_ab_conversion` (anonymous), called by `js/ab-tracking.js`.

**Auto-tracking**: Form submissions, CTA clicks (`.btn-primary`, `[class*="cta"]`, `a[href*="contact"]`), and contact links (`mailto:`, `tel:`, `whatsapp`) are automatically tracked.

**Debug mode**: `?debug_ab=1` logs variants to console.

#### JavaScript Architecture (`js/`)

4 files, all loaded in footer. No build step.

| File | Global API | Storage | PHP Dependency |
|------|-----------|---------|----------------|
| `ab-tracking.js` | `fscTrackConversion()`, `fscGetVariant()`, `fscIsVariant()` | `sessionStorage` | `fscAB` object (variants, ajaxurl, nonce) |
| `cookie-consent.js` | None (self-contained) | `localStorage` (`fsc-cookie-consent`, `fsc-cookie-preferences`) | `fscParams` object (ga_id, gtm_id, pixel_id) — optional |
| `form-tools.js` | `FSCFormTools` object (14 methods) | `localStorage` (`fsc_form_autosave`) | None |
| `navigation.js` | `fscSetLanguage(lang)` | cookies | None (Polylang-aware) |

**Cookie consent** loads GA/GTM/Meta Pixel only after user consent. Preferences: `essential` (always on), `analytics`, `functional`, `marketing`.

**Form tools** provides: `copyFormAsText()`, `copyFormAsJSON()`, `printForm()`, `printContactCard()` (8 business cards per A4), `exportFormAsPDF()`, `saveFormProgress()`, `restoreFormProgress()`, `validateForm()`, `showSuccessOverlay()`, `showNotification()`. Auto-saves all forms every 30s with 2s debounce. Bilingual (detects RTL via `document.documentElement.dir`).

**Navigation** handles: mobile menu toggle (`#mobile-menu-toggle`), smooth scroll with header offset (80px), sticky header shadow on scroll, back-to-top, language cookie setting.

#### CSS Architecture (`style.css` + `assets/css/animations.css`)

Hybrid: **design tokens + utility classes (Tailwind-inspired naming) + BEM-style components**, all hand-authored in vanilla CSS with custom properties. The WordPress theme has **no Tailwind toolchain or build step** — utilities are written by hand. (The repo's separate Next.js side does use Tailwind v4 via `@tailwindcss/postcss`; that does not apply to the theme.)

**Design tokens** (`:root`):
- Full slate color scale (`--slate-50` through `--slate-950`)
- Spacing scale (base-4: `--space-1` through `--space-20`)
- Border radius scale (`--radius-sm` through `--radius-full`)
- 4 shadow levels (`--shadow-sm`/`md`/`lg`/`xl`)
- 3 transition speeds (`--transition-fast`/`base`/`slow` at 150/200/300ms)
- Button semantic colors (`--btn-primary-bg`, `--btn-secondary-bg`)

**Component classes**: `.btn` (`.btn-primary`/`.btn-secondary`/`.btn-ghost`), `.card` (`.card-alt`), `.fsc-form` (`.form-group`/`.form-label`/`.form-input`/`.form-select`/`.form-card`), `.proposal-template`, `.fsc-logo`

**State classes**: `.is-loading`, `.is-valid`, `.is-invalid`, `.has-error`, `.has-success`

**RTL approach**: `[dir="rtl"]` attribute selector for selective overrides (font family → Tajawal, text-align → right, flex-direction → row-reverse, margin flips, form element repositioning).

**Animations** (`animations.css`): 6 keyframes (`fadeIn`, `slideUp`, `slideInLeft`, `pulse`, `float`, `shimmer`). Grid stagger delays (0.05s increments on `:nth-child`). `prefers-reduced-motion: reduce` respected.

**Responsive**: Mobile-first, 3 breakpoints — `sm` (640px), `md` (768px), `lg` (1024px).

**Print styles**: Comprehensive `@media print` — A4 page setup, serif font (Georgia), link URL display, page break control, hidden interactive elements.

#### SEO System (`functions.php` lines 351-839)

Built into the theme, no plugin needed:
- **Titles**: `fsc_seo_title()` — page-specific bilingual titles via `pre_get_document_title` filter
- **Meta tags**: `fsc_seo_meta_tags()` — description, keywords, author, robots, canonical, Open Graph, Twitter Cards, geo tags (Riyadh: 24.7136, 46.6753), hreflang alternates
- **Schema.org**: `fsc_schema_markup()` — JSON-LD for Organization (ProfessionalService), WebSite, page-specific schemas, FAQ schema (homepage). Business hours: Sun-Thu 9am-5pm. Area served: GCC countries
- **Breadcrumbs**: `fsc_breadcrumb_schema()` — BreadcrumbList JSON-LD
- **Performance**: `fsc_preload_resources()` — preloads stylesheet and fonts, DNS prefetch for Google services
- **Security headers**: X-Content-Type-Options, X-Frame-Options, X-XSS-Protection, Referrer-Policy
- **Accessibility**: Skip-to-content link, auto alt text on images, lazy loading

#### WordPress Customizer Settings

| Section | Settings |
|---------|----------|
| Social Media (`fsc_social_section`) | `fsc_linkedin`, `fsc_twitter`, `fsc_youtube` (URLs) |
| Tracking (`fsc_tracking_section`) | `fsc_ga_id`, `fsc_gtm_id`, `fsc_pixel_id`, `fsc_header_scripts` |

Retrieved via `get_theme_mod()`. Tracking IDs passed to JS as `fscParams` object.

#### Theme Activation

`fsc_create_pages()` auto-creates 10 required pages on `after_switch_theme`: case-studies, about, contact, services, how-we-work, privacy, cookies, terms, disclaimer, disclosure. Each gets the correct `_wp_page_template` meta.

**Fix tool**: Visit `/wp-admin/admin.php?fsc_fix_templates=1` to repair missing page templates (requires `manage_options` capability).

#### HTML Templates (`templates/`)

4 standalone HTML templates for document generation:

- **`contract-template.html`** — Consulting Services Agreement with Schedule A (Scope) and Schedule B (Fees). Variables: `[NUMBER]`, `[DATE]`, `[CLIENT]`, `[AMOUNT]`, `[IBAN]`. Serif typography (Georgia). Governing law: KSA.
- **`proposal-template.html`** — Consulting Proposal with 11 sections (Executive Summary → Scope → Deliverables → Timeline → Investment → Terms → Acceptance → Signatures). Proposal numbering: `FSC-YYYYMM-###`.
- **`email-template.html`** — English email notification. Table-based layout (Outlook-compatible), 600px max-width, dark mode support.
- **`email-template-ar.html`** — Arabic variant with `dir="rtl"`, Tajawal font, expanded line-height (1.9 vs 1.7), footer forced LTR for URLs/phone.

#### Form Generator (`tools/form_generator.py`)

Python CLI tool for PDF/HTML document generation.

```bash
pip install reportlab weasyprint pyperclip jinja2  # all optional with graceful fallback

# Generate PDFs
python3 wordpress-theme/tools/form_generator.py pdf --type contact [--input data.json]
python3 wordpress-theme/tools/form_generator.py pdf --type proposal
python3 wordpress-theme/tools/form_generator.py pdf --type card

# Generate proposal with client name
python3 wordpress-theme/tools/form_generator.py proposal --client "Company Name"

# Generate bilingual HTML form
python3 wordpress-theme/tools/form_generator.py html --language ar

# Copy form data to clipboard
python3 wordpress-theme/tools/form_generator.py copy --input data.json --format text|json
```

**Classes**: `ContactFormData` (form submission wrapper), `ProposalData` (proposal with auto-numbering `FSC-YYYYMM-HHMMSS`), `PDFGenerator` (ReportLab-based, A4, custom header/footer on every page).

**Output**: `./output/` directory. Business cards print 2x4 grid at 85×55mm (standard size).

#### PWA Support

`manifest.json` configured for standalone PWA: `lang: "ar"`, `dir: "rtl"`, SVG icons at 3 sizes (favicon, 192px, 512px). Theme color: `#0a1628`.

#### Elementor Compatibility (`inc/elementor-compat.php`, 72 lines)

Lets Elementor optionally override the FSC theme on a per-page basis. Four helpers (lines 19, 26, 45, 59):

- `fsc_is_elementor_active()` — Elementor plugin loaded?
- `fsc_is_elementor_page($post_id)` — page edited with Elementor (checks `_elementor_edit_mode` meta)?
- `fsc_is_elementor_canvas()` — canvas template active?
- `fsc_has_elementor_location($location)` — theme-builder location registered?

All `page-*.php` templates use the same pattern: if `fsc_is_elementor_page(get_the_ID())` is true, render via `the_content()`; otherwise fall back to native FSC HTML + shortcodes. `header.php` and `footer.php` mirror this with their own canvas/location checks.

### Supporting Directories

- **`logo/`** — 13 SVG logo files + HTML preview pages (`fsc-logo-system.html`, `fsc-link-page.html`)
- **`Freelance.sa/`** — Saudi freelance certificates (PDFs, 4 active certificates)

### Repo Root Artifacts (Not Tracked Here in Detail)

- **Theme distribution ZIPs** at root: `fsc-theme.zip` (~68K), `fsc-theme-production.zip` (~4.5M), `fsc-consulting-theme.zip` (~4.8M). Manual builds; no formal canonical version — verify timestamps before deploy.
- **DNS zone file**: `fahadalmansourconsulting.com.zone`.
- **`files.zip`** (~164K) — contents not documented.
- **Additional business markdown** at the root not enumerated under §Business Documentation (e.g. `ACTION-PLAN.md`, `AGENTS.md`, `BRAND.md`, `CLOUDFLARE_SETUP_GUIDE.md`, `FULL-AUDIT-REPORT.md`, `GEMINI.md`, `PROGRESS.md`). Treat the documentation hierarchy in §Business Documentation as authoritative; the rest is supplementary or historical.
- **Mac duplicate artifacts**: `CLAUDE 2.md`, `README 2.md` are spurious copies — ignore.
- `README.md` at the repo root is currently **empty** (one blank line).

## CI/CD

Two pipelines exist; both are partly carry-over from earlier identities of this repo and may not all be live. Verify before relying on them.

1. **GitHub Actions** — `.github/workflows/claude-ops.yml`. Three jobs on push/PR to `main`:
   - `generators-syntax`: compile-checks root-level `generate_brand_kit.py` and `generate_official.py` with Python 3.12 + Pillow + numpy. **Note:** these generator scripts are not currently in the working tree (they were part of the older brand-asset identity of the repo) — this job will fail until they're restored or removed.
   - `brand-kit-drift`: patches `BASE_DIR` to `$GITHUB_WORKSPACE`, runs the generators if `badge_logo.png` is present, and warns on diffs in `brand_kit/` or `fahad-almansour.com/`. Both directories are also gone from the tree.
   - `secrets-scan`: `gitleaks-action@v2` over the full repo.
2. **Forgejo Actions** — `FSC_Business/.forgejo/workflows/ci.yaml` (a sub-tree, not repo root). Self-hosted runner, Docker container; checkout, file listing, repo info. Triggers only on changes inside `FSC_Business/`.

**There is no `.forgejo/` at the repo root** despite earlier docs claiming so.

## Key Business Rules

### 3-Option Proposal Rule
Every client proposal must include exactly 3 options: **A** (recommended), **B** (budget), **C** (premium). Encoded in contracts, Notion pipeline, website copy, and form generator.

### 4-Stage Client Process
Form Intake → Study & Video Call → Summary & Proposal → Approval & PDF Delivery

### Advisory-Only Boundaries
No implementation, no managed services, no product sales, no reselling. Vendor-neutral. Referral commissions disclosed per `/disclosure/` page.

### Brand Voice
Calm authority, professional, vendor-neutral. State facts plainly. Present options objectively. Never use superlatives or promise guaranteed outcomes.

### Brand Colors
| Token | Hex | Usage |
|-------|-----|-------|
| `--bg-primary` | `#FFFFFF` | Page background |
| `--bg-section` | `#F8FAFC` | Section backgrounds |
| `--text-primary` | `#0F172A` | Primary text, accent |
| `--text-muted` | `#64748B` | Secondary text |
| `--border` | `#E2E8F0` | Borders |
| `--success` | `#059669` | Micro-accent (checkmarks) |

## Bilingual Content

All client-facing content requires EN + AR versions:
- **English**: Inter font, LTR
- **Arabic**: Tajawal font, RTL, Modern Standard Arabic (فصحى)
- **Default**: Arabic
- **Switch mechanism**: `?lang=en` / `?lang=ar` URL parameter → `fsc_language` cookie (30 days)
- **Translation source**: `FSC_TRANSLATION_STRINGS.md` → `wordpress-theme/languages/ar.po` → compile with `msgfmt -o wordpress-theme/languages/ar.mo wordpress-theme/languages/ar.po`

## External Assets

Additional website assets at `/Volumes/FahadsMind/02 PR Projects/FAM website/`:
- `html5-website/` — Static HTML5 site (deployment-ready)
- `wordpress-theme/` — Additional theme variants
- `logo/` — Additional logo files

## Operations

Operational runbooks live outside the repo at `~/sites/_docs/fahadalmansourconsulting/`:

- `AGENT.md` — agent / automation entry point
- `AUTOMATION.md` — scheduled jobs
- `DEPLOY.md` — deployment procedure
- `HOSTING.md` — DNS / hosting topology
- `README.md` — index
- `RUNBOOK.md` — incident runbook
- `STACK.md` — stack inventory

Consult these before changes to deployment, DNS, or hosting. They are the canonical source for ops facts that this CLAUDE.md does not duplicate.
