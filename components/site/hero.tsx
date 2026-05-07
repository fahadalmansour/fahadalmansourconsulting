import {ArrowDown, ArrowLeft, FileCheck, Shield, Target} from 'lucide-react';
import {siteConfig} from '@/data/site';
import {HeroVisual} from './hero-visual';

const trustIcons = [Shield, FileCheck, Target];

type HeroProps = {
  locale?: 'ar' | 'en';
};

const tickerSegments = [
  '24°37′N · 46°43′E',
  'QUEUE 02',
  'REV.04',
  'DRAWN 2026-04-26',
  'ENGAGEMENT.SCHEMA',
  'SCALE 1:1'
];

export function Hero({locale = 'ar'}: HeroProps) {
  const isEnglish = locale === 'en';
  const kicker = isEnglish ? siteConfig.linkedInTitle : siteConfig.hero.titleAccent;
  const summary = isEnglish ? siteConfig.hero.summaryEn : siteConfig.hero.summary;
  const secondary = isEnglish ? siteConfig.industry : siteConfig.hero.englishLine;
  const primaryCta = isEnglish ? 'Start diagnosis' : siteConfig.hero.primaryCta;
  const secondaryCta = isEnglish ? 'Review method' : siteConfig.hero.secondaryCta;
  const trustPoints = isEnglish
    ? [
        'Licensed in Business Analysis - Planning',
        'Misk Academy Data Science Bootcamp graduate',
        'Neutral online advisory practice'
      ]
    : siteConfig.hero.trustPoints;

  // Split title into lines for staggered clip-path reveal.
  const titleLines = isEnglish
    ? ['Fahad', 'Almansour', 'Consulting']
    : ['مكتب فهد', 'المنصور', 'للاستشارات'];

  // Two ticker tracks for seamless marquee loop.
  const tickerHTML = tickerSegments.concat(tickerSegments);

  return (
    <section className="relative overflow-hidden bg-[color:var(--color-white)] text-[color:var(--color-ink)]">
      {/* Top brutalist axis ticker */}
      <div className="axis-ticker pt-24 sm:pt-28" aria-hidden="true">
        <div className="axis-ticker-track">
          {tickerHTML.map((seg, i) => (
            <span key={`tk-${i}`} className="brutal-mono">
              {seg}
            </span>
          ))}
        </div>
      </div>

      {/* Blueprint grid backdrop */}
      <div
        aria-hidden="true"
        className="blueprint-grid pointer-events-none absolute inset-x-0"
        style={{
          insetBlockStart: '0',
          insetBlockEnd: '0',
          zIndex: 0
        }}
      />

      <div className="section-shell relative z-10 pt-12 pb-24 sm:pt-16 sm:pb-32">
        {/* Section index meta line */}
        <div className="hero-rise mb-8 flex items-center gap-3">
          <span className="brutal-mono text-[11px] uppercase tracking-[0.18em] text-[color:var(--color-muted)]">
            <span className="text-[color:var(--color-accent)]">●</span>{' '}
            <span dir="ltr" className="keep-ltr">SECTION 01 / HERO / DRAWN BY F. ALMANSOUR</span>
          </span>
        </div>

        <div className="grid gap-12 lg:grid-cols-[1.15fr_1fr] lg:items-end">
          <div className="relative">
            {/* Giant overlay numeral */}
            <div
              aria-hidden="true"
              className="hero-numeral pointer-events-none absolute select-none brutal-mono text-[color:var(--color-ink)]"
              style={{
                fontSize: 'clamp(8rem, 22vw, 18rem)',
                lineHeight: 0.85,
                fontWeight: 800,
                opacity: 0.06,
                insetBlockStart: '-2rem',
                insetInlineEnd: '-1rem',
                letterSpacing: '-0.04em'
              }}
            >
              01
            </div>

            <div className="relative">
              {/* Headline reveal lines */}
              <h1
                className="brutal-display max-w-[18ch] text-balance text-[color:var(--color-ink)]"
                style={{fontSize: 'clamp(2.75rem, 8vw, 6.25rem)'}}
              >
                {titleLines.map((line, i) => (
                  <span
                    key={line}
                    className="hero-clip block"
                    style={{animationDelay: `${300 + i * 100}ms`}}
                  >
                    {line}
                  </span>
                ))}
              </h1>

              {/* Hairline rule + dimension callout */}
              <div
                className="mt-8 flex items-center gap-3 hero-fade"
                style={{animationDelay: '700ms'}}
              >
                <span
                  className="brutal-mono text-[10px] uppercase tracking-[0.22em] text-[color:var(--color-muted)]"
                  dir="ltr"
                >
                  DIM_01
                </span>
                <span
                  className="hero-rule h-px flex-1 bg-[color:var(--color-ink)]"
                  style={{animationDelay: '750ms'}}
                />
                <span
                  className="brutal-mono text-[10px] tracking-[0.18em] text-[color:var(--color-muted)]"
                  dir="ltr"
                >
                  1.000m
                </span>
              </div>

              {/* Mono kicker */}
              <p
                dir="ltr"
                className="hero-rise keep-ltr mt-8 max-w-2xl text-base leading-relaxed text-[color:var(--color-muted)] sm:text-lg"
                style={{
                  fontFamily: 'var(--font-mono)',
                  letterSpacing: '0.02em',
                  animationDelay: '850ms'
                }}
              >
                {kicker}
              </p>

              {/* Body lede */}
              <p
                className="hero-rise mt-8 max-w-2xl text-lg leading-[1.85] text-[color:var(--color-ink)] sm:text-xl"
                style={{animationDelay: '950ms'}}
              >
                {summary}
              </p>

              {/* Secondary mono line */}
              <p
                dir="ltr"
                className="hero-rise keep-ltr mt-3 max-w-2xl text-[13px] leading-relaxed text-[color:var(--color-muted)]"
                style={{fontFamily: 'var(--font-mono)', animationDelay: '1050ms'}}
              >
                — {secondary}
              </p>

              {/* CTAs */}
              <div
                className="hero-rise mt-12 flex flex-col gap-3 sm:flex-row"
                style={{animationDelay: '1150ms'}}
              >
                <a
                  href="#contact"
                  className="group inline-flex h-14 items-center justify-center gap-3 border-2 border-[color:var(--color-ink)] bg-[color:var(--color-ink)] px-7 text-sm font-semibold uppercase tracking-[0.18em] text-[color:var(--color-white)] transition-colors duration-200 hover:bg-[color:var(--color-white)] hover:text-[color:var(--color-ink)]"
                  style={{fontFamily: 'var(--font-mono)'}}
                >
                  <span>{primaryCta}</span>
                  <ArrowLeft
                    className="h-4 w-4 transition-transform duration-200 group-hover:-translate-x-1"
                    aria-hidden="true"
                  />
                </a>
                <a
                  href="#process"
                  className="inline-flex h-14 items-center justify-center border-2 border-[color:var(--color-ink)] bg-transparent px-7 text-sm font-semibold uppercase tracking-[0.18em] text-[color:var(--color-ink)] transition-colors duration-200 hover:bg-[color:var(--color-ink)] hover:text-[color:var(--color-white)]"
                  style={{fontFamily: 'var(--font-mono)'}}
                >
                  {secondaryCta}
                </a>
              </div>
            </div>
          </div>

          <HeroVisual locale={locale} />
        </div>

        {/* Trust tiles row */}
        <div className="mt-24">
          <div className="mb-6 flex items-center gap-3">
            <span
              className="brutal-mono text-[10px] uppercase tracking-[0.22em] text-[color:var(--color-muted)]"
              dir="ltr"
            >
              TRUST_POINTS · DIM_02
            </span>
            <span className="hero-rule h-px flex-1 bg-[color:var(--color-border-strong)]" />
          </div>

          <div className="grid gap-px bg-[color:var(--color-border-strong)] sm:grid-cols-3">
            {trustPoints.map((point, i) => {
              const Icon = trustIcons[i];
              const num = String(i + 1).padStart(3, '0');
              return (
                <div
                  key={`trust-${i}`}
                  className="tile-reveal corner-bracket relative bg-[color:var(--color-white)] p-6 sm:p-8"
                  style={{animationDelay: `${i * 80}ms`}}
                >
                  <span
                    className="tile-rule absolute inset-x-0 inset-block-start-0 block h-[3px] bg-[color:var(--color-ink)]"
                    style={{animationDelay: `${i * 80}ms`}}
                  />
                  <div className="flex items-center justify-between">
                    <span
                      className="brutal-mono text-3xl font-bold tracking-tight text-[color:var(--color-ink)]"
                      dir="ltr"
                    >
                      {num}
                    </span>
                    <Icon
                      className="h-5 w-5 text-[color:var(--color-accent)]"
                      aria-hidden="true"
                    />
                  </div>
                  <div
                    className="mt-6 brutal-mono text-[10px] uppercase tracking-[0.18em] text-[color:var(--color-muted)]"
                    dir="ltr"
                  >
                    {['LIC', 'EDU', 'OPS'][i]}
                  </div>
                  <p className="mt-3 text-base leading-relaxed text-[color:var(--color-ink)]">
                    {point}
                  </p>
                </div>
              );
            })}
          </div>
        </div>

        {/* Scroll cue */}
        <div
          className="mt-16 flex items-center gap-3 hero-fade"
          style={{animationDelay: '1500ms'}}
        >
          <span
            className="brutal-mono text-[10px] uppercase tracking-[0.22em] text-[color:var(--color-muted)]"
            dir="ltr"
          >
            CONTINUE · DIM_03
          </span>
          <ArrowDown
            aria-hidden="true"
            className="scroll-cue inline-block h-4 w-4 text-[color:var(--color-ink)]"
          />
        </div>
      </div>
    </section>
  );
}
