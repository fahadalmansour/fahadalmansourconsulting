#!/usr/bin/env python3
"""
Fahad Almansour Consultant Office (FSC) - Form Generator & PDF Export Tools
============================================================================
Python toolkit for generating, copying, and printing forms.

Features:
- Generate PDF proposals/quotes
- Export contact forms to PDF
- Copy form data to clipboard
- Print professional documents
- Generate business cards
- Create engagement summaries

Requirements:
    pip install reportlab weasyprint pyperclip jinja2

Author: Fahad Almansour Consultant Office
Version: 2.0.0
"""

import os
import sys
import json
import argparse
from datetime import datetime
from pathlib import Path
from typing import Dict, List, Optional, Any

# Optional imports with fallbacks
try:
    from reportlab.lib import colors
    from reportlab.lib.pagesizes import A4, letter
    from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
    from reportlab.lib.units import inch, mm
    from reportlab.platypus import (
        SimpleDocTemplate, Paragraph, Spacer, Table, TableStyle,
        Image, PageBreak, HRFlowable
    )
    from reportlab.lib.enums import TA_CENTER, TA_RIGHT, TA_LEFT
    REPORTLAB_AVAILABLE = True
except ImportError:
    REPORTLAB_AVAILABLE = False
    print("Note: reportlab not installed. PDF generation disabled.")
    print("Install with: pip install reportlab")

try:
    import pyperclip
    CLIPBOARD_AVAILABLE = True
except ImportError:
    CLIPBOARD_AVAILABLE = False

try:
    from jinja2 import Template
    JINJA2_AVAILABLE = True
except ImportError:
    JINJA2_AVAILABLE = False


# ============================================
# Configuration
# ============================================

COMPANY_INFO = {
    "name": "Fahad Almansour Consultant Office",
    "name_ar": "مكتب فهد المنصور للاستشارات",
    "email": "info@fahadalmansourconsulting.com",
    "phone": "+966 57 013 1122",
    "website": "https://fahadalmansourconsulting.com",
    "address": "Riyadh",
    "city": "Riyadh",
    "state": "",
    "zip": "",
    "country": "Saudi Arabia",
    "tagline": "Professional IT Consulting",
    "tagline_ar": "استشارات تقنية المعلومات الاحترافية",
    "working_hours": "Sun - Thu: 9AM - 5PM (AST/UTC+3)",
}

COLORS = {
    "primary": (15, 23, 42),      # slate-900
    "secondary": (71, 85, 105),   # slate-600
    "accent": (59, 130, 246),     # blue-500
    "success": (34, 197, 94),     # green-500
    "warning": (234, 179, 8),     # yellow-500
    "error": (239, 68, 68),       # red-500
    "light": (248, 250, 252),     # slate-50
    "border": (226, 232, 240),    # slate-200
}

SERVICES = [
    {"id": "cloud", "name": "Cloud & Infrastructure", "name_ar": "السحابة والبنية التحتية"},
    {"id": "digital", "name": "Digital Transformation", "name_ar": "التحول الرقمي"},
    {"id": "security", "name": "Cybersecurity", "name_ar": "الأمن السيبراني"},
    {"id": "strategy", "name": "IT Strategy Consulting", "name_ar": "استشارات استراتيجية تقنية المعلومات"},
]

INDUSTRIES = {
    "technology": {"en": "Technology & Software", "ar": "التقنية والبرمجيات"},
    "finance": {"en": "Finance & Banking", "ar": "المالية والبنوك"},
    "healthcare": {"en": "Healthcare & Life Sciences", "ar": "الرعاية الصحية والعلوم الحيوية"},
    "retail": {"en": "Retail & E-commerce", "ar": "التجزئة والتجارة الإلكترونية"},
    "manufacturing": {"en": "Manufacturing & Industrial", "ar": "التصنيع والصناعة"},
    "government": {"en": "Government & Public Sector", "ar": "الحكومة والقطاع العام"},
    "education": {"en": "Education & Research", "ar": "التعليم والبحث العلمي"},
    "energy": {"en": "Energy & Utilities", "ar": "الطاقة والمرافق"},
    "real_estate": {"en": "Real Estate & Construction", "ar": "العقارات والبناء"},
    "other": {"en": "Other", "ar": "أخرى"},
}


# ============================================
# Form Data Classes
# ============================================

