import type {Metadata} from 'next';
import {ArrowLeft} from 'lucide-react';
import Link from 'next/link';
import {getAboutStructuredData} from '@/app/site-structured-data';
import {Footer} from '@/components/site/footer';
import {Header} from '@/components/site/header';

const aboutTitle = 'فهد سعد المنصور — السيرة والمؤهلات | مكتب فهد المنصور للاستشارات';
const aboutDescription =
  'مستشار مستقل في تحليل الأعمال واستراتيجية البيانات. مرخص في تحليل الأعمال - التخطيط من وزارة الموارد البشرية والتنمية الاجتماعية، وخريج معسكر علم البيانات من أكاديمية مسك.';

export const metadata: Metadata = {
  title: aboutTitle,
  description: aboutDescription,
  alternates: {canonical: '/about/'},
  openGraph: {
    title: aboutTitle,
    description: aboutDescription,
    url: '/about/',
    type: 'profile',
    locale: 'ar_SA'
  },
  twitter: {
    card: 'summary_large_image',
    title: aboutTitle,
    description: aboutDescription
  }
};

const credentials = [
  {
    code: 'LIC',
    label: 'الترخيص المهني',
    title: 'مرخص في تحليل الأعمال - التخطيط',
    issuer: 'وزارة الموارد البشرية والتنمية الاجتماعية',
    year: '2024'
  },
  {
    code: 'EDU',
    label: 'التعليم',
    title: 'بكالوريوس إدارة الأعمال',
    issuer: 'الجامعة السعودية الإلكترونية',
    year: '2025',
    verbatim: 'Bachelor of Business Administration — Saudi Electronic University | 2025'
  },
  {
    code: 'BTC',
    label: 'التدريب المتخصص',
    title: 'معسكر علم البيانات',
    issuer: 'أكاديمية مسك',
    year: '2023'
  }
] as const;

type TimelineEntry = {
  range: string;
  role: string;
  org: string;
  note: string;
  isPriorEmployer?: boolean;
};

const timeline: readonly TimelineEntry[] = [
  {
    range: '2024 — اليوم',
    role: 'مؤسس ومستشار رئيسي',
    org: 'مكتب فهد المنصور للاستشارات',
    note: 'ممارسة مستقلة عن بُعد في تحليل الأعمال واستراتيجية البيانات.'
  },
  {
    range: '2021 — 2024',
    role: 'خبرات تشغيلية وتقنية في القطاع الخاص',
    org: 'مشاريع ومهام تحليلية متعددة',
    note: 'تطوير ممارسة التحليل والمتطلبات والنمذجة بالتوازي مع التدريب الأكاديمي.'
  },
  {
    range: 'سابقاً',
    role: 'صاحب عمل سابق',
    org: 'زين السعودية',
    note: 'خبرة سابقة في القطاع الخاص. ليست عميلاً للممارسة الاستشارية الحالية.',
    isPriorEmployer: true
  },
  {
    range: 'سابقاً',
    role: 'صاحب عمل سابق',
    org: 'ماريوت / شيراتون',
    note: 'خبرة سابقة في الضيافة. ليست عميلاً للممارسة الاستشارية الحالية.',
    isPriorEmployer: true
  }
];

const principles = [
  {
    n: '01',
    title: 'الوضوح قبل الأداة',
    body: 'لا نوصي بمنصة قبل أن نوثق المتطلبات ونرسم نموذج البيانات. الأداة نتيجة، لا مدخل.'
  },
  {
    n: '02',
    title: 'الحياد التام',
    body: 'لا عمولات من موردين، ولا شراكات تقنية مدفوعة. التوصية تخدم العميل وحده.'
  },
  {
    n: '03',
    title: 'التوثيق قابل للدفاع',
    body: 'كل قرار يخرج بمبرر مكتوب، مصدر بيانات معلوم، ومعيار قبول قابل للقياس.'
  },
  {
    n: '04',
    title: 'العمل عن بُعد',
    body: 'جلسات منظمة، وثائق مشتركة، وحوكمة وقت واضحة. لا اجتماعات بلا مخرج.'
  }
] as const;

const practiceAreas = [
  {label: 'تحليل الأعمال', href: '/services/data-strategy'},
  {label: 'استراتيجية البيانات', href: '/services/data-strategy'},
  {label: 'البنية التحتية للبيانات', href: '/services/data-strategy'},
  {label: 'التحليلات والتقارير', href: '/services/data-strategy'}
] as const;

