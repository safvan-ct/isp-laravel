@extends('layouts.web')

@section('title', __('Islamic Calendar'))

@push('styles')
    <style>
        :root {
            --col-min-width: 96px;
            /* Minimum column width before scroll */
        }

        .calendar {
            max-width: 1100px;
            margin: 1.25rem auto;
            padding: 0.5rem;
        }

        .calendar-scroll {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, minmax(var(--col-min-width), 1fr));
        }

        .weekday-head {
            background: #4e2d4585;
            font-weight: 700;
            text-align: center;
            padding: 0.55rem 0.4rem;
            border: 1px solid rgba(0, 0, 0, 0.04);
            white-space: nowrap;
            font-size: 0.95rem;
        }

        .day-cell {
            min-height: 84px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 6px;
            background: #f9f5ef;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .day-number {
            font-weight: 700;
            font-size: 1.05rem;
        }

        .hijri {
            font-size: 0.78rem;
            color: #6c757d;
            margin-top: 4px;
        }

        .today {
            box-shadow: 0 0 0 2px #4E2D452e inset;
            border-left: 4px solid #4E2D45;
        }

        .muted-day {
            background: #4E2D452e !important;
            color: #8c949b;
        }

        @media (max-width: 420px) {
            :root {
                --col-min-width: 45px;
            }

            .day-cell {
                min-height: 66px;
                padding: 4px;
            }

            .weekday-head {
                font-size: 0.82rem;
                padding: 0.45rem 0.25rem;
            }

            .day-number,
            .weekday-small {
                font-size: 12px;
            }

            .hijri {
                font-size: 9px;
            }
        }
    </style>
@endpush

@section('content')
    <main class="container-fluid calendar my-3 flex-grow-1 notranslate" style="background: #f9f5ef">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <button id="prevBtn" class="btn btn-outline-primary btn-sm">&larr; Prev</button>
            </div>

            <div class="text-center">
                <h3 id="monthLabel" class="mb-0"></h3>
                <small id="yearLabel" class="text-muted"></small>
            </div>

            <div>
                <button id="nextBtn" class="btn btn-outline-primary btn-sm">Next &rarr;</button>
            </div>
        </div>

        <div class="calendar-scroll">
            <div id="calendarGrid" class="calendar-grid"></div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        (function() {
            const grid = document.getElementById('calendarGrid');
            const monthLabel = document.getElementById('monthLabel');
            const yearLabel = document.getElementById('yearLabel');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');

            let viewDate = new Date();

            /** Format Hijri Date */
            const getHijriDate = (date, locale) => {
                const calendars = ['islamic-umalqura', 'islamic'];
                for (const cal of calendars) {
                    try {
                        return new Intl.DateTimeFormat(`${locale}-u-ca-${cal}`, {
                            day: 'numeric',
                            month: 'short',
                            year: 'numeric'
                        }).format(date);
                    } catch {
                        /* fallback */
                    }
                }
                return '';
            };

            /** Get weekday names starting Sunday */
            const getWeekdayNames = (locale) => {
                let start = new Date();
                while (start.getDay() !== 0) start.setDate(start.getDate() - 1);
                return Array.from({
                        length: 7
                    }, (_, i) =>
                    new Date(start.getFullYear(), start.getMonth(), start.getDate() + i)
                    .toLocaleString(locale, {
                        weekday: 'short'
                    })
                );
            };

            /** Render Calendar */
            const renderCalendar = () => {
                let lang = document.getElementById('languageDropdown').textContent.trim().toLowerCase();
                let locale = 'en-US';

                // if (lang == 'ml') {
                //     locale = 'ml-IN';
                // } else if (lang == 'hi') {
                //     locale = 'hi-IN';
                // } else if (lang == 'ar') {
                //     locale = 'ar-SA';
                // }

                const year = viewDate.getFullYear();
                const month = viewDate.getMonth();

                monthLabel.textContent = viewDate.toLocaleString(locale, {
                    month: 'long'
                });
                yearLabel.textContent = viewDate.toLocaleString(locale, {
                    year: 'numeric'
                });

                const weekNames = getWeekdayNames(locale);
                let html = weekNames.map(name => `<div class="weekday-head">${name}</div>`).join('');

                const firstDay = new Date(year, month, 1);
                const startWeekday = firstDay.getDay();
                const daysInMonth = new Date(year, month + 1, 0).getDate();
                const prevMonthDays = new Date(year, month, 0).getDate();
                const today = new Date();

                // Add empty cells before the first day for alignment
                for (let i = 0; i < startWeekday; i++) {
                    const day = prevMonthDays - (startWeekday - 1 - i);
                    const cellDate = new Date(year, month - 1, day);
                    const hijri = getHijriDate(cellDate, locale);

                    html += `
                        <div class="day-cell muted-day">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="day-number">${cellDate.getDate()}</div>
                                <div class="weekday-small">${cellDate.toLocaleString(locale, { weekday: 'short' })}</div>
                            </div>
                            <div class="hijri">${hijri}</div>
                        </div>`;
                }

                // Current month days
                for (let dayNumber = 1; dayNumber <= daysInMonth; dayNumber++) {
                    let cellDate = new Date(year, month, dayNumber);
                    const isToday = cellDate.toDateString() === today.toDateString();
                    const hijri = getHijriDate(cellDate, locale);

                    html += `
                        <div class="day-cell ${isToday ? 'today' : ''}">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="day-number">${dayNumber}</div>
                                <div class="weekday-small">${cellDate.toLocaleString(locale, { weekday: 'short' })}</div>
                            </div>
                            <div class="hijri">${hijri}</div>
                        </div>`;
                }

                // Fill remaining cells for full weeks
                const totalCells = startWeekday + daysInMonth;
                const remainingCells = (7 - (totalCells % 7)) % 7;
                const nextMonthDate = new Date(year, month + 1, 1);

                for (let i = 0; i < remainingCells; i++) {
                    const cellDate = new Date(nextMonthDate.getFullYear(), nextMonthDate.getMonth(), i + 1);
                    const hijri = getHijriDate(cellDate, locale);

                    html += `
                        <div class="day-cell muted-day">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="day-number">${cellDate.getDate()}</div>
                                <div class="weekday-small">${cellDate.toLocaleString(locale, { weekday: 'short' })}</div>
                            </div>
                            <div class="hijri">${hijri}</div>
                        </div>`;
                }

                grid.innerHTML = html;
            };

            // Event Listeners
            prevBtn.addEventListener('click', () => {
                viewDate.setMonth(viewDate.getMonth() - 1);
                renderCalendar();
            });

            nextBtn.addEventListener('click', () => {
                viewDate.setMonth(viewDate.getMonth() + 1);
                renderCalendar();
            });

            // Initial render
            renderCalendar();
        })();
    </script>
@endpush