class ContactFormData:
    """Data class for contact/intake form submissions."""

    def __init__(self, data: Dict[str, Any]):
        self.company_name = data.get("company_name", "")
        self.contact_name = data.get("contact_name", "")
        self.email = data.get("email", "")
        self.phone = data.get("phone", "")
        self.company_size = data.get("company_size", "")
        self.industry = data.get("industry", "")
        self.services = data.get("services", [])
        self.clarity = data.get("clarity", "")
        self.timeline = data.get("timeline", "")
        self.message = data.get("message", "")
        self.submitted_at = data.get("submitted_at", datetime.now().isoformat())
        self.language = data.get("language", "en")

    def to_dict(self) -> Dict[str, Any]:
        return {
            "company_name": self.company_name,
            "contact_name": self.contact_name,
            "email": self.email,
            "phone": self.phone,
            "company_size": self.company_size,
            "industry": self.industry,
            "services": self.services,
            "clarity": self.clarity,
            "timeline": self.timeline,
            "message": self.message,
            "submitted_at": self.submitted_at,
            "language": self.language,
        }

    def to_text(self, include_header: bool = True) -> str:
        """Convert form data to plain text format."""
        lines = []

        if include_header:
            lines.append("=" * 50)
            lines.append("DISCOVERY CALL REQUEST")
            lines.append(f"Submitted: {self.submitted_at}")
            lines.append("=" * 50)
            lines.append("")

        lines.append(f"Company: {self.company_name}")
        lines.append(f"Contact: {self.contact_name}")
        lines.append(f"Email: {self.email}")
        lines.append(f"Phone: {self.phone}")
        lines.append(f"Company Size: {self.company_size} employees")

        industry_name = INDUSTRIES.get(self.industry, {}).get("en", self.industry)
        lines.append(f"Industry: {industry_name}")

        service_names = [s["name"] for s in SERVICES if s["id"] in self.services]
        lines.append(f"Services: {', '.join(service_names)}")

        clarity_map = {
            "clear": "Has clear project",
            "general": "Has general idea",
            "guidance": "Needs guidance"
        }
        lines.append(f"Project Clarity: {clarity_map.get(self.clarity, self.clarity)}")

        timeline_map = {
            "urgent": "Urgent (< 1 month)",
            "near-term": "Near-term (1-3 months)",
            "planning": "Planning (3-6 months)",
            "exploring": "Exploring (no rush)"
        }
        lines.append(f"Timeline: {timeline_map.get(self.timeline, self.timeline)}")

        lines.append("")
        lines.append("Message:")
        lines.append("-" * 30)
        lines.append(self.message)

        return "\n".join(lines)

    def to_json(self) -> str:
        """Convert form data to JSON string."""
        return json.dumps(self.to_dict(), indent=2, ensure_ascii=False)


class ProposalData:
    """Data class for proposal/quote generation."""

    def __init__(self, data: Dict[str, Any]):
        self.proposal_number = data.get("proposal_number", self._generate_number())
        self.date = data.get("date", datetime.now().strftime("%Y-%m-%d"))
        self.valid_until = data.get("valid_until", "")
        self.client_name = data.get("client_name", "")
        self.client_company = data.get("client_company", "")
        self.client_email = data.get("client_email", "")
        self.project_title = data.get("project_title", "")
        self.project_description = data.get("project_description", "")
        self.scope_items = data.get("scope_items", [])
        self.deliverables = data.get("deliverables", [])
        self.timeline_weeks = data.get("timeline_weeks", 0)
        self.line_items = data.get("line_items", [])
        self.subtotal = data.get("subtotal", 0)
        self.discount = data.get("discount", 0)
        self.total = data.get("total", 0)
        self.currency = data.get("currency", "USD")
        self.terms = data.get("terms", [])
        self.language = data.get("language", "en")

    def _generate_number(self) -> str:
        """Generate a unique proposal number."""
        now = datetime.now()
        return f"FSC-{now.year}{now.month:02d}-{now.strftime('%H%M%S')}"

    def to_dict(self) -> Dict[str, Any]:
        return vars(self)


# ============================================
# PDF Generator (using ReportLab)
# ============================================

