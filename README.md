# Fahad Almansour — Brand & Logo Project

<p align="center">
  <img src="logo_full.png" alt="Fahad Almansour Logo" width="480"/>
</p>

---

## Project Overview

This repository contains the complete brand identity assets and interactive SVG logo system for **Fahad Saad Fahad Almansour** — a Saudi establishment specializing in electronic services and e-commerce.

> مكتب فهد سعد فهد المنصور للخدمات الإلكترونية  
> مؤسسة سعودية متخصصة في الخدمات الإلكترونية والتجارة الإلكترونية

---

## Logo

### Badge

<p align="center">
  <img src="badge_logo.png" alt="Badge" width="220"/>
</p>

The circular badge combines two design languages:

| Left half | Right half |
|-----------|-----------|
| Traditional Islamic geometric diamond patterns | Modern globe with connected network nodes |
| Heritage / identity | Technology / e-commerce |

**Key elements inside the badge:**

- **ف** (Fa) — large gold Arabic calligraphy, the initial of Fahad
- **Palm tree** — Saudi identity symbol, at the top
- **Globe** — represents international digital reach
- **Islamic geometric border** — diamond lattice pattern in gold on navy

---

## Color Palette

| Role | Name | Hex |
|------|------|-----|
| Primary | Deep Navy | `#0E3B72` |
| Accent | Gold | `#C8A848` |
| Highlight | Pale Gold | `#FFF0A0` |
| Dark BG | Midnight Brown | `#0D0800` |
| Light BG | White | `#FFFFFF` |

---

## Logo Variants

Six color-theme variants were produced from the same vector paths:

| # | Theme | Background | Text & Badge |
|---|-------|-----------|--------------|
| 1 | **Classic** | White | Navy + Gold |
| 2 | **Dark Navy** | `#0A1E3A` | Light blue + Gold |
| 3 | **Midnight Black** | `#0D0D0D` | Steel blue + Gold |
| 4 | **Gold Premium** ⭐ | `#0D0800` | Gold + Bright gold |
| 5 | **Slate Grey** | `#F0F2F5` | Dark navy + Bronze |
| 6 | **Emerald** | `#F5FFF8` | Forest green + Gold |

> ⭐ **Gold Premium** is the selected primary brand variant.

---

## Files

| File | Description |
|------|-------------|
| `fahad_almansour_logo_gold.html` | **Gold Premium** interactive SVG — drag all elements, export SVG/PNG |
| `logo_full.png` | Full logo on white background (badge + all text) |
| `badge_logo.png` | Isolated badge / emblem |
| `fahad-almansour.com/` | Website source |

---

## Interactive SVG — `fahad_almansour_logo_gold.html`

Open this file in any modern browser to get:

- **4 independently draggable elements:**
  - Badge / Emblem
  - Arabic calligraphy title
  - English name & subtitle
  - Arabic & English footer text
- **Export buttons:**
  - `SVG` — clean scalable vector file
  - `PNG` — 2× high-resolution raster (1800 × 1520 px)
  - `Reset` — snap all elements back to original positions

---

## Technical Process

The logo SVG was produced by:

1. **Color extraction** — separating the source PNG into pixel masks (navy, gold, dark) using NumPy thresholding on RGB values
2. **Potrace vectorization** — tracing each color mask to smooth bezier paths (`turdsize=2`, `opttolerance=0.1`)
3. **Layer assembly** — stacking navy + gold path layers inside a clipped circle with a radial gradient background
4. **Outer ring** — 3 concentric gold strokes + 24 diamond polygons at 15° intervals around the circumference
5. **Text bands** — each text line traced separately and positioned using potrace coordinate transforms
6. **Interactivity** — scale-aware drag-and-drop JS bound to each SVG `<g>` group element

---

## How to Use

**View Gold Premium interactive logo:**
```bash
open fahad_almansour_logo_gold.html
```

**View all 6 color variants:**
```bash
open fahad_logo_variants.html
```

---

## Business Info

| Field | Detail |
|-------|--------|
| Name (AR) | مكتب فهد سعد فهد المنصور للخدمات الإلكترونية |
| Name (EN) | Fahad Saad Fahad Almansour — Office For Electronic Services |
| Type | Saudi Establishment (مؤسسة سعودية) |
| Specialty | Electronic services & e-commerce |
| CR | #7053130576 |