export default function AboutPage() {
  return (
    <div className="relative min-h-screen overflow-hidden bg-[color:var(--color-white)] text-[color:var(--color-ink)]">
      <div aria-hidden="true" className="blueprint-grid pointer-events-none absolute inset-0" />

      <div className="relative z-10">
        <Header locale="ar" />

        <main id="main">
          {/* Hero */}
          <section className="pt-32 sm:pt-40">
            <div className="section-shell">
              <div
                className="brutal-mono text-[11px] uppercase tracking-[0.22em] text-[color:var(--color-muted)]"
                dir="ltr"
              >
                <span className="text-[color:var(--color-accent)]">●</span>{' '}
                DIM_01 / ABOUT / FAHAD ALMANSOUR
              </div>

              <h1
                className="brutal-display mt-8 max-w-[14ch] text-balance text-[color:var(--color-ink)]"
                style={{fontSize: 'clamp(3rem, 9vw, 7rem)', lineHeight: 0.92}}
              >
                فهد سعد المنصور
              </h1>

              <p
                className="mt-6 brutal-mono text-base uppercase tracking-[0.04em] text-[color:var(--color-muted)] sm:text-lg"
                dir="ltr"
              >
                Founder &amp; Principal Consultant
                <br />
                Business Analysis &amp; Data Strategy
              </p>

              <div className="mt-10 flex items-center gap-3">
                <span className="hero-rule h-px w-32 bg-[color:var(--color-ink)]" />
                <span
                  className="brutal-mono text-[10px] uppercase tracking-[0.22em] text-[color:var(--color-muted)]"
                  dir="ltr"
                >
                  DIM_01.LEDE
                </span>
                <span className="hero-rule h-px flex-1 bg-[color:var(--color-ink)]/20" />
              </div>

              <p className="mt-8 max-w-2xl text-base leading-[1.85] text-[color:var(--color-ink)] sm:text-lg">
                مستشار مستقل يعمل عن بُعد. أساعد المنشآت على تحويل الأهداف الإدارية وملاحظات الميدان إلى متطلبات موثقة، نموذج بيانات يمكن قياسه، وقرارات يُدافَع عنها بالأرقام. أعمل مع فِرَق صغيرة، ألتزم بنطاق محدد، وأكتب وثائق يقرأها مجلس الإدارة قبل أن تستلمها التقنية.
              </p>

              <dl className="mt-12 grid gap-px border-2 border-[color:var(--color-ink)] bg-[color:var(--color-ink)] sm:grid-cols-4">
                {[
                  {k: 'الموقع', v: 'الرياض، السعودية'},
                  {k: 'النموذج', v: 'استشارات عن بُعد'},
                  {k: 'اللغات', v: 'العربية، الإنجليزية'},
                  {k: 'التوفر', v: 'مهام محدودة الكمّ'}
                ].map((row) => (
                  <div key={row.k} className="bg-[color:var(--color-white)] p-5">
                    <dt
                      className="brutal-mono text-[10px] uppercase tracking-[0.18em] text-[color:var(--color-muted)]"
                    >
                      {row.k}
                    </dt>
                    <dd className="mt-2 text-sm text-[color:var(--color-ink)]">{row.v}</dd>
                  </div>
                ))}
              </dl>
            </div>
          </section>

          {/* Credentials */}
          <section className="pt-24 sm:pt-32">
            <div className="section-shell">
              <div className="mb-8 flex items-center gap-3">
                <span className="hero-rule h-px w-16 bg-[color:var(--color-ink)]" />
                <span
                  className="brutal-mono text-[11px] uppercase tracking-[0.22em] text-[color:var(--color-accent)]"
                  dir="ltr"
                >
                  DIM_02 / CREDENTIALS
                </span>
                <span className="hero-rule h-px flex-1 bg-[color:var(--color-ink)]/20" />
              </div>

              <h2
                className="brutal-display max-w-2xl text-balance"
                style={{fontSize: 'clamp(2rem, 5vw, 3.5rem)', lineHeight: 0.96}}
              >
                المؤهلات
              </h2>
              <p className="mt-6 max-w-xl text-base leading-relaxed text-[color:var(--color-muted)]">
                ترخيص واحد، شهادة جامعية واحدة، تدريب متخصص واحد. لا أكثر، ولا تضخيم.
              </p>

              <ul className="mt-12 grid gap-px bg-[color:var(--color-border-strong)] sm:grid-cols-3">
                {credentials.map((c) => (
                  <li
                    key={c.code}
                    className="corner-bracket relative bg-[color:var(--color-white)] p-7"
                  >
                    <span className="absolute inset-x-0 inset-block-start-0 block h-[3px] bg-[color:var(--color-ink)]" />
                    <div className="flex items-center justify-between">
                      <span
                        className="brutal-mono text-3xl font-bold tracking-tight text-[color:var(--color-ink)]"
                        dir="ltr"
                      >
                        {c.code}
                      </span>
                      <span
                        className="brutal-mono text-[10px] uppercase tracking-[0.22em] text-[color:var(--color-accent)]"
                        dir="ltr"
                      >
                        {c.year}
                      </span>
                    </div>
                    <div
                      className="mt-6 brutal-mono text-[10px] uppercase tracking-[0.18em] text-[color:var(--color-muted)]"
                    >
                      {c.label}
                    </div>
                    <h3 className="mt-3 text-lg font-semibold leading-snug text-[color:var(--color-ink)]">
                      {c.title}
                    </h3>
                    <p className="mt-2 text-sm leading-relaxed text-[color:var(--color-muted)]">
                      {c.issuer}
                    </p>
                    {'verbatim' in c && c.verbatim ? (
                      <p
                        className="mt-4 brutal-mono text-[10px] text-[color:var(--color-accent)]"
                        dir="ltr"
                      >
                        {c.verbatim}
                      </p>
                    ) : null}
                  </li>
                ))}
              </ul>
            </div>
          </section>

          {/* Background timeline */}
          <section className="pt-24 sm:pt-32">
            <div className="section-shell">
              <div className="mb-8 flex items-center gap-3">
                <span className="hero-rule h-px w-16 bg-[color:var(--color-ink)]" />
                <span
                  className="brutal-mono text-[11px] uppercase tracking-[0.22em] text-[color:var(--color-accent)]"
                  dir="ltr"
                >
                  DIM_03 / BACKGROUND
                </span>
                <span className="hero-rule h-px flex-1 bg-[color:var(--color-ink)]/20" />
              </div>

              <h2
                className="brutal-display max-w-2xl text-balance"
                style={{fontSize: 'clamp(2rem, 5vw, 3.5rem)', lineHeight: 0.96}}
              >
                المسار
              </h2>
              <p className="mt-6 max-w-xl text-base leading-relaxed text-[color:var(--color-muted)]">
                الجهات المذكورة أدناه أصحاب عمل سابقون. ليست عملاء للممارسة الاستشارية الحالية.
              </p>

              <ol className="mt-12 border-y-2 border-[color:var(--color-ink)] divide-y-2 divide-[color:var(--color-ink)]">
                {timeline.map((item, i) => (
                  <li
                    key={`${item.org}-${i}`}
                    className="grid grid-cols-12 gap-6 py-7"
                  >
                    <div className="col-span-12 sm:col-span-3">
                      <span
                        className="brutal-mono text-[11px] uppercase tracking-[0.06em] text-[color:var(--color-muted)]"
                        dir="ltr"
                      >
                        {item.range}
                      </span>
                      {item.isPriorEmployer ? (
                        <div className="mt-3">
                          <span
                            className="inline-block border-2 border-[color:var(--color-ink)] bg-[color:var(--color-soft)] px-2 py-0.5 brutal-mono text-[10px] uppercase tracking-[0.18em] text-[color:var(--color-muted)]"
                            dir="ltr"
                          >
                            prior employer · not a client
                          </span>
                        </div>
                      ) : null}
                    </div>
                    <div className="col-span-12 sm:col-span-9">
                      <h3 className="brutal-display text-2xl text-[color:var(--color-ink)]">
                        {item.org}
                      </h3>
                      <p className="mt-1 text-base text-[color:var(--color-ink)]">{item.role}</p>
                      <p className="mt-3 max-w-2xl text-sm leading-relaxed text-[color:var(--color-muted)]">
                        {item.note}
                      </p>
                    </div>
                  </li>
                ))}
              </ol>
            </div>
          </section>

          {/* Principles */}
          <section className="pt-24 sm:pt-32">
            <div className="section-shell">
              <div className="mb-8 flex items-center gap-3">
                <span className="hero-rule h-px w-16 bg-[color:var(--color-ink)]" />
                <span
                  className="brutal-mono text-[11px] uppercase tracking-[0.22em] text-[color:var(--color-accent)]"
                  dir="ltr"
                >
                  DIM_04 / HOW I WORK
                </span>
                <span className="hero-rule h-px flex-1 bg-[color:var(--color-ink)]/20" />
              </div>

              <h2
                className="brutal-display max-w-3xl text-balance"
                style={{fontSize: 'clamp(2rem, 5.5vw, 4rem)', lineHeight: 0.96}}
              >
                أربعة مبادئ تحكم كل مهمة
              </h2>

              <ul className="mt-12 grid gap-px bg-[color:var(--color-border-strong)] sm:grid-cols-2 lg:grid-cols-4">
                {principles.map((p) => (
                  <li key={p.n} className="bg-[color:var(--color-white)] p-7">
                    <div
                      className="brutal-mono text-2xl font-bold text-[color:var(--color-ink)]"
                      dir="ltr"
                    >
                      {p.n}
                    </div>
                    <h3 className="mt-5 text-lg font-semibold leading-snug text-[color:var(--color-ink)]">
                      {p.title}
                    </h3>
                    <p className="mt-3 text-sm leading-relaxed text-[color:var(--color-muted)]">
                      {p.body}
                    </p>
                  </li>
                ))}
              </ul>
            </div>
          </section>

          {/* Practice areas */}
          <section className="pt-24 sm:pt-32">
            <div className="section-shell">
              <div className="mb-8 flex items-center gap-3">
                <span className="hero-rule h-px w-16 bg-[color:var(--color-ink)]" />
                <span
                  className="brutal-mono text-[11px] uppercase tracking-[0.22em] text-[color:var(--color-accent)]"
                  dir="ltr"
                >
                  DIM_05 / PRACTICE
                </span>
                <span className="hero-rule h-px flex-1 bg-[color:var(--color-ink)]/20" />
              </div>

              <h2
                className="brutal-display max-w-2xl text-balance"
                style={{fontSize: 'clamp(2rem, 5vw, 3.5rem)', lineHeight: 0.96}}
              >
                مجالات العمل
              </h2>

              <ul className="mt-10 border-y-2 border-[color:var(--color-ink)]">
                {practiceAreas.map((a, i) => (
                  <li
                    key={`${a.label}-${i}`}
                    className="border-b-2 border-[color:var(--color-ink)] last:border-b-0"
                  >
                    <Link
                      href={a.href}
                      className="group flex items-center justify-between py-6 transition-colors hover:bg-[color:var(--color-soft)]"
                    >
                      <span className="brutal-display text-2xl text-[color:var(--color-ink)] transition-colors group-hover:text-[color:var(--color-accent)]">
                        {a.label}
                      </span>
                      <ArrowLeft
                        aria-hidden="true"
                        className="h-4 w-4 text-[color:var(--color-muted)] transition-transform group-hover:-translate-x-1"
                      />
                    </Link>
                  </li>
                ))}
              </ul>
            </div>
          </section>

          {/* Closing */}
          <section className="pt-24 pb-32 sm:pt-32 sm:pb-40">
            <div className="section-shell">
              <div className="border-y-2 border-[color:var(--color-ink)] py-12">
                <p
                  className="brutal-display max-w-3xl text-balance"
                  style={{fontSize: 'clamp(1.6rem, 3.6vw, 2.75rem)', lineHeight: 1.1}}
                >
                  إن كانت لديك مسألة تستحق وثيقة قبل الأداة، أرسلها.
                </p>
                <div className="mt-10 flex flex-wrap items-center gap-4">
                  <Link
                    href="/#contact"
                    className="inline-flex h-12 items-center gap-2 border-2 border-[color:var(--color-ink)] bg-[color:var(--color-ink)] px-6 brutal-mono text-[12px] font-semibold uppercase tracking-[0.22em] text-[color:var(--color-white)] transition-colors hover:bg-[color:var(--color-white)] hover:text-[color:var(--color-ink)]"
                  >
                    REQUEST.DIAGNOSIS
                  </Link>
                  <a
                    href="mailto:consulting@fahadalmansourconsulting.com"
                    className="brutal-mono text-sm text-[color:var(--color-accent)]"
                    dir="ltr"
                  >
                    consulting@fahadalmansourconsulting.com
                  </a>
                </div>
              </div>
            </div>
          </section>
        </main>

        <Footer locale="ar" />
      </div>
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{
          __html: JSON.stringify(getAboutStructuredData()).replace(/</g, '\\u003c')
        }}
      />
    </div>
  );
}