class PDFGenerator:
    """Generate professional PDF documents."""

    def __init__(self, output_dir: str = "./output"):
        if not REPORTLAB_AVAILABLE:
            raise ImportError("reportlab is required for PDF generation")

        self.output_dir = Path(output_dir)
        self.output_dir.mkdir(parents=True, exist_ok=True)
        self.styles = getSampleStyleSheet()
        self._setup_custom_styles()

    def _setup_custom_styles(self):
        """Setup custom paragraph styles."""
        self.styles.add(ParagraphStyle(
            name='Title',
            parent=self.styles['Heading1'],
            fontSize=24,
            spaceAfter=20,
            textColor=colors.HexColor('#0f172a'),
            fontName='Helvetica-Bold',
        ))

        self.styles.add(ParagraphStyle(
            name='Subtitle',
            parent=self.styles['Normal'],
            fontSize=14,
            spaceAfter=30,
            textColor=colors.HexColor('#64748b'),
        ))

        self.styles.add(ParagraphStyle(
            name='SectionTitle',
            parent=self.styles['Heading2'],
            fontSize=14,
            spaceBefore=20,
            spaceAfter=10,
            textColor=colors.HexColor('#0f172a'),
            fontName='Helvetica-Bold',
            borderWidth=1,
            borderColor=colors.HexColor('#e2e8f0'),
            borderPadding=5,
        ))

        self.styles.add(ParagraphStyle(
            name='BodyText',
            parent=self.styles['Normal'],
            fontSize=10,
            spaceAfter=8,
            textColor=colors.HexColor('#334155'),
            leading=14,
        ))

        self.styles.add(ParagraphStyle(
            name='SmallText',
            parent=self.styles['Normal'],
            fontSize=8,
            textColor=colors.HexColor('#94a3b8'),
        ))

        self.styles.add(ParagraphStyle(
            name='TableHeader',
            parent=self.styles['Normal'],
            fontSize=10,
            fontName='Helvetica-Bold',
            textColor=colors.HexColor('#0f172a'),
        ))

    def _create_header(self, canvas, doc):
        """Draw page header with logo and company info."""
        canvas.saveState()

        # Logo placeholder (you can replace with actual logo)
        canvas.setFillColor(colors.HexColor('#0f172a'))
        canvas.setFont('Helvetica-Bold', 16)
        canvas.drawString(40, A4[1] - 40, COMPANY_INFO['name'])

        canvas.setFont('Helvetica', 9)
        canvas.setFillColor(colors.HexColor('#64748b'))
        canvas.drawString(40, A4[1] - 55, COMPANY_INFO['tagline'])

        # Contact info on right
        canvas.drawRightString(A4[0] - 40, A4[1] - 40, COMPANY_INFO['email'])
        canvas.drawRightString(A4[0] - 40, A4[1] - 52, COMPANY_INFO['phone'])
        canvas.drawRightString(A4[0] - 40, A4[1] - 64, COMPANY_INFO['website'])

        # Separator line
        canvas.setStrokeColor(colors.HexColor('#e2e8f0'))
        canvas.setLineWidth(1)
        canvas.line(40, A4[1] - 75, A4[0] - 40, A4[1] - 75)

        canvas.restoreState()

    def _create_footer(self, canvas, doc):
        """Draw page footer."""
        canvas.saveState()

        canvas.setStrokeColor(colors.HexColor('#e2e8f0'))
        canvas.setLineWidth(0.5)
        canvas.line(40, 50, A4[0] - 40, 50)

        canvas.setFont('Helvetica', 8)
        canvas.setFillColor(colors.HexColor('#94a3b8'))

        # Page number
        canvas.drawCentredString(A4[0] / 2, 35, f"Page {doc.page}")

        # Company info
        canvas.drawString(40, 35, f"{COMPANY_INFO['address']}, {COMPANY_INFO['city']}, {COMPANY_INFO['state']} {COMPANY_INFO['zip']}")

        canvas.restoreState()

    def generate_contact_form_pdf(self, form_data: ContactFormData, filename: str = None) -> str:
        """Generate PDF from contact form submission."""
        if not filename:
            timestamp = datetime.now().strftime("%Y%m%d_%H%M%S")
            filename = f"discovery_call_request_{timestamp}.pdf"

        filepath = self.output_dir / filename
        doc = SimpleDocTemplate(
            str(filepath),
            pagesize=A4,
            rightMargin=40,
            leftMargin=40,
            topMargin=90,
            bottomMargin=60,
        )

        story = []

        # Title
        story.append(Paragraph("Discovery Call Request", self.styles['Title']))
        story.append(Paragraph(f"Submitted: {form_data.submitted_at}", self.styles['SmallText']))
        story.append(Spacer(1, 20))

        # Client Information Table
        story.append(Paragraph("Client Information", self.styles['SectionTitle']))

        client_data = [
            ["Company Name:", form_data.company_name],
            ["Contact Name:", form_data.contact_name],
            ["Email:", form_data.email],
            ["Phone:", form_data.phone or "Not provided"],
            ["Company Size:", f"{form_data.company_size} employees"],
            ["Industry:", INDUSTRIES.get(form_data.industry, {}).get("en", form_data.industry)],
        ]

        client_table = Table(client_data, colWidths=[120, 350])
        client_table.setStyle(TableStyle([
            ('FONTNAME', (0, 0), (0, -1), 'Helvetica-Bold'),
            ('FONTNAME', (1, 0), (1, -1), 'Helvetica'),
            ('FONTSIZE', (0, 0), (-1, -1), 10),
            ('TEXTCOLOR', (0, 0), (0, -1), colors.HexColor('#64748b')),
            ('TEXTCOLOR', (1, 0), (1, -1), colors.HexColor('#0f172a')),
            ('BOTTOMPADDING', (0, 0), (-1, -1), 8),
            ('TOPPADDING', (0, 0), (-1, -1), 8),
            ('LINEBELOW', (0, 0), (-1, -1), 0.5, colors.HexColor('#e2e8f0')),
        ]))
        story.append(client_table)
        story.append(Spacer(1, 20))

        # Project Details
        story.append(Paragraph("Project Details", self.styles['SectionTitle']))

        service_names = [s["name"] for s in SERVICES if s["id"] in form_data.services]
        clarity_map = {
            "clear": "Has clear project with defined scope",
            "general": "Has general idea, needs help defining solution",
            "guidance": "Needs guidance and expert direction"
        }
        timeline_map = {
            "urgent": "Urgent (< 1 month)",
            "near-term": "Near-term (1-3 months)",
            "planning": "Planning (3-6 months)",
            "exploring": "Exploring options (no rush)"
        }

        project_data = [
            ["Services of Interest:", ", ".join(service_names) or "Not specified"],
            ["Project Clarity:", clarity_map.get(form_data.clarity, form_data.clarity)],
            ["Timeline:", timeline_map.get(form_data.timeline, form_data.timeline)],
        ]

        project_table = Table(project_data, colWidths=[120, 350])
        project_table.setStyle(TableStyle([
            ('FONTNAME', (0, 0), (0, -1), 'Helvetica-Bold'),
            ('FONTNAME', (1, 0), (1, -1), 'Helvetica'),
            ('FONTSIZE', (0, 0), (-1, -1), 10),
            ('TEXTCOLOR', (0, 0), (0, -1), colors.HexColor('#64748b')),
            ('TEXTCOLOR', (1, 0), (1, -1), colors.HexColor('#0f172a')),
            ('BOTTOMPADDING', (0, 0), (-1, -1), 8),
            ('TOPPADDING', (0, 0), (-1, -1), 8),
            ('LINEBELOW', (0, 0), (-1, -1), 0.5, colors.HexColor('#e2e8f0')),
            ('VALIGN', (0, 0), (-1, -1), 'TOP'),
        ]))
        story.append(project_table)
        story.append(Spacer(1, 20))

        # Message
        story.append(Paragraph("Message", self.styles['SectionTitle']))
        story.append(Paragraph(form_data.message or "No message provided.", self.styles['BodyText']))

        # Build PDF
        doc.build(story, onFirstPage=self._create_header, onLaterPages=self._create_header)

        return str(filepath)

    def generate_proposal_pdf(self, proposal: ProposalData, filename: str = None) -> str:
        """Generate PDF proposal/quote."""
        if not filename:
            filename = f"proposal_{proposal.proposal_number}.pdf"

        filepath = self.output_dir / filename
        doc = SimpleDocTemplate(
            str(filepath),
            pagesize=A4,
            rightMargin=40,
            leftMargin=40,
            topMargin=90,
            bottomMargin=60,
        )

        story = []

        # Proposal Header
        story.append(Paragraph("Consulting Proposal", self.styles['Title']))

        # Proposal meta
        meta_data = [
            [f"Proposal #: {proposal.proposal_number}", f"Date: {proposal.date}"],
            [f"Valid Until: {proposal.valid_until}", ""],
        ]
        meta_table = Table(meta_data, colWidths=[235, 235])
        meta_table.setStyle(TableStyle([
            ('FONTSIZE', (0, 0), (-1, -1), 9),
            ('TEXTCOLOR', (0, 0), (-1, -1), colors.HexColor('#64748b')),
        ]))
        story.append(meta_table)
        story.append(Spacer(1, 20))

        # Client Info
        story.append(Paragraph("Prepared For", self.styles['SectionTitle']))
        client_info = f"""
        <b>{proposal.client_company}</b><br/>
        {proposal.client_name}<br/>
        {proposal.client_email}
        """
        story.append(Paragraph(client_info, self.styles['BodyText']))
        story.append(Spacer(1, 20))

        # Project Description
        story.append(Paragraph("Project Overview", self.styles['SectionTitle']))
        story.append(Paragraph(f"<b>{proposal.project_title}</b>", self.styles['BodyText']))
        story.append(Paragraph(proposal.project_description, self.styles['BodyText']))
        story.append(Spacer(1, 15))

        # Scope
        if proposal.scope_items:
            story.append(Paragraph("Scope of Work", self.styles['SectionTitle']))
            for item in proposal.scope_items:
                story.append(Paragraph(f"• {item}", self.styles['BodyText']))
            story.append(Spacer(1, 15))

        # Deliverables
        if proposal.deliverables:
            story.append(Paragraph("Deliverables", self.styles['SectionTitle']))
            for item in proposal.deliverables:
                story.append(Paragraph(f"• {item}", self.styles['BodyText']))
            story.append(Spacer(1, 15))

        # Timeline
        story.append(Paragraph("Timeline", self.styles['SectionTitle']))
        story.append(Paragraph(f"Estimated Duration: {proposal.timeline_weeks} weeks", self.styles['BodyText']))
        story.append(Spacer(1, 20))

        # Pricing Table
        story.append(Paragraph("Investment", self.styles['SectionTitle']))

        pricing_header = ["Description", "Amount"]
        pricing_data = [pricing_header]

        for item in proposal.line_items:
            pricing_data.append([
                item.get("description", ""),
                f"${item.get('amount', 0):,.2f}"
            ])

        # Subtotal, discount, total
        pricing_data.append(["Subtotal", f"${proposal.subtotal:,.2f}"])
        if proposal.discount > 0:
            pricing_data.append(["Discount", f"-${proposal.discount:,.2f}"])
        pricing_data.append(["Total", f"${proposal.total:,.2f}"])

        pricing_table = Table(pricing_data, colWidths=[350, 120])
        pricing_table.setStyle(TableStyle([
            ('FONTNAME', (0, 0), (-1, 0), 'Helvetica-Bold'),
            ('BACKGROUND', (0, 0), (-1, 0), colors.HexColor('#f8fafc')),
            ('TEXTCOLOR', (0, 0), (-1, 0), colors.HexColor('#0f172a')),
            ('FONTSIZE', (0, 0), (-1, -1), 10),
            ('BOTTOMPADDING', (0, 0), (-1, -1), 10),
            ('TOPPADDING', (0, 0), (-1, -1), 10),
            ('LINEBELOW', (0, 0), (-1, -1), 0.5, colors.HexColor('#e2e8f0')),
            ('ALIGN', (1, 0), (1, -1), 'RIGHT'),
            ('FONTNAME', (0, -1), (-1, -1), 'Helvetica-Bold'),
            ('BACKGROUND', (0, -1), (-1, -1), colors.HexColor('#0f172a')),
            ('TEXTCOLOR', (0, -1), (-1, -1), colors.white),
        ]))
        story.append(pricing_table)
        story.append(Spacer(1, 20))

        # Terms
        if proposal.terms:
            story.append(Paragraph("Terms & Conditions", self.styles['SectionTitle']))
            for i, term in enumerate(proposal.terms, 1):
                story.append(Paragraph(f"{i}. {term}", self.styles['BodyText']))

        # Build PDF
        doc.build(story, onFirstPage=self._create_header, onLaterPages=self._create_header)

        return str(filepath)

    def generate_business_card_pdf(self, filename: str = "business_card.pdf") -> str:
        """Generate printable business card."""
        filepath = self.output_dir / filename

        # Business card size: 3.5" x 2"
        card_width = 3.5 * inch
        card_height = 2 * inch

        doc = SimpleDocTemplate(
            str(filepath),
            pagesize=A4,
            rightMargin=20,
            leftMargin=20,
            topMargin=20,
            bottomMargin=20,
        )

        story = []
        story.append(Paragraph("Business Cards - Print and Cut", self.styles['Heading1']))
        story.append(Spacer(1, 20))

        # Create card content
        card_data = [
            [COMPANY_INFO['name']],
            [COMPANY_INFO['tagline']],
            [""],
            [f"Email: {COMPANY_INFO['email']}"],
            [f"Phone: {COMPANY_INFO['phone']}"],
            [f"Web: {COMPANY_INFO['website']}"],
        ]

        card_table = Table(card_data, colWidths=[card_width])
        card_table.setStyle(TableStyle([
            ('FONTNAME', (0, 0), (0, 0), 'Helvetica-Bold'),
            ('FONTSIZE', (0, 0), (0, 0), 14),
            ('FONTSIZE', (0, 1), (0, 1), 9),
            ('FONTSIZE', (0, 3), (0, -1), 8),
            ('TEXTCOLOR', (0, 0), (0, 0), colors.HexColor('#0f172a')),
            ('TEXTCOLOR', (0, 1), (0, 1), colors.HexColor('#64748b')),
            ('TEXTCOLOR', (0, 3), (0, -1), colors.HexColor('#475569')),
            ('BOTTOMPADDING', (0, 0), (-1, -1), 4),
            ('TOPPADDING', (0, 0), (-1, -1), 4),
            ('BOX', (0, 0), (-1, -1), 1, colors.HexColor('#e2e8f0')),
            ('LEFTPADDING', (0, 0), (-1, -1), 15),
            ('RIGHTPADDING', (0, 0), (-1, -1), 15),
        ]))

        # Add multiple cards (2x4 grid)
        for _ in range(4):
            story.append(card_table)
            story.append(Spacer(1, 10))

        doc.build(story)
        return str(filepath)


