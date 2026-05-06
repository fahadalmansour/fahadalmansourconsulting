# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this repo is

Brand identity system and website for **Fahad Saad Fahad Almansour — Office For Electronic Services**
(مكتب فهد سعد فهد المنصور للخدمات الإلكترونية), a Saudi establishment (CR #7053130576).

GitHub: https://github.com/fahadalmansour/fahadalmansourconsulting

## Key facts

| Field | Value |
|-------|-------|
| Domain | `fahadalmansouroffice.com` |
| Email | `info@fahadalmansouroffice.com` |
| Phone | `+966 57 013 1122` |
| CR | `#7053130576` |
| Primary theme | **Gold Premium** — bg `#0D0800`, gold `#E8C860`, pale gold `#FFF0A0`, accent `#C8A030` |
| Light theme | bg `#F9F7F3`, navy `#0E3B72`, gold `#B89030` |

## Regenerating assets

All asset generation requires **Pillow** and **numpy** (already installed system-wide):

```bash
# Regenerate ALL brand kit assets (favicons, profile pics, headers, watermarks)
python3 generate_brand_kit.py

# Regenerate official papers (letterhead, business cards, stamp, invoice, envelope)
python3 generate_official.py
```

Both scripts use **absolute paths** hardcoded to `/Users/fahadalmansour/fahad/` (the original working directory, not this clone location). Before running either script, patch `BASE_DIR` / `OUT` at the top of each file to point at the actual repo root (e.g. `/Users/fahadalmansour/sites/fahadalmansourconsulting`), otherwise all reads and writes will target the wrong path and fail silently.

Source images they read from:
- `badge_logo.png` — 568×624 RGBA, the primary badge source
- `logo_full.png` — full logo on white bg
- `logo_text.png` — text bands only
- `brand_kit/favicon/favicon-512x512.png` — used as badge input by `generate_official.py`

## Architecture

### Badge geometry (important for any SVG/image work)
- Source: `badge_logo.png` 568×624
- Circle center: `(288, 361)`, radius `244 px`
- Scale factor to 200px SVG radius: `SCALE_B = 200/244 ≈ 0.8197`
- Potrace coordinate transform: outer `translate(badge_tx, badge_ty) scale(SCALE_B)` + inner `translate(0, BH) scale(0.1, -0.1)`

### Transparent badge variants
- `brand_kit/badge_transparent.png` — full 568×624, dark bg removed via numpy threshold
- `brand_kit/badge_circle_transparent.png` — 400×400, cropped to circle, no bg

Dark background removal logic (in both scripts):
```python
brightness = r.astype(int) + g.astype(int) + b.astype(int)
dark_bg = (brightness < 120) & (r > g) & (r > b + 5)  # warm dark = bg
data[dark_bg, 3] = 0
```

### Website (`fahad-almansour.com/index.html`)
Single self-contained HTML file (~1.8 MB) — no build step, no dependencies.

- **Light mode is the hard default** — the JS never reads `localStorage` on load; it only writes when the user toggles. Remove the `localStorage.setItem` call too if persistence is unwanted entirely.
- Dark mode toggle: `data-theme="dark"` on `<html>`, toggled by `#themeBtn`.
- Badge is embedded as a `data:image/png;base64,...` URI (from `badge_circle_transparent.png`) — no external image URLs.
- All layout via CSS custom properties (`--navy`, `--gold`, `--bg`, etc.) that swap between themes.
- To update the badge in the website, re-run the Python base64 embed — do not manually edit the ~360 KB data URI string.

### `generate_official.py` — what each function produces
| Function | Output file | Size |
|----------|-------------|------|
| `make_stamp(ink, suffix)` | `stamp-{suffix}.png` | 900×900 transparent PNG |
| `make_letterhead()` | `letterhead-a4-dark.png` | 1240×1754 @ 150 DPI |
| `make_letterhead_light()` | `letterhead-a4.png` | 1240×1754 @ 150 DPI (primary) |
| `make_business_card()` | `business-card-{front,back}-dark.png` | 1050×600 @ 300 DPI |
| `make_business_card_light()` | `business-card-{front,back}.png` | 1050×600 @ 300 DPI (primary) |
| `make_invoice_header()` | `invoice-template.png` | 1240×1754 @ 150 DPI |
| `make_envelope()` | `envelope-dl.png` | 2598×1299 @ 300 DPI |

Light variants are the **primary** files (no suffix). Dark variants have `-dark` suffix.

### Fonts used (macOS system paths)
```
~/Library/Fonts/NotoNaskhArabic-VariableFont_wght.ttf   ← Arabic body
/System/Library/Fonts/Supplemental/Arial Bold.ttf
/System/Library/Fonts/Supplemental/Arial.ttf
/System/Library/Fonts/Supplemental/Times New Roman Bold.ttf
```

## Updating domain / contact info

Domain and contact details appear in five places — update all together:
1. `generate_official.py` — string literals in layout functions
2. `generate_brand_kit.py` — if referenced
3. `brand_kit/email/email_template.html` — use `sed -i '' 's/old/new/g'`
4. `brand_kit/email/email_signature.html` — same
5. `fahad-almansour.com/index.html` — Python script rebuilds the whole file with new values
6. `README.md` — Business Information table

After editing `generate_official.py`, run it to regenerate all PNG assets.

## Conventions

- **Never reply in Arabic in the CLI** — RTL breaks the terminal. Arabic content goes inside files only.
- `brand_kit/official/` light = primary name, dark = `-dark` suffix. Do not invert this.
- The interactive SVG files (`fahad_almansour_logo_gold.html`, `fahad_logo_variants.html`) are self-contained — no server needed, open directly in a browser.
- `fahad-almansour.com/` is a **plain directory** (was a submodule, converted to tracked files in commit `8d59043`). Commit website changes normally within this repo — no submodule pointer to update.
