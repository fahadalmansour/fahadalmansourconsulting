import {
  ArrowRight,
  BarChart3,
  Database,
  FileCheck,
  GitBranch,
  LineChart,
  Target
} from 'lucide-react';
import Link from 'next/link';
import {services} from '@/data/services';
import {SectionHeading} from './section-heading';

const serviceIcons = [Target, Database, BarChart3, FileCheck, GitBranch, LineChart];

const detailHrefs: Record<string, {ar: string; en: string}> = {
  'data-strategy': {ar: '/services/data-strategy', en: '/en/services/data-strategy'}
};

type ServicesProps = {
  locale?: 'ar' | 'en';
};

export function Services({locale = 'ar'}: ServicesProps) {
  const isEnglish = locale === 'en';

  return (
    <section
      id="services"
      className="scroll-mt-28 bg-[color:var(--color-soft)] py-24"
    >
      <div className="section-shell">
        <SectionHeading
          align="center"
          index="DIM_03"
          eyebrow={isEnglish ? 'Practice areas' : 'مجالات الممارسة'}
          title={isEnglish ? 'Business analysis and data strategy services' : 'خدمات تحليل وتخطيط مبنية على البيانات'}
          description={
            isEnglish
              ? 'From business planning to analytics models and technical documents, each service is designed to create clarity before execution.'
              : 'من خطة العمل إلى النموذج التحليلي والوثائق التقنية، كل خدمة مصممة لإزالة الغموض قبل التنفيذ'
          }
        />

        <div className="mt-20 grid gap-px bg-[color:var(--color-border-strong)] md:grid-cols-2 lg:grid-cols-3">
          {services.map((service, i) => {
            const Icon = serviceIcons[i];
            const href = detailHrefs[service.id]?.[locale];
            const num = String(i + 1).padStart(2, '0');
            const cardClassName =
              'group relative block bg-[color:var(--color-white)] p-7 transition-colors duration-200 hover:bg-[color:var(--color-soft)]';
            const inner = (
              <>
                <span className="absolute inset-x-0 inset-block-start-0 block h-[3px] bg-[color:var(--color-ink)] origin-[inline-start] transition-transform duration-300 group-hover:scale-x-100" />
                <div className="flex items-start justify-between">
                  <span
                    className="brutal-mono text-3xl font-bold tracking-tight text-[color:var(--color-ink)]"
                    dir="ltr"
                  >
                    {num}
                  </span>
                  <div className="flex h-10 w-10 items-center justify-center border-2 border-[color:var(--color-ink)] transition-colors group-hover:bg-[color:var(--color-ink)]">
                    <Icon
                      className="h-5 w-5 text-[color:var(--color-ink)] transition-colors group-hover:text-[color:var(--color-white)]"
                      aria-hidden="true"
                    />
                  </div>
                </div>
                <div className="mt-6 flex items-center gap-2">
                  <span className="h-px w-8 bg-[color:var(--color-ink)]" />
                  <span
                    className="brutal-mono text-[10px] uppercase tracking-[0.22em] text-[color:var(--color-muted)]"
                    dir="ltr"
                  >
                    SERVICE
                  </span>
                </div>
                <h3 className="mt-4 brutal-display text-xl text-[color:var(--color-ink)]">
                  {isEnglish ? service.titleEn : service.title}
                </h3>
                <p className="mt-3 leading-relaxed text-[color:var(--color-muted)]">
                  {isEnglish ? service.descriptionEn : service.description}
                </p>
                {href ? (
                  <div
                    className="mt-6 flex items-center gap-2 brutal-mono text-[11px] uppercase tracking-[0.22em] text-[color:var(--color-accent)]"
                    dir="ltr"
                  >
                    <span>READ.SCHEMA</span>
                    <ArrowRight aria-hidden="true" className="h-4 w-4 transition-transform group-hover:-translate-x-1" />
                  </div>
                ) : null}
              </>
            );
            return href ? (
              <Link key={service.id} href={href} className={cardClassName}>
                {inner}
              </Link>
            ) : (
              <article key={service.id} className={cardClassName}>
                {inner}
              </article>
            );
          })}
        </div>
      </div>
    </section>
  );
}