# ============================================
# Clipboard Functions
# ============================================

def copy_to_clipboard(text: str) -> bool:
    """Copy text to system clipboard."""
    if not CLIPBOARD_AVAILABLE:
        print("Clipboard functionality not available. Install pyperclip.")
        return False

    try:
        pyperclip.copy(text)
        return True
    except Exception as e:
        print(f"Error copying to clipboard: {e}")
        return False


def copy_form_data(form_data: ContactFormData, format: str = "text") -> bool:
    """Copy form data to clipboard in specified format."""
    if format == "json":
        text = form_data.to_json()
    else:
        text = form_data.to_text()

    return copy_to_clipboard(text)


# ============================================
# HTML Template Generator
# ============================================

HTML_CONTACT_FORM_TEMPLATE = """
<!DOCTYPE html>
<html lang="{{ language }}" dir="{{ 'rtl' if language == 'ar' else 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ title }}</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: {{ "'Tajawal', " if language == 'ar' else '' }}'Inter', -apple-system, sans-serif;
            background: #f8fafc;
            padding: 2rem;
            color: #0f172a;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #0f172a;
        }
        .form-group {
            margin-bottom: 1.25rem;
        }
        label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #0f172a;
        }
        .required { color: #ef4444; }
        input, select, textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            background: white;
            transition: border-color 0.2s;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #0f172a;
            box-shadow: 0 0 0 3px rgba(15,23,42,0.1);
        }
        textarea { min-height: 100px; resize: vertical; }
        .btn {
            display: inline-block;
            padding: 0.875rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            background: #0f172a;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            width: 100%;
            transition: background 0.2s;
        }
        .btn:hover { background: #1e293b; }
        .radio-group, .checkbox-group { display: flex; flex-wrap: wrap; gap: 0.5rem; }
        .radio-option, .checkbox-option {
            flex: 1 1 calc(50% - 0.5rem);
            min-width: 120px;
        }
        .radio-option label, .checkbox-option label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem;
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s;
        }
        .radio-option input:checked + label,
        .checkbox-option input:checked + label {
            border-color: #0f172a;
            background: #f8fafc;
        }
        input[type="radio"], input[type="checkbox"] { width: auto; }
        @media print {
            body { background: white; padding: 0; }
            .container { box-shadow: none; }
            .btn { display: none; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ title }}</h1>
        <form id="contactForm">
            {{ form_fields }}
        </form>
    </div>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());
            console.log('Form Data:', data);
            alert('Form submitted! Check console for data.');
        });
    </script>
</body>
</html>
"""

def generate_html_form(
    fields: List[Dict[str, Any]],
    title: str = "Contact Form",
    language: str = "en"
) -> str:
    """Generate HTML form from field definitions."""
    if not JINJA2_AVAILABLE:
        raise ImportError("jinja2 is required for HTML generation")

    form_fields_html = []

    for field in fields:
        field_type = field.get("type", "text")
        field_id = field.get("id", "")
        field_label = field.get("label", "")
        required = field.get("required", False)
        options = field.get("options", [])
        placeholder = field.get("placeholder", "")

        required_mark = '<span class="required">*</span>' if required else ''
        required_attr = 'required' if required else ''

        if field_type == "text" or field_type == "email" or field_type == "tel":
            field_html = f'''
            <div class="form-group">
                <label for="{field_id}">{field_label} {required_mark}</label>
                <input type="{field_type}" id="{field_id}" name="{field_id}"
                       placeholder="{placeholder}" {required_attr}>
            </div>
            '''
        elif field_type == "textarea":
            field_html = f'''
            <div class="form-group">
                <label for="{field_id}">{field_label} {required_mark}</label>
                <textarea id="{field_id}" name="{field_id}"
                          placeholder="{placeholder}" {required_attr}></textarea>
            </div>
            '''
        elif field_type == "select":
            options_html = '<option value="">Select...</option>'
            for opt in options:
                opt_value = opt.get("value", "")
                opt_label = opt.get("label", "")
                options_html += f'<option value="{opt_value}">{opt_label}</option>'

            field_html = f'''
            <div class="form-group">
                <label for="{field_id}">{field_label} {required_mark}</label>
                <select id="{field_id}" name="{field_id}" {required_attr}>
                    {options_html}
                </select>
            </div>
            '''
        elif field_type == "radio":
            options_html = ""
            for i, opt in enumerate(options):
                opt_value = opt.get("value", "")
                opt_label = opt.get("label", "")
                checked = 'checked' if i == 0 and required else ''
                options_html += f'''
                <div class="radio-option">
                    <input type="radio" id="{field_id}_{i}" name="{field_id}"
                           value="{opt_value}" {required_attr} {checked}>
                    <label for="{field_id}_{i}">{opt_label}</label>
                </div>
                '''

            field_html = f'''
            <div class="form-group">
                <label>{field_label} {required_mark}</label>
                <div class="radio-group">{options_html}</div>
            </div>
            '''
        elif field_type == "checkbox":
            options_html = ""
            for i, opt in enumerate(options):
                opt_value = opt.get("value", "")
                opt_label = opt.get("label", "")
                options_html += f'''
                <div class="checkbox-option">
                    <input type="checkbox" id="{field_id}_{i}" name="{field_id}"
                           value="{opt_value}">
                    <label for="{field_id}_{i}">{opt_label}</label>
                </div>
                '''

            field_html = f'''
            <div class="form-group">
                <label>{field_label} {required_mark}</label>
                <div class="checkbox-group">{options_html}</div>
            </div>
            '''
        else:
            field_html = ""

        form_fields_html.append(field_html)

    # Add submit button
    form_fields_html.append('''
    <div class="form-group">
        <button type="submit" class="btn">Submit</button>
    </div>
    ''')

    template = Template(HTML_CONTACT_FORM_TEMPLATE)
    return template.render(
        title=title,
        language=language,
        form_fields="\n".join(form_fields_html)
    )


# ============================================
# CLI Interface
# ============================================

def main():
    parser = argparse.ArgumentParser(
        description="FSC - Form & PDF Tools",
        formatter_class=argparse.RawDescriptionHelpFormatter,
        epilog="""
Examples:
  # Generate PDF from contact form JSON
  python form_generator.py pdf --input form_data.json --output ./output

  # Copy form data to clipboard
  python form_generator.py copy --input form_data.json --format text

  # Generate sample proposal PDF
  python form_generator.py proposal --output ./proposals

  # Generate HTML form template
  python form_generator.py html --output contact_form.html
        """
    )

    subparsers = parser.add_subparsers(dest="command", help="Available commands")

    # PDF command
    pdf_parser = subparsers.add_parser("pdf", help="Generate PDF from form data")
    pdf_parser.add_argument("--input", "-i", help="Input JSON file with form data")
    pdf_parser.add_argument("--output", "-o", default="./output", help="Output directory")
    pdf_parser.add_argument("--type", "-t", choices=["contact", "proposal", "card"],
                           default="contact", help="Type of PDF to generate")

    # Copy command
    copy_parser = subparsers.add_parser("copy", help="Copy form data to clipboard")
    copy_parser.add_argument("--input", "-i", required=True, help="Input JSON file")
    copy_parser.add_argument("--format", "-f", choices=["text", "json"],
                            default="text", help="Output format")

    # Proposal command
    proposal_parser = subparsers.add_parser("proposal", help="Generate sample proposal")
    proposal_parser.add_argument("--output", "-o", default="./output", help="Output directory")
    proposal_parser.add_argument("--client", "-c", default="Sample Client", help="Client name")

    # HTML command
    html_parser = subparsers.add_parser("html", help="Generate HTML form template")
    html_parser.add_argument("--output", "-o", default="contact_form.html", help="Output file")
    html_parser.add_argument("--language", "-l", choices=["en", "ar"],
                            default="en", help="Form language")

    # Business card command
    card_parser = subparsers.add_parser("card", help="Generate business card PDF")
    card_parser.add_argument("--output", "-o", default="./output", help="Output directory")

    args = parser.parse_args()

    if args.command == "pdf":
        if not REPORTLAB_AVAILABLE:
            print("Error: reportlab is required. Install with: pip install reportlab")
            sys.exit(1)

        generator = PDFGenerator(args.output)

        if args.input:
            with open(args.input, "r", encoding="utf-8") as f:
                data = json.load(f)

            if args.type == "contact":
                form_data = ContactFormData(data)
                filepath = generator.generate_contact_form_pdf(form_data)
            elif args.type == "proposal":
                proposal_data = ProposalData(data)
                filepath = generator.generate_proposal_pdf(proposal_data)
            else:
                filepath = generator.generate_business_card_pdf()
        else:
            # Generate sample
            if args.type == "contact":
                sample_data = ContactFormData({
                    "company_name": "Acme Corporation",
                    "contact_name": "John Doe",
                    "email": "john@acme.com",
                    "phone": "+1 555 123 4567",
                    "company_size": "51-200",
                    "industry": "technology",
                    "services": ["cloud", "digital"],
                    "clarity": "general",
                    "timeline": "near-term",
                    "message": "We are looking for help with our cloud migration strategy.",
                })
                filepath = generator.generate_contact_form_pdf(sample_data)
            else:
                filepath = generator.generate_business_card_pdf()

        print(f"PDF generated: {filepath}")

    elif args.command == "copy":
        with open(args.input, "r", encoding="utf-8") as f:
            data = json.load(f)

        form_data = ContactFormData(data)
        if copy_form_data(form_data, args.format):
            print("Form data copied to clipboard!")
        else:
            print("Failed to copy to clipboard")

    elif args.command == "proposal":
        if not REPORTLAB_AVAILABLE:
            print("Error: reportlab is required. Install with: pip install reportlab")
            sys.exit(1)

        generator = PDFGenerator(args.output)

        sample_proposal = ProposalData({
            "client_name": args.client,
            "client_company": f"{args.client} Inc.",
            "client_email": "client@example.com",
            "project_title": "Cloud Infrastructure Assessment",
            "project_description": "Comprehensive assessment of current cloud infrastructure with recommendations for optimization and cost reduction.",
            "scope_items": [
                "Current state infrastructure audit",
                "Cost analysis and optimization recommendations",
                "Security posture assessment",
                "Architecture review and recommendations",
                "Migration roadmap (if applicable)",
            ],
            "deliverables": [
                "Infrastructure Assessment Report",
                "Cost Optimization Recommendations",
                "Security Findings Report",
                "Architecture Recommendations Document",
                "Executive Summary Presentation",
            ],
            "timeline_weeks": 4,
            "line_items": [
                {"description": "Infrastructure Assessment", "amount": 5000},
                {"description": "Security Review", "amount": 3000},
                {"description": "Documentation & Reporting", "amount": 2000},
            ],
            "subtotal": 10000,
            "discount": 500,
            "total": 9500,
            "valid_until": (datetime.now().replace(day=1) +
                          __import__('datetime').timedelta(days=32)).strftime("%Y-%m-%d"),
            "terms": [
                "50% payment due upon project initiation",
                "Remaining 50% due upon delivery of final report",
                "This proposal is valid for 30 days",
                "Additional scope will be quoted separately",
            ],
        })

        filepath = generator.generate_proposal_pdf(sample_proposal)
        print(f"Proposal generated: {filepath}")

    elif args.command == "html":
        # Define form fields
        form_fields = [
            {"type": "text", "id": "company_name", "label": "Company Name", "required": True},
            {"type": "text", "id": "contact_name", "label": "Your Name", "required": True},
            {"type": "email", "id": "email", "label": "Business Email", "required": True},
            {"type": "tel", "id": "phone", "label": "Phone", "placeholder": "+1 XXX XXX XXXX"},
            {
                "type": "select", "id": "company_size", "label": "Company Size", "required": True,
                "options": [
                    {"value": "1-10", "label": "1-10 employees"},
                    {"value": "11-50", "label": "11-50 employees"},
                    {"value": "51-200", "label": "51-200 employees"},
                    {"value": "200+", "label": "200+ employees"},
                ]
            },
            {
                "type": "select", "id": "industry", "label": "Industry", "required": True,
                "options": [{"value": k, "label": v["en"]} for k, v in INDUSTRIES.items()]
            },
            {
                "type": "checkbox", "id": "services", "label": "Services of Interest", "required": True,
                "options": [{"value": s["id"], "label": s["name"]} for s in SERVICES]
            },
            {
                "type": "radio", "id": "clarity", "label": "Project Clarity", "required": True,
                "options": [
                    {"value": "clear", "label": "I have a clear project"},
                    {"value": "general", "label": "I have a general idea"},
                    {"value": "guidance", "label": "I need guidance"},
                ]
            },
            {
                "type": "radio", "id": "timeline", "label": "Timeline", "required": True,
                "options": [
                    {"value": "urgent", "label": "Urgent (< 1 month)"},
                    {"value": "near-term", "label": "Near-term (1-3 months)"},
                    {"value": "planning", "label": "Planning (3-6 months)"},
                    {"value": "exploring", "label": "Exploring (no rush)"},
                ]
            },
            {
                "type": "textarea", "id": "message", "label": "Message", "required": True,
                "placeholder": "Tell us about your situation..."
            },
        ]

        title = "Request a Discovery Call" if args.language == "en" else "اطلب مكالمة استكشافية"
        html_content = generate_html_form(form_fields, title, args.language)

        with open(args.output, "w", encoding="utf-8") as f:
            f.write(html_content)

        print(f"HTML form generated: {args.output}")

    elif args.command == "card":
        if not REPORTLAB_AVAILABLE:
            print("Error: reportlab is required. Install with: pip install reportlab")
            sys.exit(1)

        generator = PDFGenerator(args.output)
        filepath = generator.generate_business_card_pdf()
        print(f"Business cards generated: {filepath}")

    else:
        parser.print_help()


if __name__ == "__main__":
    main()
